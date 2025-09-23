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
    // progressDiv.classList.remove('d-none');
    // progressDiv.classList.add('d-block');

    //console.log(progressStatus.appendChild(progressDiv));
}

// Getting some UI Element 
let btnFile = byQuery(".files");
let btnBrowseFile = byQuery(".mainFileUpload [type='button']");
let dropBox = byQuery(".uploadForm");
let preview = byQuery(".preview");

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

    // preview.innerHTML = ""; // Clear previous previews

    // Making sure that user has selected file before uploading
    if (files.length > 0){

        //Checking and Validating File before upload
        filesValidatorHandler(files);

        //creating Preview of the current file
        //handleFilesPreview(files);

        // uploading/sending files to server (ftp.php) for uploading
        //uploadingFiles (form_data);
  
    }else {
        showMsg('alert-danger', 'Oops...Please select file to upload');
        btnFile.value = '';
        return false;
    }

}

function filesValidatorHandler (files){
    // creating object of formData to hold file and details submitted
        let form_data = new FormData();

        for (let count = 0; count < files.length; count++){

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
                toConsole(form_data.getAll(`file-${count}`));
            }
        }
}

function handleFilesPreview (file){
        const item = document.createElement("div");
        item.classList.add("file-item");

        // If image, show preview
            if (file.type.startsWith("image/")) {
                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                item.appendChild(img);
            }
        //end If image, show preview

        // Show file info
        const info = document.createElement("p");
        info.textContent = `${file.name} (${Math.round(file.size / 1024)} KB)`;
        item.appendChild(info);

        preview.appendChild(item);
}



function uploadedFiles(form_data) {
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

        xmlrequest.upload.addEventListener('load', () => {
            
            console.log(JSON.parse(this.responseText));

            xmlrequest.onreadystatechange = () => {
                if(this.readyState == 4 && this.status == 200){
                    showMsg('alert-success', `File Uploaded Successfuly`);
                    btnFile.value = '';
                } 
            }

        });

        xmlrequest.send(form_data);
}
