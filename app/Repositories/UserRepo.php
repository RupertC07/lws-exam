<?php
namespace App\Repositories;
use App\Actions\User\UserDeleteFunction;
use App\Actions\User\UserRegistrationAction;
use App\Http\Responses\AppResponse;

use App\Interfaces\UserInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Request;


class UserRepo implements UserInterface {

    
    public function store($request) {
        try {
            //initialize user registration action class
            $action = new UserRegistrationAction();
            //perform the action by calling execute method
            $data = $action->execute($request);

            //if userdata creation is successful, login user then generate token

            if (!$data) 
            {
                return AppResponse::error("Failed to register user account. PLease try again later",null, 500);
            }

            //create user token for the api to authenticate them
            $token = $data->createToken("token")->plainTextToken;
            $data = [
                "token"=> $token,
                "user" => $data
            ];
            return AppResponse::success( "Account has been successfully registered",$data, 201);
        } catch (Exception $e) {
            return AppResponse::error('Internal Error Server Occur', null,500);
        }
    }

    public function auth($request) {
        try {
            

            //Validate if user's exists or valid 
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return AppResponse::error('Invalid login credentials. Please try again', null, 401 );
            }


            //instantiate user then create token
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $data = [
                "token"=> $token,
          
            ];

            return AppResponse::success('User has been successfully logged in',$data, 200);
        } catch (Exception $e) {

            return AppResponse::error('Internal Server Error Occur', null,500);
            //throw $th;
        }
    }

    public function signout($request)
    {
        try {
            $user = $request->user();//Get the user from token
            $user->tokens()->delete(); //Deletethe tokens of user
            return AppResponse::success('User has been successfully logged out', null, 200);
        } catch (Exception $e) {
            return AppResponse::error("Internal Server Error Occurred", null, 500);
        }
    }

    public function show($request)
    {

        try {

            //get user from token
            $user = $request->user();
            
            //return user
            return AppResponse::success('User has been successfullyfetched', $user, 200);
        } catch (Exception $e) {
            return AppResponse::error("Internal Server Error Occurred", null, 500);
        }

    }

    public function delete($request){

        try {

            //get user from token
            $user = $request->user();
            $action = new UserDeleteFunction();

            // soft delete the user
            $delete = $action->execute($user->id);

            return AppResponse::success("User account has been successfully deleted", null,200);
        } catch (Exception $e) {
            return AppResponse::error("Internal Server Error Occurred", null, 500);
        }
    }



    
    
}