<?php
header('Content-Type: application/json');

// Simple test endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array(
        'status' => 'success',
        'message' => 'AJAX test successful',
        'received_data' => $_POST
    );
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Only POST requests allowed'
    );
    echo json_encode($response);
}
?>

