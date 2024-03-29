<?php

namespace App\Actions\User;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
class UserRegistrationAction {


    //actual creation of data
    public function execute($request){

        //prepare the data
        $userData = [
            "firstName" => $request->input("firstName"),
            "middleName"=> $request->input("middleName") == null ? '' : $request->input("middleName"),
            "lastName" => $request->input("lastName"),
            "email" => $request->input("email"),
            "contactNumber" => $request->input("contactNumber"),
            "dob" => $request->input("dob"),
            "password" => Hash::make($request->input("password")),
        ];

        $user = User::create($userData);

    

        return $user;


    }
}





