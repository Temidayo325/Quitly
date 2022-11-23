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
             'question' => trim($row[0]),
             'topic_id' => $this->title_id,
             'option1' => trim($row[1]),
             'option2' => trim($row[2]),
             'option3' => ( !empty(trim($row[3]) ) ) ? trim($row[3]) : null,
             'option4' => ( !empty(trim($row[4]) ) ) ? trim($row[4]) : null,
             'answer' => trim($row[5]),
             'type' => 'word',
             'status' => 0
        ]);
    }
}
