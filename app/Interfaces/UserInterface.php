<?php
namespace App\Interfaces;

interface UserInterface {

    //these methods will used by the controllers
    public function store($request);
    public function auth($request);

    public function signout($request);

    public function show($request);

    public function delete($request);

  
   
}