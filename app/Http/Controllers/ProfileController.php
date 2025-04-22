<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            // 'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'profileImage' => 'nullable|image|max:2048', 
        ]);

        $user = auth()->user();

        $user->name = $validated['firstName'];
        $user->email = $validated['email'];

        if ($request->hasFile('profileImage')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $path = $request->file('profileImage')->store('profile_photos', 'public');
            $user->image = $path;

        }
        
        // dd($user); 
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}