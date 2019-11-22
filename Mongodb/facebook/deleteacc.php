<?php
    include('function.php');
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        header('location:login.php');
        exit;
    }
    $email = htmlspecialchars($_SESSION['email']);

    deleteMember($email);
    // oci_close($conn);
    header('location:logout.php');


    
?>