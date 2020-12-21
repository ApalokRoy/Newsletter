<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user) {
    	$posts = $user->posts()->paginate(3);
    	return view('users.show', compact('user', 'posts'));
    }

    public function edit(User $user) {
    	if(auth()->user() != $user) {
	 		\Session::flash('alert-warning', 'You are not Authorized to perform the action!');
    		return redirect('/');
    	}

    	return view('users.edit', compact('user'));
    }

    public function update(User $user) {
    	if(auth()->user() != $user) {
	 		\Session::flash('alert-warning', 'You are not Authorized to perform the action!');
    		return redirect('/');
    	}

    	$data = request()->validate([
    		'name' => ['required', 'string', 'max:255'],
    	]);

    	$user->update($data);

    	if($user->wasChanged()) {
	 		\Session::flash('alert-success', 'Profile successfully updated!');
    	}

        return redirect()->route('users.show', $user->id);
    }

    public function changePassword(User $user) {
        if(auth()->user() != $user) {
            \Session::flash('alert-warning', 'You are not Authorized to perform the action!');
            return redirect('/');
        }

        return view('users.changePassword', compact('user'));
    }

    public function updatePassword(User $user) {
        if(auth()->user() != $user) {
            \Session::flash('alert-warning', 'You are not Authorized to perform the action!');
            return redirect('/');
        }

        $data = request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed',
                function ($attribute, $value, $fail) use ($user) {
                    if(Hash::check($value, $user->password)) {
                        return $fail(__('New Password cannot be same as your current password.'));
                    }
                }
            ],
            'current-password' => ['required', 'string', 'min:8',
                function ($attribute, $value, $fail) use ($user) {
                    if (!\Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }
            ],
        ]);

        $user->update(['password' => Hash::make($data['password'])]);
        
        \Session::flash('alert-success', 'Password successfully updated!');
        return redirect()->route('users.show', $user->id);

    } 
}
