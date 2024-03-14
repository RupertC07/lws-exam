<?php
namespace App\Repositories;

use App\Actions\Anime\AnimeCreateAction;
use App\Actions\Anime\AnimeShowAction;
use App\Actions\Anime\AnimeUpdateAction;
use App\Http\Responses\AppResponse;
use App\Interfaces\AnimeInterface;
use Exception;

class AnimeRepo implements AnimeInterface{

    public function store($request) {
        try {
            //instantiate action file
            // $action = new AnimeCreateAction();
            $action = new AnimeCreateAction();
            $data =$action->execute($request);
            return AppResponse::success("Anime has been successfully uploaded", $data, 201);
        } catch (Exception $e) {
            return AppResponse::error($e->getMessage(), null, 500);
        }
    }

    public function show($request) 
    {
        try {
            //instantiate the anime show function
            $animeFind = new AnimeShowAction();
            $anime = $animeFind->execute($request->id);


            //iff anime is not found throw an error
            if (!$anime){
                
                return AppResponse::error("Anime not found", null,404);
            }

            return AppResponse::success("Anime has been successfully fetched", $anime, 200);

        } catch (Exception $e) {
            return AppResponse::error("Internal server error occur", null,500);
        }
    }

    public function  update($request) {
        try {
            if (!isset($request->id)) {

                //throw an error if id is not exists

                return AppResponse::error("Id is required", null,400);
                # code...
            }
            //instantiate an action
            $actionFind = new AnimeShowAction();
            $anime = $actionFind->execute($request->id);

                //iff anime is not found throw an error
                if (!$anime){
                    return AppResponse::error("Anime not found", null,404);
                }
            
            //Instantiate new update action
            $action = new AnimeUpdateAction();
            $data =$action->execute($request);

            $getUpdatedAction = new AnimeShowAction();
            $data = $getUpdatedAction->execute($request->id);

            return AppResponse::success("Anime has been successfully updated", $data, 200);


        } catch (Exception $e) {

        return AppResponse::error("Internal Server Error", null,500);
        }
    }
}