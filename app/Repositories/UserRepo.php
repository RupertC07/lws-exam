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

            //if userdata creating is successful, login user then generate token

            if (!$data) 
            {
                return AppResponse::error("Failed to register user account. PLease try again later",null, 500);
            }

            $token = $data->createToken("token")->plainTextToken;
            $data = [
                "token"=> $token,
                "user" => $data
            ];
            return AppResponse::success( "Account has been successfully registered",$data, 201);
        } catch (Exception $e) {
            return AppResponse::error($e->getMessage(), null,500);
        }
    }

    public function auth($request) {
        try {
            
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'deleted_at' => null])) {
                return AppResponse::error('Invalid login credentials. Please try again', null, 401 );
            }

            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;

            return AppResponse::success('User has been successfully logged in',$token, 200);
        } catch (Exception $e) {

            return AppResponse::error( $e->getMessage() , null,500);
            //throw $th;
        }
    }

    public function signout($request)
    {
        try {
            $user = $request->user();
            $user->tokens()->delete(); 
            return AppResponse::success('User has been successfully logged out', null, 200);
        } catch (Exception $e) {
            return AppResponse::error("Internal Server Error Occurred", null, 500);
        }
    }

    public function show($request)
    {

        try {
            $user = $request->user();
          
            return AppResponse::success('User has been successfullyfetched', $user, 200);
        } catch (Exception $e) {
            return AppResponse::error("Internal Server Error Occurred", null, 500);
        }

    }

    public function delete($request){

        try {
            $user = $request->user();
            $action = new UserDeleteFunction();

            $delete = $action->execute($user->id);

            return AppResponse::success("User account has been successfully deleted", null,200);
        } catch (Exception $e) {
            return AppResponse::error("Internal Server Error Occurred", null, 500);
        }
    }



    
    
}