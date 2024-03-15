<?php

namespace App\Http\Requests\Anime;

use Illuminate\Foundation\Http\FormRequest;

class AnimeUpdateRequest extends FormRequest
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
            
            "title"=> [
                "required",
                "string",
                "max:255"
            ],
            "category" => [
                "required",
                "array"
                
            ],
            "category.*" => [
                'string',
                'min:2'
            ],
           
            "description" => [
                "required",
                "string",
                "max:255"
                
            ],
            "publisher" => [
                "nullable"
            ],
            "image" => [
                "sometimes",//since this is an update make it as sometimes so we don't require new image every update request
               "image",
               "mimes:jpeg,png,jpg,gif" ,
               "max:5120", //Max size is 5mb
            ],
            "type" => [
                "nullable",
                "string",
                "max:50",
            ],
            "status" => [
                "required",
                "string",
                "max:50"
            ]
            
        ];
    }

    //perform all the validators
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
         $this->validateStatus($validator);
         $this->validateType($validator);
        });
    }



    protected function validateType($validator)
    {
        $type = ucfirst($this->input('type'));
        if (!in_array($type, ['Series','Movie'])){ //validate and limit the type that will be eneter by user
            $validator->errors()->add('type','Type is invaild allowed types are series or movie');
        }
    }

    protected function validateStatus($validator)
    {
        $status = ucfirst($this->input('status'));
        if (!in_array($status, ['On going','Coming Soon', 'Ended', 'Available'])){//validate and limit the status that will be eneter by user
            $validator->errors()->add('status','Status is invalid only On going, Coming Soon, Ended, and Available is allowed');
        }
       
    }

}
