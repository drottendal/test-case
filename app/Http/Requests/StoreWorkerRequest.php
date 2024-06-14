<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Carbon;

class StoreWorkerRequest extends FormRequest
{

    public function authorize()
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
            'id' => 'integer|nullable',
            'email' => 'email',
            'ssn' => 'string|min:10|max:24',
            'phone' => 'string', //originally was phone but since the phone numbers provided aren't actual valid numbers it doesn't validate properly.
            'firstname' => 'string|alpha|max:30',
            'lastname' => 'string|alpha|max:50',
            'dob' => 'required|date|before_or_equal:'.Carbon::now()->subYears(16)->format('Y-m-d'),
            'salary' => 'integer|max_digits:9',
            'employmentfrom' => 'required|date',
            'employmentto' => 'date|nullable',
            'currentlyworking' => 'bool'
        ];
    }

    public function messages()
    {
        return [
            'dob.before_or_equal' => 'Person must be 16 years of age or older',
        ];
    }
}
