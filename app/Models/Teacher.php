<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bookRent()
    {
        return $this->hasMany(BookRent::class);
    }
}
