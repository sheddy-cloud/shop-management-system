<?php
require_once('config.php');

echo "<h2>🔗 Navigation Links Test</h2>";

// Current base_url
echo "<h3>📋 Current Configuration:</h3>";
echo "<strong>Base URL:</strong> " . base_url . "<br>";
echo "<strong>Expected:</strong> http://13.60.250.20/sms/<br><br>";

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

echo "<h3>🧪 Navigation Links Analysis:</h3>";
echo "<table border='1' style='border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;'>";
echo "<tr style='background-color: #f0f0f0;'>";
echo "<th style='padding: 10px;'>Page</th>";
echo "<th style='padding: 10px;'>Name</th>";
echo "<th style='padding: 10px;'>Generated URL</th>";
echo "<th style='padding: 10px;'>Expected URL</th>";
echo "<th style='padding: 10px;'>Status</th>";
echo "</tr>";

foreach ($pages as $page => $name) {
    $generated_url = base_url . "shop/?page=" . $page;
    $expected_url = "http://13.60.250.20/sms/shop/?page=" . $page;
    
    // Check if URL matches expected
    $url_correct = ($generated_url === $expected_url);
    
    // Check if file/directory exists
    $file_path = "shop/" . $page;
    $exists = file_exists($file_path) || file_exists($file_path . ".php") || file_exists($file_path . "/index.php");
    
    $status = "";
    $status_color = "";
    
    if ($url_correct && $exists) {
        $status = "✅ Perfect";
        $status_color = "green";
    } elseif ($url_correct && !$exists) {
        $status = "⚠️ URL Correct, File Missing";
        $status_color = "orange";
    } elseif (!$url_correct && $exists) {
        $status = "⚠️ File Exists, URL Wrong";
        $status_color = "orange";
    } else {
        $status = "❌ Both Wrong";
        $status_color = "red";
    }
    
    echo "<tr>";
    echo "<td style='padding: 8px;'>{$page}</td>";
    echo "<td style='padding: 8px;'>{$name}</td>";
    echo "<td style='padding: 8px; font-family: monospace;'><a href='{$generated_url}' target='_blank'>{$generated_url}</a></td>";
    echo "<td style='padding: 8px; font-family: monospace;'>{$expected_url}</td>";
    echo "<td style='padding: 8px; color: {$status_color}; font-weight: bold;'>{$status}</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>🔍 Navigation Link Structure Analysis:</h3>";
echo "<div style='background-color: #f8f9fa; padding: 15px; border-radius: 5px;'>";

echo "<h4>Navigation Link Pattern:</h4>";
echo "<code>&lt;a href=\"&lt;?php echo base_url ?&gt;shop/?page=PAGE_NAME\"&gt;</code><br><br>";

echo "<h4>Generated URLs:</h4>";
echo "<ul>";
foreach ($pages as $page => $name) {
    $url = base_url . "shop/?page=" . $page;
    echo "<li><strong>{$name}:</strong> <a href='{$url}' target='_blank'>{$url}</a></li>";
}
echo "</ul>";

echo "<h4>Potential Issues:</h4>";
echo "<ul>";
echo "<li><strong>Base URL Mismatch:</strong> If base_url is not 'http://13.60.250.20/sms/', links will be wrong</li>";
echo "<li><strong>Missing Files:</strong> If page files don't exist, you'll get 404 errors</li>";
echo "<li><strong>Server Configuration:</strong> If Apache/PHP isn't configured properly, you'll get 500 errors</li>";
echo "<li><strong>Database Issues:</strong> If database connection fails, pages may not load</li>";
echo "</ul>";

echo "</div>";

echo "<h3>🚀 Quick Test Links:</h3>";
echo "<div style='display: flex; gap: 10px; flex-wrap: wrap;'>";
echo "<a href='" . base_url . "shop/' style='padding: 10px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;'>Dashboard</a>";
echo "<a href='" . base_url . "shop/login.php' style='padding: 10px; background: #28a745; color: white; text-decoration: none; border-radius: 5px;'>Login</a>";
echo "<a href='" . base_url . "shop/signup.php' style='padding: 10px; background: #ffc107; color: black; text-decoration: none; border-radius: 5px;'>Signup</a>";
echo "<a href='" . base_url . "test_auth.php' style='padding: 10px; background: #17a2b8; color: white; text-decoration: none; border-radius: 5px;'>Auth Test</a>";
echo "</div>";

echo "<h3>🔧 Troubleshooting Tips:</h3>";
echo "<ol>";
echo "<li><strong>Check base_url:</strong> Make sure it's exactly 'http://13.60.250.20/sms/'</li>";
echo "<li><strong>Verify file structure:</strong> All page directories should exist in shop/</li>";
echo "<li><strong>Test server:</strong> Ensure Apache and PHP are running</li>";
echo "<li><strong>Check database:</strong> Verify MySQL connection and tables</li>";
echo "<li><strong>Review logs:</strong> Check Apache error logs for specific issues</li>";
echo "</ol>";
?>
