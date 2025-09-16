<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Upload Limit Configuration</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px 0;
        }
        
        header {
            background: #4b6cb7;
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
        }
        
        .subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .content {
            padding: 30px;
        }
        
        .error-box {
            background: #ffecec;
            border-left: 5px solid #ff5252;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
            font-family: monospace;
            font-size: 1.1rem;
        }
        
        .solution-section {
            margin: 30px 0;
        }
        
        h2 {
            color: #4b6cb7;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #eaeaea;
        }
        
        h3 {
            color: #3a5999;
            margin: 20px 0 10px;
        }
        
        p {
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        .code-block {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            margin: 20px 0;
            font-family: monospace;
            font-size: 1rem;
            line-height: 1.5;
        }
        
        .code-comment {
            color: #75715e;
        }
        
        .important {
            background: #fff9e6;
            border-left: 5px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        
        .steps {
            margin-left: 20px;
            margin-bottom: 20px;
        }
        
        .steps li {
            margin-bottom: 10px;
            line-height: 1.6;
        }
        
        .config-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .config-table th, .config-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        
        .config-table th {
            background-color: #f2f2f2;
        }
        
        .config-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .value-highlight {
            background-color: #e7f4e4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
        
        footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .container {
                border-radius: 10px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .content {
                padding: 20px;
            }
            
            .config-table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>PHP Upload Limit Configuration</h1>
            <p class="subtitle">How to set upload_max_filesize to 2GB in php.ini</p>
        </header>
        
        <div class="content">
            <p>When you need to upload large files (up to 2GB) with PHP, you need to modify several configuration settings in your php.ini file.</p>
            
            <div class="error-box">
                <b>Warning</b>: POST Content-Length of 2147483648 bytes exceeds the limit of 8388608 bytes in <b>Unknown</b> on line <b>0</b>
            </div>
            
            <div class="solution-section">
                <h2>Configuring php.ini for 2GB Uploads</h2>
                
                <div class="important">
                    <p><strong>Important:</strong> Setting upload limits to 2GB requires modifying multiple directives in your php.ini file.</p>
                </div>
                
                <h3>Step 1: Locate your php.ini file</h3>
                <p>First, you need to find the active php.ini file. You can create a PHP file with the following content and access it via your web browser:</p>
                
                <div class="code-block">
                    <span class="code-comment"><?php phpinfo(); ?></span>
                </div>
                
                <p>Look for "Loaded Configuration File" in the output to find the path to your php.ini file.</p>
                
                <h3>Step 2: Modify the necessary directives</h3>
                <p>Open php.ini in a text editor and change the following settings:</p>
                
                <div class="code-block">
                    <span class="code-comment">; Maximum allowed size for uploaded files (2GB)</span><br>
                    upload_max_filesize = 2G<br><br>
                    
                    <span class="code-comment">; Must be greater than or equal to upload_max_filesize (2GB)</span><br>
                    post_max_size = 2G<br><br>
                    
                    <span class="code-comment">; Maximum execution time for each script (5 minutes)</span><br>
                    max_execution_time = 300<br><br>
                    
                    <span class="code-comment">; Maximum input time for each script (5 minutes)</span><br>
                    max_input_time = 300<br><br>
                    
                    <span class="code-comment">; Maximum memory per script (256MB - adjust as needed)</span><br>
                    memory_limit = 256M<br>
                </div>
                
                <h3>Step 3: Save and restart your web server</h3>
                <p>After making these changes, save the php.ini file and restart your web server for the changes to take effect.</p>
                
                <div class="code-block">
                    <span class="code-comment"># For Apache on Ubuntu/Debian:</span><br>
                    sudo systemctl restart apache2<br><br>
                    
                    <span class="code-comment"># For Apache on CentOS/RHEL:</span><br>
                    sudo systemctl restart httpd<br><br>
                    
                    <span class="code-comment"># For Nginx with PHP-FPM:</span><br>
                    sudo systemctl restart php-fpm<br>
                    sudo systemctl restart nginx
                </div>
            </div>
            
            <div class="solution-section">
                <h2>Important Considerations</h2>
                
                <table class="config-table">
                    <tr>
                        <th>Setting</th>
                        <th>Recommended Value</th>
                        <th>Purpose</th>
                    </tr>
                    <tr>
                        <td>upload_max_filesize</td>
                        <td class="value-highlight">2G</td>
                        <td>Maximum size of a single uploaded file</td>
                    </tr>
                    <tr>
                        <td>post_max_size</td>
                        <td class="value-highlight">2G</td>
                        <td>Maximum size of POST data (must be ≥ upload_max_filesize)</td>
                    </tr>
                    <tr>
                        <td>max_execution_time</td>
                        <td class="value-highlight">300</td>
                        <td>Maximum time a script can run (in seconds)</td>
                    </tr>
                    <tr>
                        <td>max_input_time</td>
                        <td class="value-highlight">300</td>
                        <td>Maximum time to parse input data (in seconds)</td>
                    </tr>
                    <tr>
                        <td>memory_limit</td>
                        <td class="value-highlight">256M</td>
                        <td>Maximum memory a script can consume</td>
                    </tr>
                </table>
                
                <div class="important">
                    <p><strong>Note:</strong> The actual values you need may vary based on your server's resources and requirements. Very large uploads may require even higher values for time and memory limits.</p>
                </div>
                
                <h3>Additional Server Considerations</h3>
                <p>When dealing with 2GB uploads, you may also need to consider:</p>
                
                <ol class="steps">
                    <li><strong>Web server timeout settings</strong> - Apache and Nginx have their own timeout settings that might need adjustment</li>
                    <li><strong>PHP handler configuration</strong> - If using suPHP or other handlers, they may have additional restrictions</li>
                    <li><strong>Disk space</strong> - Ensure you have enough free space in the temporary upload directory</li>
                    <li><strong>Network limitations</strong> - Large uploads may be affected by network timeouts or limitations</li>
                </ol>
            </div>
            
            <div class="solution-section">
                <h2>Verifying Your Changes</h2>
                <p>After making changes and restarting your web server, create a PHP file with the following code to verify your new settings:</p>
                
                <div class="code-block">
                    <span class="code-comment"><?php
                    echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
                    echo "post_max_size: " . ini_get('post_max_size') . "<br>";
                    echo "max_execution_time: " . ini_get('max_execution_time') . "<br>";
                    echo "max_input_time: " . ini_get('max_input_time') . "<br>";
                    echo "memory_limit: " . ini_get('memory_limit') . "<br>";
                    ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <p>Note: These are general guidelines. The exact steps may vary depending on your server environment.</p>
        <p>© 2023 PHP Upload Limit Configuration Guide</p>
    </footer>
</body>
</html>