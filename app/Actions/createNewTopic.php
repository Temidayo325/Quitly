<?php

namespace App\Actions;

use App\Models\Topic;

class CreateNewTopic
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\Topic
     */
    public static function create(\App\Http\Requests\CreateTopicRequest $input)
    {
         $topic =  Topic::create([
            'title' => $input->title,
            'faculty' => $input->faculty,
            'department' => $input->department
        ]);
        return $topic;
    }
}
