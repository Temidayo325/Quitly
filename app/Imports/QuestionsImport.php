<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionsImport implements ToModel
{
     public $title_id;
     public function __construct($title_id)
     {
          $this->title_id = $title_id;
     }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Question([
             'question' => $row[0],
             'topic_id' => $this->title_id,
             'option1' => $row[1],
             'option2' => $row[2],
             'option3' => ( !empty($row[3] ) ) ? $row[3] : null,
             'option4' => ( !empty($row[4] ) ) ? $row[4] : null,
             'answer' => $row[5],
             'type' => 'word',
             'status' => 0
        ]);
    }
}
