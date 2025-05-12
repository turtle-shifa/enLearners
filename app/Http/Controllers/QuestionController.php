<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AnswerVote;

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
            $totalVotes = $answer->upvotes + $answer->downvotes;
            $ratio = $totalVotes > 0 ? $answer->upvotes / $totalVotes : 0;
            return $ratio * log($totalVotes + 1); // Combines quality and popularity
        });
    
        return view('questions.show', compact('question'));
    }
    

    // Store a new answer
    public function answer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'array|max:5',            
        ]);

        $answer = new Answer();
        $answer->question_id = $id;
        $answer->user_id = session('user_id');
        $answer->answer = $request->answer;

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('answers', 'public');
                $imagePaths[] = $path;
            }
            $answer->images = $imagePaths;
    }
        $answer->save();

        return redirect()->route('questions.show', $id);
    }

    public function upvote($id)
    {
        $userId = session('user_id');
        $answer = Answer::findOrFail($id);
        $vote = AnswerVote::where('answer_id', $id)->where('user_id', $userId)->first();

        if ($vote) {
            if ($vote->vote_type === 'upvote') {
                $vote->delete();
                $answer->decrement('upvotes');
            } else {
                $vote->update(['vote_type' => 'upvote']);
                $answer->increment('upvotes');
                $answer->decrement('downvotes');
            }
        } else {
            AnswerVote::create([
                'answer_id' => $id,
                'user_id' => $userId,
                'vote_type' => 'upvote'
            ]);
            $answer->increment('upvotes');
        }

        return redirect()->back();
    }

    public function downvote($id)
    {
        $userId = session('user_id');
        $answer = Answer::findOrFail($id);
        $vote = AnswerVote::where('answer_id', $id)->where('user_id', $userId)->first();

        if ($vote) {
            if ($vote->vote_type === 'downvote') {
                $vote->delete();
                $answer->decrement('downvotes');
            } else {
                $vote->update(['vote_type' => 'downvote']);
                $answer->increment('downvotes');
                $answer->decrement('upvotes');
            }
        } else {
            AnswerVote::create([
                'answer_id' => $id,
                'user_id' => $userId,
                'vote_type' => 'downvote'
            ]);
            $answer->increment('downvotes');
        }

        return redirect()->back();
    }

    
// to delete que ans
    public function destroy($id)
    {
        $user = session('user_email');
        if ($user === 'super_admin@gmail.com') {
            $question = Question::find($id);
            if ($question) {
                $question->delete();
                return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
            }
        }
        return redirect()->back()->with('error', 'Unauthorized or question not found.');
    }

    public function destroyAnswer($id)
    {
        $user = session('user_email');
        if ($user === 'super_admin@gmail.com') {
            $answer = Answer::find($id);
            if ($answer) {
                $answer->delete();
                return redirect()->back()->with('success', 'Answer deleted successfully.');
            }
        }
        return redirect()->back()->with('error', 'Unauthorized or answer not found.');
    }
    
}

