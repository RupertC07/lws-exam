<?php

namespace App\Actions\Anime;

use App\Models\Anime;
use Illuminate\Pagination\Paginator;
use URL;

class AnimeShowAllAction
{

    public function execute($request)
    {

        try {
            $perPage = $request->perPage ?? 10;//get number of items tat page should contain
            $anime = Anime::paginate($perPage);//fetch all anime and paginate them
    

            return $anime;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}