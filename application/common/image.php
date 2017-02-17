<?php

function resizeImage($filename, $to_width = 320, $to_height = 240) {

    $type = exif_imagetype($filename);
    $im = NULL;

    switch($type) {

        case 1: // IMAGETYPE_GIF
            $im = imagecreatefromgif($filename);
            break;
        case 2: // IMAGETYPE_JPEG
            $im = imagecreatefromjpeg($filename);
            break;
        case 3: // IMAGETYPE_PNG
            $im = imagecreatefrompng($filename);
            break;

    }

    if($im !== NULL) {

        list($w, $h) = getimagesize($filename);

        $new_h = $to_height;
        $new_w = $to_width;

        if($w > $h) {

            $koe = $w / $to_width;
            $new_h = ceil($h / $koe);

        } else {

            $koe = $h / $to_height;
            $new_w = ceil($w / $koe);

        }

        $im1 = imagecreatetruecolor($new_w, $new_h);
        imagecopyresampled($im1,$im,0,0,0,0,$new_w,$new_h,imagesx($im),imagesy($im));

        imagejpeg($im1, $filename, 100);

        imagedestroy($im);
        imagedestroy($im1);

    }

}