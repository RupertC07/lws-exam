<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\User\AuthRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;




class UserController extends Controller
{

    private UserInterface $userRepo;

    public function __construct(UserInterface $userRepo)
    {

        //instantiate the interface for user, so we can use all the repos that handles actions
        $this->userRepo = $userRepo;
    }
    public function store(RegistrationRequest $request)
    {
        return $this->userRepo->store($request);
    }

    public function auth(AuthRequest $request)
    {
        return $this->userRepo->auth($request);
    }

    public function signout(Request $request) {
       
         return $this->userRepo->signout($request);
    }

    public function show(Request $request){
        return $this->userRepo->show($request);
    }

    public function delete(Request $request){
        return $this->userRepo->delete($request);
    }

}
