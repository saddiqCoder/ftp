<?php

// $msg = [];
// $msg['error'] = "true";

// if(isset($_FILES['files_upload'])){

//     for($count = 0; $count < count($_FILES['files_upload']['name']); $count++){
//         $ext = pathinfo($_FILES['files_upload']['name'][$count], PATHINFO_EXTENSION);
//         $newfilename = uniqid() . '.' . $ext;

//         if (move_uploaded_file($_FILES['files_upload']['tmp_name'][$count], 'files/'.$newfilename)){
//             $msg['error'] = "false";
//         }else{
//             $msg['error'] = $_FILES['files_upload']['error'][$count];
//         }
//     }

    
//     echo json_encode($msg);
// }else{
//     echo json_encode($msg);
// }

// $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
// echo json_encode($arr)[2];

?>