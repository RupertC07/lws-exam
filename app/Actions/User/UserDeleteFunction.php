<?php

namespace App\Actions\User;
use App\Models\User;


class UserDeleteFunction {

    public function execute($id) {

    $delete = User::find($id)->delete();
        return $delete;
        
    }
}