<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //dd($request->all());
        $request->validate([
            "email"=> "required",
            "password"=> "required"
        ]);

        $user = User::where('email','=',$request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id]);
            session(['user_name' => $user->name]);
            session(['user_email' => $user->email]);
            return redirect('/dashboard')->with('success', 'Login successful!');
        } else {
            return redirect()->back()->with('error','Invalid email or password');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            "name"=> "required",
            "email"=> "required | unique:users",
            "password"=> "required | min:6 | confirmed"
        ]);
        //user info added
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/login')->with("success","Account created successfully. Please login.");
    
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function dashboard()
    {
        if (session()->has('user_id')) {
            $userId = session()->get('user_id');
            $user = User::find($userId);

            if ($user) {
                // Get saved resource IDs as an array
                $savedIds = $user->saved_resources 
                    ? explode(',', $user->saved_resources)
                    : [];

                // Fetch resources by those IDs
                $savedResources = Resource::whereIn('id', $savedIds)->get();
            } else {
                $savedResources = collect();
            }
        } else {
            return redirect('/login')->with('error', 'Please login first.');
        }

    return view('dashboard', compact('savedResources'));
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }

    public function showUpdateForm()
    {
    $userId = session('user_id');

    // Handle case where session is missing
    if (!$userId) {
        return redirect('/login')->with('error', 'Please log in to update your information.');
    }

    $user = User::find($userId);

    if (!$user) {
        return redirect('/login')->with('error', 'User not found.');
    }

    return view('update', compact('user'));
    }

    // Handle update
    public function updateInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::find(session('user_id'));

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        session(['user_name' => $user->name]);

        return redirect()->back()->with('success', 'Information updated successfully!');
    }

}
