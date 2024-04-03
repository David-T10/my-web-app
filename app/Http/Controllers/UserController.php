<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view ('users.show', ['user'=> $user]);
    }

    public function showRegisterDetailsForm()
    {
        return view('auth.register-details');
    }

    public function saveDetails(Request $request)
    {
        $user = auth()->user();

        $user->profile()->updateOrCreate([], [
            'dob' => $request->input('date_of_birth'),
            'bio' => $request->input('bio'),
            'profile_pic' => $request->file('profile_pic') ? $request->file('profile_pic')->store('profile_pics', 'public') : null,
        ]);

        return redirect()->route('dashboard');
    }
}
