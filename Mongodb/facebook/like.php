<?php
    include('function.php');
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        header('location:login.php');
        exit;
    }

    $postid = $_POST['postid'];
    $email = $_POST['email'];

    if(isset($_POST['like'])){
        createLikes($email, $postid);
    }
    header("location:index.php");

?>