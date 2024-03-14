<?php
namespace App\Actions\Image;

class ImageSaveAction {

    public function execute($request) {
        try {
            //get the image from request
            $image = $request->file("image");

            //rename image so we could prevent duplicates
            $imageName =  str_replace(' ', '',$request->title).time() . '_' . str_replace(' ', '', $image->getClientOriginalName());

            /**
             * We will store image file on the storage folders
             * 
             * important notice: I stored it together with the project/api for exam purposes only
             *  it is important to take note that files like this must be stored separately like cloud storages
             * such as S3 and etc.
             */
            $storedPath = $image->storeAs('public/images/covers', $imageName);

            /**
             * with this, image can be accessible through our link and available publicly.
             * But this is not a confidential image or content like the actual video so for the mean time
             * let's make it available publicly
             */
            $imageUrl = asset('storage/' . str_replace('public/', '', $storedPath));

            return ['url' => $imageUrl, 'name' => $imageName];



        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
}