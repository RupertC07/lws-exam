<?php

namespace App\Actions\Anime;
use App\Actions\Image\ImageDeleteAction;
use App\Actions\Image\ImageSaveAction;
use App\Models\Anime;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AnimeCreateAction {

    public $imageName;

    public function execute($request) {

        try {            
            //Let's compress all categories
            $categories = implode(",", $request->input("category"));
            // //instatiate image saving function
                $imageAction = new ImageSaveAction();
                 $imageData = $imageAction->execute($request);

                 //pass the name here so we can delete it at catch
                 $this->imageName = $imageData["name"];

                 //preparation of data
                 $animeData = [
                    "title" => $request->title,
                    "description"=> $request->description,
                    "cover"=>$imageData['url'],
                    "publisher"=> $request->publisher == null ? '' : $request->publisher ,
                    "category" => $categories,
                    "type" =>$request->type,
                    "status" => $request->status
                 ];

                $data = Anime::create($animeData);

                return $data;
        } catch (\Throwable $th) {
            //when the query failed, let's delete image
            if ($this->imageName) {
                $imageDelAction = new ImageDeleteAction();
                $imageDelAction->execute($this->imageName);
            }
            throw $th;
        }
    }

   
}