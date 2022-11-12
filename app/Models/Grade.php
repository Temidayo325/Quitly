<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade', 'term', 'upper_limit', 'lower_limit'
    ];

    public function result()
    {
        return $this->hasMany(Result::class);
    }
}
