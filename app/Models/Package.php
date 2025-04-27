<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['package_type', 'description', 'name' , 'price' , 'service_id' , 'delivery_time'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}