<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    protected $fillable = [
        'service_id',
        'is_main',
        'image_path',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}