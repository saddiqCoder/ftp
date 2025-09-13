<?php

$msg = [];
$msg['error'] = "true";

if(isset($_FILES['images'])){

    for($count = 0; $count < count($_FILES['images']['name']); $count++){
        $ext = pathinfo($_FILES['images']['name'][$count], PATHINFO_EXTENSION);
        $newfilename = uniqid() . '.' . $ext;

        if (move_uploaded_file($_FILES['images']['tmp_name'][$count], 'img/'.$newfilename)){
            $msg['error'] = "false";
        }else{
            $msg['error'] = $_FILES['images']['error'][$count];
        }
    }

    
    echo json_encode($msg);
}else{
    echo json_encode($msg);
}



?>