<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\UserJob;
use App\Mail\UserMail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password'=> 'required|min:6',
        ]);

        $user = User::create($validated);

        $subject = "Queue Practice";

        UserJob::dispatch($subject, $user);

        return redirect()->route("user.index")->with("success","User Created Successfully.");
    }
}
