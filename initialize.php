<?php
// Load .env file
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0 || strpos($line, '=') === false) continue;
        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

// Developer info (unchanged)
$dev_data = array(
    'id' => '-1',
    'firstname' => 'shed',
    'lastname' => '',
    'username' => 'sheddy-cloud',
    'password' => '201918',
    'last_login' => '',
    'date_updated' => '',
    'date_added' => ''
);

// Define constants from .env
if (!defined('base_url')) define('base_url', $_ENV['BASE_URL'] ?? 'http://localhost/');
if (!defined('base_app')) define('base_app', str_replace('\\', '/', __DIR__) . '/');
if (!defined('dev_data')) define('dev_data', $dev_data);
if (!defined('DB_SERVER')) define('DB_SERVER', $_ENV['DB_SERVER'] ?? 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', $_ENV['DB_USERNAME'] ?? 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', $_ENV['DB_PASSWORD'] ?? '');
if (!defined('DB_NAME')) define('DB_NAME', $_ENV['DB_NAME'] ?? 'sms_db');
?>
