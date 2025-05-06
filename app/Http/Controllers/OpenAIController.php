<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ChatHistory;

class OpenAIController extends Controller
{
public function askQuestion(Request $request)
{
    if (!session('user_id')) {
        return redirect('/login')->withErrors(['auth' => 'You must be logged in to use the chatbot.']);
    }

    $request->validate([
        'question' => 'required|string|max:1000'
    ]);

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . config('services.openrouter.api_key'),
        'HTTP-Referer' => config('app.url'),
        'X-Title' => 'Laravel OpenRouter Demo',
    ])->post('https://openrouter.ai/api/v1/chat/completions', [
        'model' => 'deepseek/deepseek-r1:free',
        'messages' => [
            ['role' => 'user', 'content' => $request->question]
        ],
    ]);

    if ($response->failed()) {
        return back()->withErrors(['api_error' => 'API request failed']);
    }

    $answer = $response->json('choices.0.message.content');

    // Save to DB
    ChatHistory::create([
        'user_id' => session('user_id'),
        'question' => $request->question,
        'answer' => $answer
    ]);

    return back()->with([
        'question' => $request->question,
        'answer' => $answer
    ]);
}

public function showForm()
{
    if (!session('user_id')) {
        return redirect('/login')->withErrors(['auth' => 'Login required to access chatbot']);
    }

    $histories = ChatHistory::where('user_id', session('user_id'))
        ->latest()
        ->take(10)
        ->get();

    return view('openai.standalone', compact('histories'));
}
public function showHistory($id)
{
    if (!session('user_id')) {
        return redirect('/login')->withErrors(['Please login to view history.']);
    }

    $history = ChatHistory::where('id', $id)->where('user_id', session('user_id'))->firstOrFail();
    $histories = ChatHistory::where('user_id', session('user_id'))->latest()->get();

    return view('openai.standalone', [
        'histories' => $histories,
        'selectedQuestion' => $history->question,
        'selectedAnswer' => $history->answer
    ]);
}

}