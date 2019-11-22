<?php 
    include('conn.php');
    include('function.php');
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        header('location:login.php');
        exit;
    }

    $email = $_POST['email'];
    $targetemail = $_POST['targetemail'];

    if(isset($_POST['delete'])){
        deleteFriend($email, $targetemail);
        header('location:index.php');
        exit;
    }
?>