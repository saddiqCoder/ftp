<!DOCTYPE html>
<html>
<head>
   <title>Home</title>
   <meta charset="utf-8"/>
   <!-- <link rel="stylesheet" href="css/gen.css"/>
   <link rel="stylesheet" href="css/gen2.css"/> -->
   <link rel="stylesheet" href="bootstrap-5.3.8-dist/css/bootstrap.css">
   <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div id="" class="container-fluid bg-dark-subtle p-5 ftpFormRoot">
   <div class="contaier row p-5 card ftpFormContainer">
        <div class="uploadFormContainer card-body">
            <div class="closeBtnContainer"><button type="button" class="btn-close" disabled aria-label="Close"></button></div>
            
            <div class="uploadIntro container row p-0 m-0">
                <div class="fileIcon">
                    <i class="fa-regular fa-file fs-5"></i>
                </div>
                <div class="fileText row">
                    <p class="i">Upload Files</p>
                    <p class="i">Select and upload the files of your choice</p>
                </div>
            </div>
            
            <div class="uploadForm container p-5 m-0">
                <div class="container row">
                    <label class="smallFIileIcon" for="file_upload">
                        <i class="fa-regular fa-cloud fs-5"></i>
                    </label>
                    <p class="mainFileUpload">
                        <label class="lb lbSmall">Choose a file or drag & drop it here</label>
                        <label class="lb">JPEG, PNG, PDG, and MP4 formats up to 50MB</label>
                        <input type="file" class="btn files" id="file_upload" name="file_upload" width="100%" multiple />
                    </p>
                </div>
            </div>
        
            <div class="progress_container container p-4 mt-3 bg-opacity-25 bg-dark border border-3 border-dark-subtl rounded-3">
                <div class="pb-2 text-gray fs-5 fw-3">
                    <div class="spinner-border spinner-border-sm"><span class="visually-hidden">Loading...</span></div>
                    <span class="">Uploading...</span>
                </div>

                <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 90%">25%</div>
                </div>
            </div>

            <div class="progress_status container mt-3 px-0" id="progress_status">
                <div class="container-fluid fs-6 p-2 alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <div>
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        An example success alert with an icon
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>

                <div class="container-fluid fs-6 p-2 alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <div>
                        <i class="fa-solid fa-check"></i>
                        An example success alert with an icon
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
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

<script src="bootstrap-5.3.8-dist/js/bootstrap.js"></script>
<script src="https://kit.fontawesome.com/1f1ec3e39a.js" crossorigin="anonymous"></script>
<script src="script/app.js"></script>
</body>
</htm>