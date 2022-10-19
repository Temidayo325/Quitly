<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
         'title',
          'faculty',
          'department'
    ];

    public function questions()
    {
         return $this->hasMany(Question::class);
    }
}
