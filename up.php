<?php

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
            echo $fileName[$i] . "<br>";
            echo $fileType[$i] . "<br>";
            echo $fileSize[$i] . "<br>";
            echo $fileTmpName[$i] . "<br>";
            echo $fileError[$i] . "<br><br>";
        }

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