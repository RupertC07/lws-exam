<?php

namespace App\Actions\Anime;
use App\Models\Anime;

class AnimeShowAction {

    public function execute($id) {

        //fetch the single data with the id of provided parameter
        $anime = Anime::find($id);
        return $anime;
    }
}