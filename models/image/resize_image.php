<?php 
    define("IMAGE_SIZE_BIG", 1);
    define("IMAGE_SIZE_MEDIUM", 2);
    define("IMAGE_SIZE_SMALL", 3);

    define("IMAGE_BIG_WIDTH", 450);
    define("IMAGE_MEDIUM_WIDTH", 250);
    define("IMAGE_SMALL_WIDTH", 80);

    function resize_image($image, $new_size){
        $width = imagesx($image);
        $height = imagesy($image);

        $newWidth = 0;
        $newHeight = 0;

        switch($new_size){
            case IMAGE_SIZE_BIG:
                $newWidth = IMAGE_BIG_WIDTH;
                $newHeight =  intval(($newWidth * $height) / $width);
                break;
            case IMAGE_SIZE_MEDIUM:
                $newWidth = IMAGE_MEDIUM_WIDTH;
                $newHeight =  intval(($newWidth * $height) / $width);
                break;
            case IMAGE_SIZE_SMALL:
                $newWidth = IMAGE_SMALL_WIDTH;
                $newHeight =  intval(($newWidth * $height) / $width);
                break;
            default:
                return $image;
                break;
        }

        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        return $newImage;
    }
?>