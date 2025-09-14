<?php

$msg = [];
$msg['error'] = "true";

if(isset($_FILES['files'])){

    for($count = 0; $count < count($_FILES['files']['name']); $count++){
        $ext = pathinfo($_FILES['files']['name'][$count], PATHINFO_EXTENSION);
        $newfilename = uniqid() . '.' . $ext;

        if (move_uploaded_file($_FILES['files']['tmp_name'][$count], 'img/'.$newfilename)){
            $msg['error'] = "false";
        }else{
            $msg['error'] = $_FILES['files']['error'][$count];
        }
    }

    
    echo json_encode($msg);
}else{
    echo json_encode($msg);
}



?>