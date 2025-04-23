<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ReviewRepositoryInterface;
use App\Interfaces\SignalRepositoryInterface;

class adminController extends Controller
{
    protected $signalRepository;
    protected $reviewRepository;

    public function __construct(SignalRepositoryInterface $signalRepository , ReviewRepositoryInterface $reviewRepository)
    {
        $this->signalRepository = $signalRepository;
        $this->reviewRepository = $reviewRepository;
    }
   public function dashboard(){
    return view('admin.dashboard');

   }

   public function services(){
    return view('admin.services');
   }

   
   public function orders(){
    return view('admin.orders');
   }

   public function signals()
    {
        $signals = $this->signalRepository->getAllWithRelations();
        return view('admin.signals', compact('signals'));
    }

    // public function dismissSignal($id)
    // {
    //     $this->signalRepository->deleteById($id);
    //     return redirect()->route('admin.signals')->with('success', 'Signal dismissed successfully.');
    // }

    public function deleteReviewFromSignal($id)
    {
        $this->signalRepository->deleteReviewFromSignal($id);
        return redirect()->route('admin.signals')->with('success', 'Review deleted successfully.');
    }

    public function reviews()
    {
        $reviews = $this->reviewRepository->getAllWithRelations();
        return view('admin.reviews', compact('reviews'));
    }

    public function deleteReview($id)
    {
        $this->reviewRepository->deleteById($id);
        return redirect()->route('admin.reviews')->with('success', 'Review deleted successfully.');
    }
}
