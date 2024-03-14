<?php

namespace App\Actions\User;
use App\Models\User;

class UserFetchAction {

    public function execute($id) {
            $user = User::where("id", $id)->where("deleted_at", null)->first();

            return $user;
    }
}