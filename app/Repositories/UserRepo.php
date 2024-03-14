<?php
namespace App\Repositories;
use App\Actions\User\UserRegistrationAction;
use App\Http\Responses\AppResponse;

use App\Interfaces\UserInterface;
use Exception;
use Illuminate\Support\Facades\Auth;


class UserRepo implements UserInterface {

    
    public function store($request) {
        try {
            //initialize user registration action class
            $action = new UserRegistrationAction();
            //perform the action by calling execute method
            $data = $action->execute($request);

            //if userdata creating is successful, login user then generate token

            if (!$data) 
            {
                return AppResponse::error("Failed to register user account. PLease try again later",null, 500);
            }

            //we will register user after successful registration
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return AppResponse::error("Failed to log in user after registration", null, 500);
            }
            $user = Auth::user();
            $token = $user->createToken("token")->plainTextToken;
            $data = [
                "token"=> $token,
                "user" => $user
            ];
            return AppResponse::success( "Account has been successfully registered",$data, 201);
        } catch (Exception $e) {
            return AppResponse::error($e->getMessage(), null,500);
        }
    }

   
}