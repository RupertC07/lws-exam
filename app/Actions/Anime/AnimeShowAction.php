<?php

namespace App\Actions\Anime;
use App\Models\Anime;

class AnimeShowAction {

    public function execute($id) {
        $anime = Anime::find($id);
        return $anime;
    }
}