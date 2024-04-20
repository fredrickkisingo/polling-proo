<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class QuestionAnswerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question'                  => 'required|string',
            'answers'                   => 'required|array|min:4',
            'answers.*.id'              => 'required|integer',
            'answers.*.answer'          => 'required|string',
            'answers.*.correct_answer'  => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
        'answers.required' => 'The answers field is required.',
        'answers.array' => 'The answers must be an array.',
        'answers.min' => 'The answers array must have at least 4 elements.',
        'answers.*.id.required' => 'The answer id is required for each answer.',
        'answers.*.id.integer' => 'The answer id must be an integer.',
        'answers.*.answer.required' => 'The answer text is required for each answer.',
        'answers.*.answer.string' => 'The answer text must be a string.',
        'answers.*.correct_answer.required' => 'The correct_answer field is required for each answer.',
        'answers.*.correct_answer.boolean' => 'The correct_answer field must be a boolean (true/false) value.',
    ];

    }

}
