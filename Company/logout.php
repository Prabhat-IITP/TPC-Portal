<?php
session_start();
session_destroy();
$_SESSION['loggedin'] = false;
header('Location: Companylogin.php');
exit();
?>
