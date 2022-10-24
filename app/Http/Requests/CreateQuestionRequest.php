<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'question' => 'required|string|bail',
             'topic_id' => 'required|exists:topics,id',
             'option1' => 'required',
             'option2' => 'required',
             'option3' => 'nullable',
             'option4' => 'nullable',
             'answer' => 'required',
             'type' => 'in:image,word'
        ];
    }
}
