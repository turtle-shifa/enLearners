<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    // Display all questions
    public function index()
    {
        $questions = Question::with('user')->latest()->get();
        return view('questions.index', compact('questions'));
    }

    // Store a new question
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
        ]);

        $question = new Question();
        $question->question = $request->question;
        $question->user_id = session('user_id');  // Assuming user is authenticated
        
        $question->save();

        return redirect()->route('questions.index');
    }

    // Show the question and its answers
    public function show($id)
    {
        $question = Question::with('user')->find($id); // Eager load the user relationship
    
        if (!$question) {
            return redirect()->route('questions.index')->with('error', 'Question not found.');
        }
    
        // Sort answers by upvotes, then by downvotes
        $question->answers = $question->answers->sortByDesc(function ($answer) {
            return $answer->upvotes - $answer->downvotes;
        });
    
        return view('questions.show', compact('question'));
    }
    

    // Store a new answer
    public function answer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $answer = new Answer();
        $answer->question_id = $id;
        $answer->user_id = session('user_id');
        $answer->answer = $request->answer;
        $answer->save();

        return redirect()->route('questions.show', $id);
    }

    public function upvote($id)
{
    $answer = Answer::find($id);
    if ($answer) {
        $answer->upvote();
        return redirect()->back();
    }
    return redirect()->back()->with('error', 'Answer not found.');
}

public function downvote($id)
{
    $answer = Answer::find($id);
    if ($answer) {
        $answer->downvote();
        return redirect()->back();
    }
    return redirect()->back()->with('error', 'Answer not found.');
}
    
}

