<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = 
    [
    'name', 
    'price', 
    'qty', 
    'user_id' // Pastikan ini ADA
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}