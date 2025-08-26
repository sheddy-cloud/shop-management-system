<?php
// Test script to verify JSON responses work correctly
require_once('config.php');

// Clear any output buffers
while (ob_get_level()) {
    ob_end_clean();
}

// Set JSON header
header('Content-Type: application/json');

// Test response
$response = array(
    'status' => 'success',
    'message' => 'JSON test successful',
    'timestamp' => date('Y-m-d H:i:s')
);

echo json_encode($response);
exit;
?>




