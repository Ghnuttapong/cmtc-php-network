<?php 
    session_start();
    require '../inc/function.php';
    $user = new dbcon;
    
    if($_SESSION['username'] == "") {
        header('location: ../');
    }
?>