<?php

namespace App\Actions\Anime;
use App\Models\Anime;

class AnimeDeleteAction {

    public function execute($id){
        //Look for a data with the same id of parameter then delete it
     return Anime::where("id", $id)->delete();
    }
}