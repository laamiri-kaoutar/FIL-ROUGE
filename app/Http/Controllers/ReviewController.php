<?php

namespace App\Http\Controllers;

use App\Models\Signal;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function report(Request $request, $id)
    {
        $review = \App\Models\Review::findOrFail($id);
        $userId = auth()->id();

        // Check if the user has already reported this review
        if ($review->hasBeenSignaledByUser($userId)) {
            return redirect()->back()->with('error', 'You have already reported this review.');
        }

        // Prevent users from reporting their own review
        if ($review->user_id === $userId) {
            return redirect()->back()->with('error', 'You cannot report your own review.');
        }

        $request->validate([
            'reason' => 'required|in:Offensive,Spam,Misleading',
        ]);

        Signal::create([
            'user_id' => $userId,
            'review_id' => $id,
            'reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Review reported successfully.');
    }
}