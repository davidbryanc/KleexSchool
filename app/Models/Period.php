<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public $timestamps = false;
    public function grade()
    {
        return $this->hasMany(Grade::class);
    }
}
