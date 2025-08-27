<?php
require_once('config.php');

echo "<h2>🏠 Local Development Test</h2>";

// Test configuration
echo "<h3>📋 Configuration Test:</h3>";
echo "<strong>Base URL:</strong> " . base_url . "<br>";
echo "<strong>Expected:</strong> http://localhost/sms/<br>";
echo "<strong>Database Server:</strong> " . DB_SERVER . "<br>";
echo "<strong>Database Name:</strong> " . DB_NAME . "<br><br>";

// Test database connection
echo "<h3>🗄️ Database Connection Test:</h3>";
try {
    $test_query = $conn->query("SELECT COUNT(*) as count FROM users");
    if ($test_query) {
        $count = $test_query->fetch_assoc()['count'];
        echo "✅ Database connection successful. Found {$count} users.<br>";
    } else {
        echo "❌ Database connection failed.<br>";
    }
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

// Test navigation links
echo "<h3>🔗 Navigation Links Test:</h3>";
$pages = [
    'home' => 'Dashboard',
    'purchase_order' => 'Purchase Order',
    'receiving' => 'Receiving',
    'return' => 'Return List',
    'stocks' => 'Stocks',
    'sales' => 'Sale List',
    'profile' => 'My Profile'
];

echo "<div style='display: flex; flex-wrap: wrap; gap: 10px;'>";
foreach ($pages as $page => $name) {
    $url = base_url . "shop/?page=" . $page;
    echo "<a href='{$url}' style='padding: 8px 12px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;'>{$name}</a>";
}
echo "</div>";

// Test main pages
echo "<h3>🚀 Main Pages Test:</h3>";
$main_pages = [
    'Main App' => base_url,
    'Login' => base_url . 'shop/login.php',
    'Signup' => base_url . 'shop/signup.php',
    'Dashboard' => base_url . 'shop/',
    'Auth Test' => base_url . 'test_auth.php',
    'Navigation Test' => base_url . 'test_navigation_links.php'
];

echo "<div style='display: flex; flex-wrap: wrap; gap: 10px;'>";
foreach ($main_pages as $name => $url) {
    echo "<a href='{$url}' style='padding: 8px 12px; background: #28a745; color: white; text-decoration: none; border-radius: 4px;'>{$name}</a>";
}
echo "</div>";

// Check file existence
echo "<h3>📁 File Structure Test:</h3>";
$required_files = [
    'config.php',
    'initialize.php',
    'shop/index.php',
    'shop/login.php',
    'shop/signup.php',
    'shop/profile.php',
    'classes/Login.php',
    'classes/Users.php',
    'database/sms_db.sql'
];

echo "<ul>";
foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "<li>✅ {$file}</li>";
    } else {
        echo "<li>❌ {$file} (missing)</li>";
    }
}
echo "</ul>";

echo "<h3>🎯 Quick Access:</h3>";
echo "<p>Your Stock Management System should now be accessible at:</p>";
echo "<ul>";
echo "<li><strong>Main Application:</strong> <a href='" . base_url . "' target='_blank'>" . base_url . "</a></li>";
echo "<li><strong>Login Page:</strong> <a href='" . base_url . "shop/login.php' target='_blank'>" . base_url . "shop/login.php</a></li>";
echo "<li><strong>Dashboard:</strong> <a href='" . base_url . "shop/' target='_blank'>" . base_url . "shop/</a></li>";
echo "</ul>";

echo "<h3>🔑 Default Login Credentials:</h3>";
echo "<ul>";
echo "<li><strong>Admin:</strong> username: admin, password: admin123</li>";
echo "<li><strong>Staff:</strong> username: jsmith, password: jsmith123</li>";
echo "</ul>";
?>
