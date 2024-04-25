<?php
require "config.php";

if (isset($_GET['logout'])) {
    
	setcookie('email', '', time(), '/');
    setcookie('felhasznalonev', '', time(), '/');
    setcookie('vezeteknev', '', time(), '/');
    setcookie('jelszo', '', time(), '/');
    
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}
?>