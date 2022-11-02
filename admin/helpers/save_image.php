<?php

function save($folder_name,$data)
{

    $file = $data['image'];
    if (!empty($file['name'])) {
        $file_type = $data['image']['type'];
        $arr=explode('/',$file_type);
        $ext = end($arr);
        $avatar_name= time() . ".$ext";
        move_uploaded_file($file['tmp_name'],'./images/'.$folder_name.'/'.$avatar_name);
        $avatar="./images/".$folder_name.'/'.$avatar_name;
        return $avatar;
        
        
    }else {
        return false;
    }
}