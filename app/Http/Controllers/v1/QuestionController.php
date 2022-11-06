<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return response()->json([
               'status' => true,
               'message' => 'Question successfully created',
               'statusCode' => 201,
               'data' => \App\Models\Question::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Question\CreateQuestionRequest $request)
    {
         $question = \App\Actions\CreateNewQuestion::create($request);
         return response()->json([
           'status' => true,
           'message' => 'Question successfully created',
           'statusCode' => 201,
           'data' => $question
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Http\Requests\Question\QuestionIdRequest $request)
    {
         return response()->json([
               'status' => true,
               'message' => 'Question successfully retrieved',
               'statusCode' => 201,
               'data' => \App\Models\Question::whereId($request->id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Question\QuestionIdRequest $request)
    {
         $question = \App\Models\Question::whereId($request->topic_id)->first();
         $question->question = $request->question;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = ($request->has('option3')) ? $request->option3 : null;
        $question->option4 = ($request->has('option4')) ? $request->option4 : null;
        $question->answer = $request->answer;
        $question->save();
        return response()->json([
                 'status' => true,
                  'message' => 'Question successfully updated',
                  'statusCode' => 201,
                  'data' => $question
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Http\Requests\Question\QuestionIdRequest $request)
    {
        $question = \App\Models\Question::whereId($request->id)->delete();
        return response()->json([
                 'status' => true,
                  'message' => 'Question successfully deleted',
                  'statusCode' => 201
        ]);
    }
    /**
     * [importQuestion For importing the questions that compiled on Excel file]
     * @param  App\Http\Requests\Question $request               [description]
     * @return [type]           [description]
     */
    public function importQuestion(\App\Http\Requests\Question\ImportQuestionRequest $request)
    {
         Excel::import(new QuestionsImport($request->topic_id), $request->question);
         return response()->json([
                 'status' => true,
                  'message' => 'Question successfully imported',
                  'statusCode' => 201
        ]);
    }

    public function activateQuestion(\App\Http\Requests\Question\QuestionIdRequest $request)
    {
         $activate = \App\Models\Question::whereId($request->question_id)->first();
         $activate->status = ($activate->status == 0) ? 1 : 0);
         $activate->save();
         return response()->json([
                 'status' => true,
                  'message' => 'Question status successfully updated',
                  'statusCode' => 201
        ]);
    }
}
