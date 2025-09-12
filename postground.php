<!DOCTYPE html>
<html>
<head>
   <title>Home</title>
   <meta charset="utf-8"/>
   <!-- <link rel="stylesheet" href="css/gen.css"/>
   <link rel="stylesheet" href="css/gen2.css"/> -->
   <link rel="stylesheet" href="css/style.css"/>
   <link rel="stylesheet" href="bootstrap-5.3.8-dist/css/bootstrap.css">
</head>
<body>
<div id="" class="container-fluid bg-dark-subtle p-5">

   <div class="contaier bg-danger ">
      <div id="logs_container" class="row p-5 card">
            <div class="upload_form_container">
            <div class="upload_form">
                    <div class="min_divider">
                        <label class="lb" for="file_upload">SELECT FILES TO UPLOAD:</label>
                        <input type="file" class="files" id="file_upload" name="file_upload" width="100%" multiple />
                        <input type="submit" value="POST" name="POST" class="post_files" id="Post_files">
                    </div>
            </div>
            </div>

            <div class="progress_container">
                <div class="progress_bar_container" id="progress_bar_container">
                    <div class="progress_bar" id="progress_bar">0%</div>
                </div>
            </div>

            <div class="progress_status" id="progress_status" width="100%">
                <!-- <div class="container progress_status_container file_status_success" id= "progress_status_container" >
                    <div class="progress_status file_status_success"> File Uploaded Successfuly </div>
                </div>

                <div class="container progress_status_container file_status_fail" id= "progress_status_container" >
                    <div class="progress_status file_status_fail"> File Uploaded Fail </div>
                </div> -->
            </div>
      </div>
   </div>


    <!-- FOOTER START -->
        <footer id="contact" class="container-fluid contactsContainer py-5">
            <div class="bag footer-content container p-5">
            <p class="contactsIcon p-3 text-center d-block">
                <a href="https://www.linkedin.com/in/sadiq-abdulazeez-687a1b350?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" class="smallIcons"><i class="fa-brands fa-linkedin smallIconLinkedin fs-2"></i></a>
                <a href="https://wa.me/08104086611" class="smallIcons"><i class="fa-brands fa-whatsapp smallIconWhatsapp fs-2"></i></a>
                <a href="https://www.pinterest.com/akonfex/" class="smallIcons"><i class="fa-brands fa-pinterest smallIconPinterest fs-2"></i></a>
            </p>
            <a href="#" class="copywrite d-block text-center text-light text-decoration-none">Develop with ❤ By Sadiq</a>
            <p class="site_date text-center d-block">2021 - <?php echo date("Y", time())?></p>
        </div>
        </footer>
    <!-- FOOTER END -->
</div>

<script src="bootstrap-5.3.8-dist/js/bootstrap.js"></script>
<script src="https://kit.fontawesome.com/1f1ec3e39a.js" crossorigin="anonymous"></script>
<script src="script/app.js"></script>
</body>
</htm>