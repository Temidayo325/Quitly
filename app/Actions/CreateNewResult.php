<?php

namespace App\Actions;

use App\Models\Result;

class CreateNewResult
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\Result
     */
    public static function create(\Illuminate\Http\Request $input)
    {
        $grade = \App\Models\Grade:::where('lower_limit', '<=', $input->score)->where('upper_limit', '>=', $input->score)->first();
         $result =  Result::create([
            'user_id' => $input->user_id,
            'score' => $input->score,
            'topic_id' => $input->topic_id,
            'grade_id' => $grade->id
        ]);
        return $result;
    }
}
