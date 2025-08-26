<?php
require_once('config.php');

echo "<h2>Authentication Test</h2>";

// Test 1: Check if we can connect to database
echo "<h3>Test 1: Database Connection</h3>";
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

// Test 2: Check existing users
echo "<h3>Test 2: Existing Users</h3>";
$users_query = $conn->query("SELECT id, username, firstname, lastname, type FROM users ORDER BY id");
if ($users_query) {
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Username</th><th>Name</th><th>Type</th></tr>";
    while ($user = $users_query->fetch_assoc()) {
        $type_name = ($user['type'] == 1) ? 'Shop Owner' : 'Staff';
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['username']}</td>";
        echo "<td>{$user['firstname']} {$user['lastname']}</td>";
        echo "<td>{$user['type']} ({$type_name})</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "❌ Failed to fetch users.<br>";
}

// Test 3: Test login logic
echo "<h3>Test 3: Login Logic Test</h3>";
$test_username = 'admin';
$test_password = 'admin123';

$login_query = $conn->query("SELECT * FROM users WHERE username = '$test_username' AND password = MD5('$test_password')");
if ($login_query && $login_query->num_rows > 0) {
    $user_data = $login_query->fetch_assoc();
    echo "✅ Login test successful for user: {$user_data['username']}<br>";
    echo "User type: {$user_data['type']} (" . ($user_data['type'] == 1 ? 'Shop Owner' : 'Staff') . ")<br>";
} else {
    echo "❌ Login test failed for username: $test_username<br>";
}

echo "<h3>Test 4: Session Test</h3>";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userdata'])) {
    echo "✅ Session has user data<br>";
    echo "User: " . $_SESSION['userdata']['username'] . "<br>";
    echo "Type: " . $_SESSION['userdata']['login_type'] . "<br>";
} else {
    echo "ℹ️ No active session<br>";
}

echo "<br><a href='shop/login.php'>Go to Login</a> | <a href='shop/signup.php'>Go to Signup</a>";
?>
