<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ImageFetchController extends Controller
{
    /**
     * Get all images from public/images folder
     *
     * @return JSONResponse all_images
     */
    public function getImages()
    {
        try {

            $allImages = $this->getImageUrl(false);

            return response()->json(['success_message' => 'All Images', 'images' => $allImages], 200);
        } catch (Exception $th) {
            return response()->json(['error_message' => 'Something went wrong.'], 500);
        }
    }

    /**
     * Get a random Image from public/images folder
     *
     * @return JSONResponse rand_image
     */
    public function getRandImage()
    {
        try {
            $imageLink = $this->getImageUrl();

            return response()->json(['success_message' => 'random image', 'images' => $imageLink], 200);
        } catch (Exception $th) {
            return response()->json(['error_message' => 'Something went wrong.'], 500);
        }
    }

    /**
     * public_path gives the path of the public folder 
     * glob function returns all the files inside that folder that matches the given pattern
     * explode breaks string into an array 
     * 
     * @return Array $image
     */
    private function getImageUrl($random = true)
    {
        $imagesDir = public_path() . "/images/";
        $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        if ($random) {
            $images = [$images[array_rand($images)]];
        }
        $allImages = [];
        foreach ($images as $key => $image) {
            $onlyImageName = explode($imagesDir, $image);
            $imageLink = asset("/images/" . $onlyImageName[1]);
            array_push($allImages, $imageLink);
        }

        return $allImages;
    }
}
