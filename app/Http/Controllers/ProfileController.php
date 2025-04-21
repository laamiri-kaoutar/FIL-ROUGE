<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('client.profile');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'profileImage' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $user = auth()->user();

        // Update name by combining first and last name
        $user->name = $validated['firstName'] . ' ' . $validated['lastName'];
        $user->email = $validated['email'];

        // Handle profile image upload
        if ($request->hasFile('profileImage')) {
            // Delete old image if exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('profileImage')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}