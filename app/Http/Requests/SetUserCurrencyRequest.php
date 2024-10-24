<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SetUserCurrencyRequest extends FormRequest
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
            'currencyselect' => 'required|array|min:1', // Ensure 'currencyselect' is an array with at least one item
            'currencyselect.*' => 'integer|min:1|distinct',    // Each currencyselect must be a string and unique
        ];
    }

    public function messages()
    {
        return [
            'currencyselect.required' => 'Please select at least one option.',
            'currencyselect.array' => 'Options must be an array.',
            'currencyselect.*.integer  ' => 'Each option must be a integer.',
            'currencyselect.*.min  ' => 'Each option must be at least 1.',
            'currencyselect.*.distinct' => 'Options must be unique.',
        ];
    }

    protected function prepareForValidation(): void
{
    $this->merge([
        'user_id' => Auth::user()->id
    ]);
}

}
