<?php

namespace App\Interfaces;

interface SignalRepositoryInterface
{
    public function getAllWithRelations();
    public function deleteById($id);
    public function deleteReviewFromSignal($id);
}