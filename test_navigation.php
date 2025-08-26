<?php
require_once('config.php');

echo "<h2>Navigation Links Test</h2>";

// Test all navigation pages
$pages = [
    'home' => 'Dashboard',
    'purchase_order' => 'Purchase Order',
    'receiving' => 'Receiving',
    'return' => 'Return List',
    'stocks' => 'Stocks',
    'sales' => 'Sale List',
    'maintenance/supplier' => 'Supplier List',
    'maintenance/item' => 'Item List',
    'maintenance/client' => 'Client List',
    'user' => 'User List',
    'system_info' => 'System Info',
    'reports/sales' => 'Sales Report',
    'reports/inventory' => 'Inventory Report',
    'profile' => 'My Profile'
];

echo "<h3>Testing Navigation Links:</h3>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Page</th><th>Name</th><th>URL</th><th>Status</th></tr>";

foreach ($pages as $page => $name) {
    $url = base_url . "shop/?page=" . $page;
    
    // Check if file/directory exists
    $file_path = "shop/" . $page;
    $exists = file_exists($file_path) || file_exists($file_path . ".php") || file_exists($file_path . "/index.php");
    
    $status = $exists ? "✅ Exists" : "❌ Missing";
    $status_color = $exists ? "green" : "red";
    
    echo "<tr>";
    echo "<td>{$page}</td>";
    echo "<td>{$name}</td>";
    echo "<td><a href='{$url}' target='_blank'>{$url}</a></td>";
    echo "<td style='color: {$status_color};'>{$status}</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>Base URL Configuration:</h3>";
echo "Current base_url: <strong>" . base_url . "</strong><br>";
echo "Expected for localhost: <strong>http://localhost/sms/</strong><br>";

echo "<h3>Quick Links:</h3>";
echo "<a href='" . base_url . "shop/' target='_blank'>Dashboard</a> | ";
echo "<a href='" . base_url . "shop/login.php' target='_blank'>Login</a> | ";
echo "<a href='" . base_url . "shop/signup.php' target='_blank'>Signup</a>";

?>
