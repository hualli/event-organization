<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Carbon;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'short_description' => 'required|string|max:100',
            'long_description' => 'required|string|max:250',
            'date_time' => ['required', 'date', 'after:' . Carbon::now()],
            'organizer' => 'required|string|max:50',
            'location' => 'required|string|max:100',
            'status' => 'required|string|max:10',
        ];
    }

    /**
     * Handles the failure of a request validation
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator  contains the validation errors
     * @throws \Illuminate\Http\Exceptions\HttpResponseException  throws an exception with validation errors
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ]
        ));
    }
}
