<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/brands/' . $value);
        } else {
            return asset('uploads/no_image.jpg');
        }
    }


    // relations 
    public function campains()
    {
        return $this->belongsToMany(Campain::class);
    }
}
