<?php
namespace App\Interfaces;

interface UserInterface {

    //this method will used by the controller to store data of newly registered user
    public function store($request);
    public function auth($request);

    public function signout($request);

    public function show($request);

  
   
}