<?php
namespace App\Traits;

Trait OfferTrait{
    function saveImages($photo, $folder) {
        // add image to folder
        $fileExtension = $photo -> getClientOriginalExtension();
        $file_name = time().'.'.$fileExtension;
        $path = $folder;
        $photo -> move($path,$file_name);
        return $file_name;
    }
}
