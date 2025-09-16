<?php


if(isset($_FILES['file'])){
echo "hello";
}

// $msg = [];
// $msg['error'] = "true";

// if(isset($_FILES['uploadedFiles'])){

//     for($count = 0; $count < count($_FILES['uploadedFiles']['name']); $count++){
//         $ext = pathinfo($_FILES['uploadedFiles']['name'][$count], PATHINFO_EXTENSION);
//         $newfilename = uniqid() . '.' . $ext;

//         if (move_uploaded_file($_FILES['uploadedFiles']['tmp_name'][$count], 'files/'.$newfilename)){
//             $msg['error'] = "false";
//         }else{
//             $msg['error'] = $_FILES['uploadedFiles']['error'][$count];
//         }
//     }

    
//     return json_encode($msg);
// }else{
//     return json_encode($msg);
// }

// $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
// echo json_encode($arr)[2];

?>