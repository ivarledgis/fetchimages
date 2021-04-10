<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ImageFetchController extends Controller
{
    /**
     * Get all images from public/images folder
     * 
     * public_path gives the path of the public folder 
     * glob function returns all the files inside that folder that matches the given pattern
     * explode breaks string into an array 
     * 
     * @return JSONResponse all_images
     */
    public function getImages()
    {
        try {
            $imagesDir = public_path() . "/images/";
            $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
            $allImages = [];
            foreach ($images as $key => $image) {
                $onlyImageName = explode($imagesDir, $image);
                $imageLink = asset("/images/" . $onlyImageName[1]);
                array_push($allImages, $imageLink);
            }

            return response()->json(['success_message' => 'random image', 'images' => $allImages], 200);
        } catch (Exception $th) {
            return response()->json(['error_message' => 'Something went wrong.'], 500);
        }
    }

    /**
     * Get a random Image from public/images folder
     * 
     * public_path gives the path of the public folder 
     * glob function returns all the files inside that folder that matches the given pattern
     * explode breaks string into an array 
     * 
     * @return JSONResponse rand_image
     */
    public function getRandImage()
    {
        try {
            $imagesDir = public_path() . "/images/";
            $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
            $randomImage = $images[array_rand($images)];
            $onlyImageName = explode($imagesDir, $randomImage);
            $imageLink = asset("/images/" . $onlyImageName[1]);

            return response()->json(['success_message' => 'random image', 'image' => $imageLink], 200);
        } catch (Exception $th) {
            return response()->json(['error_message' => 'Something went wrong.'], 500);
        }
    }
}
