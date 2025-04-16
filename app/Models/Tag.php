<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    protected $fillable = ['name', 'color'];
    
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_tag');
    }
}
