<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class, 'nisn', 'username');
    }

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function bookRent()
    {
        return $this->hasMany(BookRent::class);
    }
}
