<?php
// This is upload handler file
// It will receive files from appTest.js and process it

function out ($out){
    echo $out;
}

$tempArray = [];


if (count($_FILES) > 0){
    
    $counter = count($_FILES)-1;
    $i = 0;

    // handling multiple files
    while ($i <= $counter){

        $fileName = $_FILES["file-".$i]['name'];
        $fileType = $_FILES["file-".$i]['type'];
        $fileSize = $_FILES["file-".$i]['size'];  
        $fileTmpName = $_FILES["file-".$i]['tmp_name'];
        $fileError = $_FILES["file-".$i]['error'];

         $tempArray["file-".$i] = array(
            "name" => "$fileName",
            "size" => "$fileSize"
        );

        // Process each file and move to the files folder
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newfilename = uniqid() . '.' . $ext;

        if (move_uploaded_file($fileTmpName, 'files/'.$newfilename)){
            $tempArray["file-".$i]["error"] = $tempArray["file-".$i]['name']." has been successfuly Uploaded";
        }else{
            $tempArray["file-".$i]["error"] = "$fileError";
        }

        $i++;
    }

  print_r(json_encode($tempArray));
// print_r($tempArray);
}


?>