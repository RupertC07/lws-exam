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

        //set of rules or data validation that will be use by registration api
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
                "min:8",
                'confirmed'
            ],
            'password_confirmation' => 'required|string|min:8',

        ];
    }

    //This is the extra validation after performing a data validation
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateEmailExists($validator);
            $this->normalizeContactNumber();
            $this->validateCNumExists($validator);
        });
    }


    //this method will valdate if the email is already taken where field deleted_at is null
    //since we are applying soft deletes, we need to make sure that we will allow the duplicaion of email as long as the other data is deleted
    //edit: with laravel's soft deleted it is automatically read as deleted
    protected function validateEmailExists($validator)
    {
        $email = $this->input('email');

        if (User::where('email', $email)->exists()) {
            $validator->errors()->add('email','The provided email already exists');

        }

    }


    //the purpose of this method is to normalize all the contact number in database

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

 //this method will valdate if the contact number is already taken where field deleted_at is null
    //since we are applying soft deletes, we need to make sure that we will allow the duplicaion of contact number as long as the other data is deleted

protected function validateCNumExists($validator)
{
    $contactNumber = $this->input('contactNumber');

    if (User::where('contactNumber', $contactNumber)->exists()) {
        $validator->errors()->add('contactNumber','The provided contact number already exists');
    }
}




}
