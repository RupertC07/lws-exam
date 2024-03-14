<?php

namespace App\Http\Controllers;

use App\Actions\Anime\AnimeCreateAction;
use App\Http\Requests\Anime\AnimeCreationRequest;
use App\Interfaces\AnimeInterface;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    private AnimeInterface $animeRepo;

    public function __construct(AnimeInterface $animeRepo){
        $this->animeRepo = $animeRepo;
    }

    public function store(AnimeCreationRequest $request){
        return $this->animeRepo->store($request);
     }

     public function show(AnimeCreationRequest $request){
        return $this->animeRepo->show($request);
     }

     public function update(Request $request){
        return $this->animeRepo->update($request);
     }
}
