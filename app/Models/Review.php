<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['service_id', 'user_id', 'rating', 'comment'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signals()
    {
        return $this->hasMany(Signal::class);
    }

    public function signalCount()
    {
        return $this->signals()->count();
    }

    public function hasBeenSignaledByUser($userId)
    {
        return $this->signals()->where('user_id', $userId)->exists();
    }
}