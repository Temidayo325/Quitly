<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopicController extends Controller
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
          'message' => 'Topic successfully created',
          'statusCode' => 201,
          'data' => \App\Models\Topic::all()
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
     * @param  \App\Http\Requests\CreateTopicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\CreateTopicRequest $request)
    {
             $topic = \App\Actions\CreateNewTopic::create($request);
             return response()->json([
               'status' => true,
               'message' => 'Topic successfully created',
               'statusCode' => 201,
               'data' => $topic
             ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            return response()->json([
              'status' => true,
              'message' => 'Topic successfully retrieved',
              'statusCode' => 201,
              'data' => \App\Models\Topic::whereId($id)->first()
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
    public function update(\App\Http\Requests\UpdateTopicRequest  $request)
    {
            $topic = \App\Models\Topic::whereId($request->topic_id)->first();
            $topic->title = $request->title;
            $topic->department = $request->department;
            $topic->faculty = $request->faculty;
            $topic->save();
            return response()->json([
                     'status' => true,
                      'message' => 'Topic successfully updated',
                      'statusCode' => 201,
                      'data' => $topic
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $topic = \App\Models\Topic::whereId($id)->delete();
         return response()->json([
                  'status' => true,
                   'message' => 'Topic successfully deleted',
                   'statusCode' => 201
         ]);
    }
}
