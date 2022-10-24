<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function store(\App\Http\Requests\CreateQuestionRequest $request)
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
    public function show(\App\Http\Requests\QuestionIdRequest $request)
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
    public function update(Request $request)
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
    public function destroy(\App\Http\Requests\QuestionIdRequest $request)
    {
        $question = \App\Models\Question::whereId($request->id)->delete();
        return response()->json([
                 'status' => true,
                  'message' => 'Question successfully deleted',
                  'statusCode' => 201
        ]);
    }
}
