<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\ResourceRequest;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function create()
    {
        $topics = Topic::all();
        return view('resource_upload', compact('topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|url',
            'topic_id' => 'required|exists:topics,id',
        ]);

        // Handle thumbnail upload
        $thumbnailName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->move(public_path('thumbnails'), $thumbnailName);

        if (session()->has('user_email')){
            $user_email = session()->get('user_email');
        }

        // Save resource to request table
        if (isset($user_email)){
            if ($user_email == 'resource_admin@gmail.com' || $user_email == 'super_admin@gmail.com') {
                $resource = new Resource();
                $resource->title = $request->title;
                $resource->description = $request->description;
                $resource->thumbnail = 'thumbnails/' . $thumbnailName;
                $resource->content = $request->content;
                $resource->user_id = session('user_id');
                $resource->topic_id = $request->topic_id;
                $resource->upvote = 0;
                $resource->downvote = 0;
                $resource->comment = 0;
                $resource->save();

                return redirect()->back()->with('success', 'Resource uploaded successfully!');

            }else{
                $resource = new ResourceRequest();
                $resource->title = $request->title;
                $resource->description = $request->description;
                $resource->thumbnail = 'thumbnails/' . $thumbnailName;
                $resource->content = $request->content;
                $resource->user_id = session('user_id');
                $resource->topic_id = $request->topic_id;
                // $resource->upvote = 0;
                // $resource->downvote = 0;
                // $resource->comment = 0;
                $resource->save();

                return redirect()->back()->with('success', 'Resource request submitted! Admin will review it.');
            }
        }
        
        
    }

    public function upvote(Request $request){
        Resource::where('id', $request->id)->increment('upvote');

        return redirect()->back();
    }

    public function downvote(Request $request){
        Resource::where('id', $request->id)->decrement('downvote');

        return redirect()->back();
    }


    public function pendingRequests()
    {
        $requests = ResourceRequest::all();
        return view('pending_requests', compact('requests'));
    }

    public function approveRequest($id)
    {
        $request = ResourceRequest::findOrFail($id);

        // Move to Resource table
        $resource = new Resource();
        $resource->title = $request->title;
        $resource->description = $request->description;
        $resource->thumbnail = $request->thumbnail;
        $resource->content = $request->content;
        $resource->user_id = $request->user_id;
        $resource->topic_id = $request->topic_id;
        $resource->upvote = 0;
        $resource->downvote = 0;
        $resource->comment = 0;
        $resource->save();

        // Delete from resource_requests table
        $request->delete();

        return redirect()->back()->with('success', 'Resource approved successfully!');
    }

    public function rejectRequest($id)
    {
        $request = ResourceRequest::findOrFail($id);
        $request->delete();

        return redirect()->back()->with('success', 'Resource request rejected successfully!');
    }

    public function save(Request $request)
    {
        if (session()->has('user_id')) {
            $userId = session()->get('user_id');
            $resourceId = $request->resource_id;

            // Fetch user
            $user = User::find($userId);

            if ($user) {
                // Get existing saved resource IDs as array
                $existingResources = $user->saved_resources 
                    ? explode(',', $user->saved_resources)
                    : [];

                // Check if already saved
                if (!in_array($resourceId, $existingResources)) {
                    $existingResources[] = $resourceId; // Add new one
                    // Save back as comma-separated string
                    $user->saved_resources = implode(',', $existingResources);
                    $user->save();
                }

                return redirect('/dashboard')->with('success', 'Resource saved!');
            } else {
                return redirect('/dashboard')->with('error', 'User not found.');
            }
        }

        return redirect('/login')->with('error', 'You must be logged in to save resources.');
    }


    public function showResources()
    {
        $resources = Resource::all();  // Fetch all resources from the database
        return view('resources', compact('resources'));  // Return the view with resources
    }

    // Method to delete a resource
    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);  // Find the resource by its ID
        $resource->delete();  // Delete the resource from the database
        return redirect('/admin/resources')->with('success', 'Resource deleted successfully!');
    }

    


}
