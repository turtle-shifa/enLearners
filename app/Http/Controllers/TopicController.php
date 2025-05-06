<?php

namespace App\Http\Controllers;
use App\Models\Resource;
use App\Models\User;
use App\Models\Topic;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    //
    public function topic_resources_access(Request $request){
        $allResources = Resource::where('topic_id','=',$request->topic_id)->orderBy('upvote','desc')->orderBY('downvote','asc')->get();
        $thumbnails = array();
        $topicAllInfo = Topic::find($request->topic_id);
        $topicName = $topicAllInfo->name;
        $contributors = array();

        foreach ($allResources as $resource){
            $thumbnails[] = $resource->get('thumbnail');
            $contributor = User::find($resource->user_id);
            $contributors[] = $contributor->name;
        }
        return view('resources_by_topic',compact('allResources','thumbnails','contributors','topicName'));
    }

    public function showTopics()
    {
        $topics = Topic::all();  // Fetch all topics from the database
        return view('topics', compact('topics'));  // Return the view with topics
    }

    // Method to delete a topic
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);  // Find the topic by its ID
        $topic->delete();  // Delete the topic from the database
        return redirect('/admin/topics')->with('success', 'Topic deleted successfully!');
    }

    public function create()
    {
        return view('create_topic');
    }

    // Method to store the new topic in the database
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255', // Ensure the name is required and has a max length of 255
        ]);

        // Create a new topic and store it in the database
        Topic::create([
            'name' => $request->name,
        ]);

        // Redirect to the topic management page with a success message
        return redirect('/admin/topics')->with('success', 'Topic created successfully!');
    }


    public function search()
{
    $topics = Topic::all();
    return view('search', compact('topics'));
}

    
}
