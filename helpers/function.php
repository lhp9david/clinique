<?php


/*
    /*methode de verification d'image jpg ou png , pas plus de 5mo
    */
   function checkImage($image)
    {
        $maxSize = 5000000;
        $validExt = array('jpg', 'jpeg', 'png');
        if ($image['size'] <= $maxSize) {
            $uploadExt = strtolower(substr(strrchr($image['name'], '.'), 1));
            if (in_array($uploadExt, $validExt)) {
                $uploadName = md5(uniqid(rand(), true));
                $uploadDir = '../Assets/img/';
                $uploadFile = $uploadDir . $uploadName . '.' . $uploadExt;
                move_uploaded_file($image['tmp_name'], $uploadFile);
                return $uploadFile;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    ?>