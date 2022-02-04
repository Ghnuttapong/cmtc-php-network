<?php 
    session_start();
    include '../inc/function.php';
    if($_SESSION['username'] != "admin") {
        header('location: ../');
    }
    
    $admin = new dbcon;

?>