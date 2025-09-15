
function byId(elemnt){
    return document.getElementById(elemnt);
}

function byTag(elemnt){
    return document.getElementsByTagName(elemnt);
}

function byClass(elemnt){
    return document.getElementsByClassName(elemnt);
}

function byQuery(elemnt){
    return document.querySelector(elemnt);
}

function byQueryAll(elemnt){
    return document.querySelectorAll(elemnt);
}

function toConsole (elemnt){
    console.log (elemnt);
}


function showMsg(status, msg){
    let getAlert = byQuery('.alert');
    getAlert.classList.remove('.d-none');
    getAlert.classList.add(status);
    getAlert.querySelector('span.msg').textContent = msg;
}

// Getting some UI Element 
let btnFile = byQuery(".files");
let btnBrowseFile = byQuery(".mainFileUpload [type='button']");
let dropBox = byQuery(".uploadForm");
let preview = byQuery(".preview");
const progressStatus = byId("progress_status");
const progressBar = byQuery(".progress-bar");

let fileFormat = [
    'image/jpeg', 'image/png', 
    'audio/mpeg', 
    'video/mp4', 'video/x-matroska', 'video/quicktime', 'video/avi'
];

// Opening file Explorer when user click on Browse File Btn
btnBrowseFile.addEventListener("click", (e) => {
    e.preventDefault();
    btnFile.click();
});

 // Handle file selection
btnFile.addEventListener("change", (e) => {
    handleFiles(btnFile.files);
    // console.log(e.target.files);
});

 // Drag & Drop events
dropBox.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropBox.classList.add("dragover");
});

dropBox.addEventListener("dragleave", () => {
      dropBox.classList.remove("dragover");
});

dropBox.addEventListener("drop", (e) => {
    e.preventDefault();
    dropBox.classList.remove("dragover");
    handleFiles(e.dataTransfer.files);
    // console.log(e.dataTransfer.files[0]);
});

// Handle selected files
function handleFiles(files) {
    preview.innerHTML = ""; // Clear previous
    for (let file of files) {
        const item = document.createElement("div");
        item.classList.add("file-item");

        // If image, show preview
        if (file.type.startsWith("image/")) {
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            item.appendChild(img);
        }

        // Show file info
        const info = document.createElement("p");
        info.textContent = `${file.name} (${Math.round(file.size / 1024)} KB)`;
        item.appendChild(info);

        preview.appendChild(item);
    }
    
    // creating and object of formData to hold file and details submitted
    let form_data = new FormData();

    // initializing some variable 
    let file_items_counter = 1;
    let errorMsg = '';


    // Making sure that user has selected file before uploading
    if (btnFile.files.length > 0){

        for (let count = 0; count < btnFile.files.length; count++){

            if (!fileFormat.includes(btnFile.files[count].type)){    
                showMsg('alert-danger','Invalid Image, video OR audio format. Uploading Fail');
                btnFile.value = '';
            }else{
                form_data.append("uploadedFiles[]", btnFile.files[count]);
                showMsg('alert-success', `${btnFile.files[count].name} added Successfully`);
                // form_data.forEach(function(elemnt){
                //     toConsole(elemnt);
                // });
                toConsole(btnFile.files[count]);
            }
            toConsole(btnFile.files[count]);
            file_items_counter++;
        }

        // If errorMsg is not empty, then there is an error
        if (errorMsg !== ''){
            showMsg('alert-danger', 'Oops... File Format Not Supported. Uploading Fail');
            btnFile.value = '';
        }else{

            // Show the progress bar
            byQuery('.progress_container').classList.remove('d-none');
            byQuery('.progress_container').classList.add('d-block');

            // Ajax request to upload file to server
            const xmlrequest = new XMLHttpRequest();
            xmlrequest.open('POST', 'ftp.php', true);
            xmlrequest.upload.addEventListener('progress', (resp) =>{
                // console.log(JSON.parse(this.responseText));
                let percent_complete = Math.round((resp.loaded / resp.total) * 100);
                progressBar.style.width = `${percent_complete}%`;
                progressBar.style.backgroundColor =  `${percent_complete}%` == '100%' ? 'green' : 'red'; 
                progressBar.innerHTML = percent_complete + " % completed";

            });
            xmlrequest.upload.addEventListener('load', function(evnt){
                console.log(JSON.parse(this.responseText));
                xmlrequest.onreadystatechange = function(e){
                    if(this.readyState == 4 && this.status == 200){
                        showMsg('alert-success', `File Uploaded Successfuly`);
                        btnFile.value = '';
                    }
                }
            });
            xmlrequest.send(form_data);
        }

    }else {
        showMsg('alert-danger', 'Oops...Please select file to upload');
        btnFile.value = '';
        return false;
    }

}

// Getting and checking if the Post Btn is click
// byId('Post_files').onclick = function (evnt){
    
    

// }


// function getForm(e){
//     const filesObject = e.target.previousElementSibling.files;
//     let fileCounter = 0;
//     let number_of_file = 0;
//     let errorMsg = '';
//     let form_data = new FormData();
//     const progressStatus = document.getElementById("progress_status");
//     const progressBarCon = document.querySelector(".progress_status_container");
//     const progressBar = document.querySelector(".progress_bar");

//     for(fileCounter; fileCounter < filesObject.length; fileCounter++){
//         if (!['image/jpeg', 'image/png', 'audio/mpeg', 'video/mp4', 'video/x-matroska', 'video/quicktime', 'video/avi'].includes(
//             filesObject[fileCounter].type
//         )){    
//             errorMsg = `
//             <div class="container progress_status_container file_status_fail" id= "progress_status_container" >
//              <div class="progress_status file_status_fail"> Invalid Image, video OR audio format. Uploading Fail </div>
//             </div>
//              `;
//              progressStatus.innerHTML = errorMsg;
//             // console.log(msgBoxContainer);
//             // alert("Error");
//             console.log("Error");
//         }else{
//             form_data.append("files_upload[]", filesObject[fileCounter]);
//             number_of_file++;
//             // console.log(filesObject[fileCounter]);
//             console.log(form_data.getAll("files_upload"));

//             errorMsg = `
//             <div class="container progress_status_container file_status_success" id= "progress_status_container" >
//                 <div class="progress_status file_status_success"> File Uploaded Successfuly </div>
//             </div>
//              `;
//              progressStatus.innerHTML = errorMsg;
//         }
//     }

//     // if (errorMsg == '' && number_of_file <= 0){
//     //     msgBoxContainer.style.display = "block";
//     //     e.target.previousElementSibling.value = "";
//     //     console.log(fileList);
//     // }else{
        
//     //     // e.target.previousElementSibling.value = "";

//     //     const xml = new XMLHttpRequest();
//     //     xml.open("POST", "post.php");
//     //     xml.upload.addEventListener("progress", function(e){
//     //         progressBarCon.style.display = "block";
//     //         const thiss = e;
//     //         let upload_status = Math.round((thiss.loaded / thiss.total) * 100);
//     //         progressBar.style.width = upload_status +  " %";
//     //         console.log(upload_status);
//     //         // xml.onreadystatechange = function(e){
//     //         //     if(this.readyState == 4 && this.status == 200){
//     //         //             // if (){
//     //         //             let upload_status = Math.round(thiss.loaded / thiss.total * 100); 
//     //         //             progressBar.style.width = upload_status + " %";
//     //         //             progressBar.style.innerHTML = upload_status + " % Completed";
//     //         //             // }else{

//     //         //             // }

//     //         //             // console.log(JSON.parse(this.responseText));

//     //         //     }
//     //         // }
//     //     });

//     //     xml.send(form_data, true);
//     // }


//     e.preventDefault();
// }