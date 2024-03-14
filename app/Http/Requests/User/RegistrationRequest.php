<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            "firstName" => [
                "required",
                "string",
                "max:200",
            ],
            "middleName"=> [
                "nullable"
            ],
            "lastName" => [
                "required",
                "string",
                "max:200",
            ],
            "email" => [
                "required",
                "email",
            ],
            "dob" => [
                "required",
                "date"
            ],
            "contactNumber" => 
            [
                "required",
                "string",
              
            ],
            "password"=> [
                "required",
                'confirmed'
            ],
            'password_confirmation' => 'required|string|min:8',

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateEmailExists($validator);
            $this->normalizeContactNumber();
            $this->validateCNumExists($validator);
        });
    }

    protected function validateEmailExists($validator)
    {
        $email = $this->input('email');

        if (User::where('email', $email)->whereNull('deleted_at')->exists()) {
            $validator->errors()->add('email','The provided email already exists');

        }

    }

    protected function normalizeContactNumber()
{
    $contactNumber = $this->input('contactNumber');

    // Check if the first character is '+'
    if (substr($contactNumber, 0, 1) === '+') {
        // Replace '+63' with '0'
        $this->merge([
            'contactNumber' => '0' . substr($contactNumber, 3)
        ]);
    }
}

protected function validateCNumExists($validator)
{
    $contactNumber = $this->input('contactNumber');

    if (User::where('contactNumber', $contactNumber)->whereNull('deleted_at')->exists()) {
        $validator->errors()->add('contactNumber','The provided contact number already exists');
    }
}




}
