<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;

class SetUserReportRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'currencyselect' => 'required|integer', // Ensure 'currencyselect' is an array with at least one item
            'rangeinterval' => 'required|string|in:R-Y-I-M,R-6M-I-W,R-M-I-D', // Ensure 'currencyselect' is an array with at least one item
      //      'source' =>  'required|string',

        ];
    }

    public function messages()
    {
        return [
        ];
    }

        protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => Auth::user()->id
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 422));
    }
}
