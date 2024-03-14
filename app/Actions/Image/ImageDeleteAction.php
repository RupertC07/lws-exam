<?php
namespace App\Actions\Image;
use Illuminate\Support\Facades\Storage;

class ImageDeleteAction {

    public function execute($imageName) 
    {
        try {

            //set the image path
            $imagePath = storage_path("app/public/images/covers/{$imageName}");
            
            //check if exsists
            if (file_exists($imagePath)) 
            {
                //if yes lets delete it
                return unlink($imagePath);
                # code...
            }

            //else just return
            return;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}