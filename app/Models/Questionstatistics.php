<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionstatistics extends Model
{
    use HasFactory;

    protected $fillable = [
         'question_id',
         'total_miss'
    ];

    public function question()
    {
         return $this->belongsTo(Question::class);
    }
}
