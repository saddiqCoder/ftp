<?php

// foreach (){

// }

if (isset($_POST['file'])){
    foreach($_FILES as $fileItem => $file){
        $counter = count($file['name']);
        

        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];  
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        
        // $fileExt = explode('.', $fileName);
        // $fileActualExt = strtolower(end($fileExt));
        // $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'mp4');

        for($i = 0; $i < $counter; $i++){
            echo $fileName[$i] . "<br>";
            echo $fileType[$i] . "<br>";
            echo $fileSize[$i] . "<br>";
            echo $fileTmpName[$i] . "<br>";
            echo $fileError[$i] . "<br><br>";
        }

    }
    
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