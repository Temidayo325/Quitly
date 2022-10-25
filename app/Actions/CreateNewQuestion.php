<?php

namespace App\Actions;

use App\Models\Question;
use Illuminate\Support\Facades\Hash;

class CreateNewQuestion
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\Question
     */
    public static function create(\App\Http\Requests\Question\CreateQuestionRequest $input)
    {
         $question =  Question::create([
            'question' => $input->question,
            'topic_id' => $input->topic_id,
            'option1' => $input->option1,
            'option2' => $input->option2,
            'option3' => ( $input->has('option3') ) ? $input->option3 : null,
            'option4' => ( $input->has('option4') ) ? $input->option4 : null,
            'answer' => $input->answer,
            'type' => $input->type,
            'status' => 0
         ]);
         return $question;
    }
}
