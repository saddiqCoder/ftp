// const { createElement } = require("react");

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

function creatPreviewImage(url, fileName, fileSize){
    const item = document.createElement("div");
    item.classList.add("file-item");
    const img = document.createElement("img");

    // Set the source of the image
    if (typeof url === 'string') {
        img.src = url; // For icon paths
    } else {
        img.src = URL.createObjectURL(url); // For File objects
    }
    item.appendChild(img);

    // Show file info
    const info = document.createElement("p");
    info.textContent = `${fileName} (${Math.round(fileSize / 1024)} KB)`;
    item.appendChild(info);

    preview.appendChild(item);
}

function showMsg(status, msg){
    const progressStatus = byId("progress_status");

    var progressDiv = document.createElement("div");
    progressDiv.classList.add("container-fluid", "fs-6", "p-2", "alert", `${status}`, "alert-dismissible", "fade", "show", "d-flex", "align-items-center");
    progressDiv.setAttribute("role", "alert");

    var innerDiv = document.createElement("div");
    progressDiv.appendChild(innerDiv);

    var innerIcon = document.createElement("i");
    innerIcon.classList.add("fa-solid", "fa-check");
    innerDiv.appendChild(innerIcon);

    var innerSpan = document.createElement("span");
    innerSpan.classList.add("msg");
    innerSpan.textContent = msg;
    innerDiv.appendChild(innerSpan);

    var btnClose = document.createElement("button");
    btnClose.classList.add("btn-close");
    btnClose.setAttribute("type", "button");
    btnClose.setAttribute("data-bs-dismiss", "alert");
    btnClose.setAttribute("aria-label", "Close");
    innerDiv.appendChild(btnClose);

    progressStatus.appendChild(progressDiv);
}

// Getting some UI Element 
let btnFile = byQuery(".files");
let btnBrowseFile = byQuery(".mainFileUpload [type='button']");
let dropBox = byQuery(".uploadForm");
let preview = byQuery(".preview");
const progressBar = byQuery(".progress-bar");

// Supported File Formats for upload
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
    // Making sure that user has selected file before uploading
    if (files.length > 0){

        //Checking and Validating File before upload
        filesValidatorHandler(files);
  
    }else {
        showMsg('alert-danger', 'Oops...Please select file to upload');
        btnFile.value = '';
    }

}

function filesValidatorHandler (files){
    // creating object of formData to hold file and details submitted
        let form_data = new FormData();

        // Looping through all files and validating them
            for (let count = 0; count < files.length; count++){
                // Validating file type (extension/format)
                if (!fileFormat.includes(files[count].type)){    
                    showMsg('alert-danger',`${files[count].name} file type is not supported. Not Uploaded`);
                }else{
                    //form_data.append("uploadedFiles", files[count]);
                        showMsg('alert-success', `${files[count].name} added Successfully`);
                    //end if file type is valid

                    // creating Preview of the current file
                        handleFilesPreview (files[count]);
                    //end creating Preview of the current file

                    // Appending the current file to form_data object
                        form_data.append(`file-${count}`, files[count]);
                        uploadedFiles(form_data);
                        toConsole(form_data.getAll(`file-${count}`));
                }
            }
        // End Looping through all files and validating them
}

function handleFilesPreview (file){
    // Extracting file details
        let fileType = file.type;
        let fileName = file.name;
        let fileSize = file.size;
    // End Extracting file details

        // If preview already has some child, clear it
        // if (preview.hasChildNodes()){
        //     preview.innerHTML = "";
        // }

        // Creating Preview of the current file
            switch (true) {
                case fileType.startsWith("image/"):
                    creatPreviewImage(file, fileName, fileSize);
                    break;
                case fileType.startsWith("audio/"):
                    creatPreviewImage("icon/m.png", fileName, fileSize);
                    break;
                case fileType.startsWith("video/"):
                    creatPreviewImage("icon/v.png", fileName, fileSize);
                    break;
                default:
                    creatPreviewImage("icon/f.png", fileName, fileSize);
            }
        // End Creating Preview of the current file

}

function uploadedFiles(form_data) {
        // Ajax request to upload file to server
        const xmlrequest = new XMLHttpRequest();

        xmlrequest.open('POST', 'ftp.php', true);

        xmlrequest.upload.addEventListener('progress', (resp) =>{
            // console.log(JSON.parse(this.responseText));
            // Show the progress bar
            byQuery('.progress_container').classList.remove('d-none');
            byQuery('.progress_container').classList.add('d-block');
            let percent_complete = Math.round((resp.loaded / resp.total) * 100);
            progressBar.style.width = `${percent_complete}%`;
            progressBar.style.backgroundColor =  `${percent_complete}%` == '100%' ? 'green' : 'red'; 
            progressBar.innerHTML = percent_complete + " % completed";

        });

        xmlrequest.upload.addEventListener('load', () => {
            xmlrequest.onreadystatechange = () => {
                // console.log(xmlrequest.responseText);
                // console.log(xmlrequest.readyState);
                // console.log(xmlrequest.status);
                if(xmlrequest.readyState == 4 && xmlrequest.status == 200){
                    console.log(JSON.parse(xmlrequest.responseText));
                    showMsg('alert-success', `File Uploaded Successfuly`);
                    btnFile.value = '';
                } 
            }
        });

        xmlrequest.send(form_data);
}
