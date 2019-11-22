<?php
    include('function.php');
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        header('location:login.php');
        exit;
    }
    
    $email = $_POST['email'];
    $targetemail = $_POST['targetemail'];
    if(isset($_POST['accept'])){
        acceptRequest($email, $targetemail);

        header('location:index.php');

    } else if(isset($_POST['disagree'])){
        rejectRequest($email, $targetemail);
        header('location:index.php');
    }
?>
