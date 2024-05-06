<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campain extends Model
{
    protected $table = 'campains';
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function getVideoAttribute($value)
    {
        if ($value) {
            return asset('uploads/campains/' . $value);
        } else {
            return asset('uploads/no_image.jpg');
        }
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

}
