<?php 


    function get_extension_from_mime($mime_type){
        if($mime_type == "image/jpeg")
            return "jpg";
        
        return explode("/", $mime_type)[1];
    }

    function image_by_extension($path, $extension){
        switch($extension){
            case "jpg":
                return imagecreatefromjpeg($path);
                break;
            case "png":
                return imagecreatefrompng($path);
                break;
            default:
                return null;
                break;
        }
    }

    function image_save_by_extension($image, $path, $extension){
        switch($extension){
            case "jpg":
                imagejpeg($image, $path);
                break;
            case "png":
                imagepng($image, $path);
                break;
            default:
                return false;
                break;
        }
        return true;
    }
?>