<?php
namespace App\Repositories;

use App\Actions\Anime\AnimeCreateAction;
use App\Actions\Anime\AnimeDeleteAction;
use App\Actions\Anime\AnimeShowAction;
use App\Actions\Anime\AnimeShowAllAction;
use App\Actions\Anime\AnimeUpdateAction;
use App\Http\Responses\AppResponse;
use App\Interfaces\AnimeInterface;
use Exception;

class AnimeRepo implements AnimeInterface{

    public function index($request) {
        try {
            //prep the action to fetch all data
            $action = new AnimeShowAllAction();
            $anime = $action->execute($request);

            return AppResponse::success("Anime has been successfully fetched", $anime,200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

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

    public function delete($request) {
        try {
            //prep the action to find user
            $actionFind = new AnimeShowAction();
            $anime = $actionFind->execute($request->id);

            if (!$anime){
                return AppResponse::error("Anime not found", null,404);

            }

            //prpep the action to delete
            $actionDel = new AnimeDeleteAction();
            $actionDel->execute($request->id);//soft delete data

            return AppResponse::success("Anime has been successfully deleted", null,200);
        } catch (Exception $e) {
             return AppResponse::error("Internal server Error Occur", null,500);
        }
    }

  
}