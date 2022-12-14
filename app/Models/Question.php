<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
         'question', 'option1', 'option2',
         'option3', 'option4', 'answer',
         'status', 'topic_id', 'type'
    ];

    public function topic()
    {
         return $this->belongsTo(Topic::class);
    }

    public function statistics()
    {
         return $this->hasOne(Questionstatistics::class);
    }
}
