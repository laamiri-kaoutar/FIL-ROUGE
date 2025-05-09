<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    protected $fillable = [
        'service_id',
        'name',
        'package_type',
        'price',
        'revisions',
        'description',
        'delivery_time',
    ];

    protected $casts = [
        'price' => 'float',
        // 'revisions' => 'integer',
        'delivery_time' => 'integer',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}