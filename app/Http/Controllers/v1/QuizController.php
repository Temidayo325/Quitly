<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function startQuiz(\App\Http\Requests\Question\QuizRequest $request)
    {
         $details = \App\Models\TestDetail::first();
         $questions = \App\Models\Question::whereStatus(1)->where('topic_id', $request->topic_id)->inRandomOrder()->limit($details->quantity)->get();
         return response()->json([
              'status' => true,
              'message' => "Question succesfully retrieved",
              'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK,
              'data' => [
                   'questions' => $questions,
                   'duration' => $details->duration
              ]
         ]);
    }

    public function submitResult(Request $request)
    {
         $previousResults = \App\Models\Result::where('user_id', $request->user_id)->where('topic_id', $request->topic_id)->oldest()->get();
         if ($previousResults !== null && count($previousResults) > 2) {
              // user has exhausted the 3 store-able result
              $toDel = $previousResults->first();
              $toDel->delete();
              $result = \App\Actions\CreateNewResult::create($request);
         }
         if ($previousResults !== null && count($previousResults) < 3) {
              $result = \App\Actions\CreateNewResult::create($request);
         }
         
         return response()->json([
              'status' => true,
              'message' => "Result successfully saved",
              'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK,
         ]);
    }
}
