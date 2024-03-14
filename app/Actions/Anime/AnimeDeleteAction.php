<?php

namespace App\Actions\Anime;
use App\Models\Anime;

class AnimeDeleteAction {

    public function execute($id){
     return Anime::where("id", $id)->delete();
    }
}