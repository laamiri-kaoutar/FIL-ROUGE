<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\SignalRepositoryInterface;

class adminController extends Controller
{
    protected $signalRepository;

    public function __construct(SignalRepositoryInterface $signalRepository)
    {
        $this->signalRepository = $signalRepository;
    }
   public function dashboard(){
    return view('admin.dashboard');

   }

   public function reviews(){
    return view('admin.reviews');
   }

   
   public function services(){
    return view('admin.services');
   }

   public function signals()
    {
        $signals = $this->signalRepository->getAllWithRelations();
        return view('admin.signals', compact('signals'));
    }

    public function dismissSignal($id)
    {
        $this->signalRepository->deleteById($id);
        return redirect()->route('admin.signals')->with('success', 'Signal dismissed successfully.');
    }

    public function deleteReviewFromSignal($id)
    {
        $this->signalRepository->deleteReviewFromSignal($id);
        return redirect()->route('admin.signals')->with('success', 'Review deleted successfully.');
    }
}
