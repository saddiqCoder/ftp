### 📂 FTP – Powerful File Uploading Machine
This project provides a **powerful PHP + HTML5 file uploading system** with support for:
- Multiple file uploads
- Error handling with user-friendly pages
- PHP upload limit troubleshooting
- Bootstrap 5 frontend for clean UI



### ⚡ Features
- Upload multiple files at once
- Server-side handling with PHP (`ftp.php`)
- Frontend form with Bootstrap (`upload.php`)
- File size/limit troubleshooting (`fixFileError.php`, `fileError.html`)
- Lightweight — no heavy external dependencies



### 📋 Requirements
- **PHP 7.4+** (tested up to PHP 8.2)
- A web server (Apache, Nginx, or PHP’s built-in server)
- Browser with HTML5 support
- (Optional) Node.js if you want to use the included `package.json`

  

## 🛠 Installation
### 1. Download and extract the .zip file

### 2. Setup PHP Server
If you don’t have a server yet, you can run PHP’s built-in server: php -S localhost:8000 -t ftp/
This serves the project at http://localhost:8000

### 3. File Upload Directory
Make sure the directory where files are uploaded is writable.
Usually, uploaded files are stored in tmp/ or a configured folder inside ftp.php.

### 4. Adjust PHP Upload Limits
Edit your php.ini and set:
upload_max_filesize = 50M
post_max_size = 100M
max_file_uploads = 20

Restart Apache/Nginx or PHP server afterwards.
If you run into issues, open fixFileError.php or fileError.html for guidance.

### 🚀 Usage
Open the Upload Form visit: http://localhost:8000/upload.php

You’ll see a Bootstrap-powered upload form.

- Upload Files
- Select one or more files.
- Click Upload.
- Files are sent to ftp.php which processes them on the server.

## Backend (ftp.php)
- Handles $_FILES array
- Loops through all uploaded files
- Can be customized to move files to a permanent directory

### 🔧 Troubleshooting
❌ File Too Large
Increase limits in php.ini (see Installation step 4).

Verify fileError.html instructions.
❌ Permission Denied
Ensure the upload directory has write permissions:

### 📚 Project Structure
ftp/
│── ftp.php              # Main upload handler (PHP)

│── upload.php           # HTML frontend with Bootstrap
│── fixFileError.php     # PHP upload limit configuration guide
│── fileError.html       # Static HTML guide for fixing errors
│── package.json         # Node.js metadata (optional)
│── .git/                # Git repo files


### 💡 Customization
- Change upload directory:
Edit ftp.php → move files from $_FILES['tmp_name'] to your custom folder.

- Add frontend validation:
Extend upload.php with JavaScript to check file size or type before sending.

- Style UI:
Modify css/style.css or Bootstrap classes.


### 📦 Dependencies
- Bootstrap 5.3.8 (local copy included)
- PHP core extensions (file_uploads must be enabled)
