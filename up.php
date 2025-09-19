<?php
$tempArray = [];
// $tempArray[0] = ['name' => 'Sadiq', 'age' => 22, 'country' => 'Nigeria'];
// $tempArray[1] = ['name' => 'Abdulazeez', 'age' => 25, 'country' => 'Nigeria'];
// $tempToJson = json_encode($tempArray, true);
// print_r(json_decode($tempToJson)[0]->name);

if (isset($_POST['submit'])){
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
            $tempArray[$i] = array(
                "name" => $fileName[$i],
                "type" => $fileType[$i],
                "size" => ".$fileSize[$i].",
                "tmp_name" => str_ireplace('\\', '/', $fileTmpName[$i]),
                "error" => ".$fileError[$i]."
            );
        }

        $tempToJson = json_encode($tempArray, true);
        print_r($tempToJson);

    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="file[]" class="file" multiple>
    <input type="submit" name="submit" class="submit">
</form>
    
</body>
</html>