<?php
//session_start();

//   if(!isset($_SESSION["userdata"]) || $_SESSION["userdata"] !== true){
//     header('location: destroy_session.php');
//     exit;
// }
?>
<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 
$link .= $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['userdata']) && !strpos($link, 'login.php') && !strpos($link, 'signup.php')){
	redirect('shop/login.php');
}
if(isset($_SESSION['userdata']) && strpos($link, 'login.php')){
	redirect('shop/index.php');
}
// Allow both Shop Owners (type 1) and Staff (type 2) to access the shop
// Only block access if user type is not 1 or 2
if(isset($_SESSION['userdata']) && (strpos($link, 'index.php') || strpos($link, 'shop/')) && !in_array($_SESSION['userdata']['login_type'], [1, 2])){
	echo "<script>alert('Access Denied!');location.replace('".base_url."');</script>";
    exit;
}
