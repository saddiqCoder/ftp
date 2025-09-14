
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


function showMsg(parent, status, msg){
    errorMsg = `
        <div class="container progress_status_container ${status}" id="progress_status_container" >
        <div class="progress_status file_status_fail"> ${msg} </div>
        </div>
    `;

    byId(parent).innerHTML = errorMsg;

    setTimeout(function(){
        byId(parent).innerHTML = "";
    }, 3000);
}

let btnFile = byQuery(".files");
let btnBrowseFile = byQuery(".mainFileUpload [type='button']");
let dropBox = byQuery(".uploadForm");
let preview = byQuery(".preview");

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

}

// Getting and checking if the Post Btn is click
byId('Post_files').onclick = function (evnt){

    // creating and object of formData to hold file and details submitted
    let form_data = new FormData();
    
    // initializing some variable 
    let image_number = 1;
    let errorMsg = '';

    // Getting some UI Element 
    const progressStatus = byId("progress_status");
    const progressBarCon = byQuery(".progress_status_container");

    // Getting and checking if the Post Btn is click and making sure file is not empty
    if (byId('file_upload').files.length > 0){

        for (let count = 0; count < byId('file_upload').files.length; count++){

            if (!['image/jpeg', 'image/png', "audio/mpeg","video/mp4", "video/x-matroska", "video/quicktime", "video/avi" ].includes(
                byId('file_upload').files[count].type)
            ){    
                showMsg('progress_status', 'file_status_fail', 'Invalid Image, video OR audio format. Uploading Fail');
                byId('file_upload').value = '';
                errorMsg = true;
                //return false;
            }else{
                form_data.append("images[]", byId('file_upload').files[count]);
                // showMsg('progress_status', 'file_status_success', 'File Uploaded Successfuly');
                // form_data.forEach(function(elemnt){
                //     toConsole(elemnt);
                // });

                toConsole(byId('file_upload').files[count]);
            }

            image_number++;
        }

        if (errorMsg !== ''){
            showMsg('progress_status', 'file_status_fail', 'Oops..Inappropraite File Format');
            byId('file_upload').value = '';
        }else{
            
            byId('progress_bar_container').style.display = "block";
            const xmlrequest = new XMLHttpRequest();
            xmlrequest.open('POST', 'post.php', true);
            xmlrequest.upload.addEventListener('progress', function (evnt){
                // console.log(JSON.parse(this.responseText));
                let percent_complete = Math.round((evnt.loaded / evnt.total) * 100);
                byId('progress_bar').style.width = `${percent_complete}%`;
                byId('progress_bar').style.backgroundColor =  `${percent_complete}%` == '100%' ? 'green' : 'red'; 
                byId('progress_bar').innerHTML = percent_complete + " % completed";

            });

            showMsg('progress_status', 'file_status_success', 'File Uploaded Successfuly');
            byId('file_upload').value = '';

            xmlrequest.addEventListener('load', function(evnt){
                // errorMsg = `
                // <div class="container progress_status_container file_status_success" id= "progress_status_container" >
                //     <div class="progress_status file_status_success"> File Uploaded Successfuly </div>
                // </div>
                // `;
                // progressStatus.innerHTML = errorMsg;
                // byId('file_upload').files.value = "";
                // console.log(JSON.parse(this.responseText));
                // xmlrequest.onreadystatechange = function(e){
                //     if(this.readyState == 4 && this.status == 200){
                //         
                //     }
                // }

            });

            xmlrequest.send(form_data);
        }

    }else {
        showMsg('progress_status', 'file_status_fail', 'Oops...Please select file to upload');
        byId('file_upload').value = '';
        return false;
    }

}


function getForm(e){
    const filesObject = e.target.previousElementSibling.files;
    let fileCounter = 0;
    let number_of_file = 0;
    let errorMsg = '';
    let form_data = new FormData();
    const progressStatus = document.getElementById("progress_status");
    const progressBarCon = document.querySelector(".progress_status_container");
    const progressBar = document.querySelector(".progress_bar");

    for(fileCounter; fileCounter < filesObject.length; fileCounter++){
        if (!['image/jpeg', 'image/png', 'audio/mpeg', 'video/mp4', 'video/x-matroska', 'video/quicktime', 'video/avi'].includes(
            filesObject[fileCounter].type
        )){    
            errorMsg = `
            <div class="container progress_status_container file_status_fail" id= "progress_status_container" >
             <div class="progress_status file_status_fail"> Invalid Image, video OR audio format. Uploading Fail </div>
            </div>
             `;
             progressStatus.innerHTML = errorMsg;
            // console.log(msgBoxContainer);
            // alert("Error");
            console.log("Error");
        }else{
            form_data.append("files_upload[]", filesObject[fileCounter]);
            number_of_file++;
            // console.log(filesObject[fileCounter]);
            console.log(form_data.getAll("files_upload"));

            errorMsg = `
            <div class="container progress_status_container file_status_success" id= "progress_status_container" >
                <div class="progress_status file_status_success"> File Uploaded Successfuly </div>
            </div>
             `;
             progressStatus.innerHTML = errorMsg;
        }
    }

    // if (errorMsg == '' && number_of_file <= 0){
    //     msgBoxContainer.style.display = "block";
    //     e.target.previousElementSibling.value = "";
    //     console.log(fileList);
    // }else{
        
    //     // e.target.previousElementSibling.value = "";

    //     const xml = new XMLHttpRequest();
    //     xml.open("POST", "post.php");
    //     xml.upload.addEventListener("progress", function(e){
    //         progressBarCon.style.display = "block";
    //         const thiss = e;
    //         let upload_status = Math.round((thiss.loaded / thiss.total) * 100);
    //         progressBar.style.width = upload_status +  " %";
    //         console.log(upload_status);
    //         // xml.onreadystatechange = function(e){
    //         //     if(this.readyState == 4 && this.status == 200){
    //         //             // if (){
    //         //             let upload_status = Math.round(thiss.loaded / thiss.total * 100); 
    //         //             progressBar.style.width = upload_status + " %";
    //         //             progressBar.style.innerHTML = upload_status + " % Completed";
    //         //             // }else{

    //         //             // }

    //         //             // console.log(JSON.parse(this.responseText));

    //         //     }
    //         // }
    //     });

    //     xml.send(form_data, true);
    // }


    e.preventDefault();
}