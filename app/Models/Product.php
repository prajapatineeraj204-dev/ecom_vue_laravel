<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'price', 'image_url', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
