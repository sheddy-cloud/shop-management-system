<?php
// Production Server Configuration
if(!defined('base_url')) define('base_url','http://13.60.250.20/sms/');
if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );

// Database Configuration
if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
if(!defined('DB_USERNAME')) define('DB_USERNAME',"root");
if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"");
if(!defined('DB_NAME')) define('DB_NAME',"sms_db");

// Additional Configuration Constants
if(!defined('SITE_NAME')) define('SITE_NAME',"Stock Management System");
if(!defined('SITE_SHORT_NAME')) define('SITE_SHORT_NAME',"SMS");
if(!defined('VERSION')) define('VERSION',"1.0.0");

// Timezone Configuration
if(!defined('TIMEZONE')) define('TIMEZONE',"Asia/Manila");

// File Upload Configuration
if(!defined('UPLOAD_PATH')) define('UPLOAD_PATH',"uploads/");
if(!defined('MAX_FILE_SIZE')) define('MAX_FILE_SIZE',5242880); // 5MB

// Security Configuration
if(!defined('SESSION_TIMEOUT')) define('SESSION_TIMEOUT',3600); // 1 hour
if(!defined('PASSWORD_MIN_LENGTH')) define('PASSWORD_MIN_LENGTH',3);

// Error Reporting (Set to false for production)
if(!defined('DEBUG_MODE')) define('DEBUG_MODE',false);

// Set error reporting based on debug mode
if(DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>