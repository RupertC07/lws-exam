<?php

namespace App\Http\Controllers;

use App\Actions\Anime\AnimeCreateAction;
use App\Http\Requests\Anime\AnimeCreationRequest;
use App\Http\Requests\Anime\AnimeUpdateRequest;
use App\Interfaces\AnimeInterface;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    private AnimeInterface $animeRepo;

    public function __construct(AnimeInterface $animeRepo){
        $this->animeRepo = $animeRepo;
    }

    public function index(Request $request){
        return $this->animeRepo->index($request);
    }

    public function store(AnimeCreationRequest $request){
        return $this->animeRepo->store($request);
     }

     public function show(Request $request){
        return $this->animeRepo->show($request);
     }

     public function update(AnimeUpdateRequest $request){
        return $this->animeRepo->update($request);
     }

     public function delete(Request $request){
        return $this->animeRepo->delete($request);
     }



}
