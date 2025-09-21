<?php
// This is upload handler file
// It will receive files from appTest.js and process it

function out ($out){
    echo $out;
}

$tempArray = [];

if (count($_FILES) > 0){

    // handling multiple files
    foreach($_FILES as $fileItem => $file){
        $counter = count($_FILES);
        
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];  
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

        $tempArray["file-".$counter] = array(
            "name" => $fileName,
            "type" => $fileType,
            "size" => $fileSize,
            "tmp_name" => str_ireplace('\\', '/', $fileTmpName),
            "error" => $fileError
        );

        $counter--;
    }

  print_r($tempArray);
}

//print_r($tempArray);

// print_r(json_encode($tempArray, true));
// $tempArray['file-1'] = array(
//     "name" => 'sadiq',
//     "size" => '123',
//     "error" => 'bigbook.jpg is too large'
// );

// $tempArray['file-2'] = array(
//     "name" => 'abdulazeez',
//     "size" => '456',
//     "error" => 'profile.png is too large'
// );

// $tempArray['file-3'] = array(
//     "name" => 'akonfex',
//     "size" => '789',
//     "error" => 'video.mp4 is too large'
// );



//$text = '[{"name":"Desktop 11-09-2025 2-11-40 am.mp4","type":"video\/mp4","size":".42896531.","tmp_name":"C:\/xampp\/tmp\/php855D.tmp","error":".0."},{"name":"Screen Shot 2025-09-11 at 01.28.34.png","type":"image\/png","size":".1483169.","tmp_name":"C:\/xampp\/tmp\/php8714.tmp","error":".0."},{"name":"Screen Shot 2025-09-11 at 01.30.04.png","type":"image\/png","size":".1446632.","tmp_name":"C:\/xampp\/tmp\/php8724.tmp","error":".0."},{"name":"Screen Shot 2025-09-11 at 01.30.47.png","type":"image\/png","size":".2288830.","tmp_name":"C:\/xampp\/tmp\/php8735.tmp","error":".0."},{"name":"Screen Shot 2025-09-11 at 01.31.02.png","type":"image\/png","size":".1730277.","tmp_name":"C:\/xampp\/tmp\/php8736.tmp","error":".0."}]';
// $tempToJson = json_decode($tempArray);
//echo $text;


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