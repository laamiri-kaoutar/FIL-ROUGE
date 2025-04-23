<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'package_id',
        'amount',
        'status',
        'stripe_transaction_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function package()
    {
        return $this->belongsTo(ServicePackage::class, 'package_id');
    }

    public function freelancer()
    {
        return $this->hasOneThrough(User::class, Service::class, 'id', 'id', 'service_id', 'user_id');
    }
}