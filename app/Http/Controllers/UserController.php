<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\User\RegistrationRequest;
use App\Interfaces\UserInterface;




class UserController extends Controller
{

private UserInterface $userRepo;

public function __construct(UserInterface $userRepo){
    $this->userRepo = $userRepo;
}
public function store(RegistrationRequest $request) {

    return $this->userRepo->store($request);

}
}
