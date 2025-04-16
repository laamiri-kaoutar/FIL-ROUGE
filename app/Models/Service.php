<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'rating',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'status' => 'string',
        'rating' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'service_tag');
    }

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }

    public function packages()
    {
        return $this->hasMany(ServicePackage::class);
    }
}