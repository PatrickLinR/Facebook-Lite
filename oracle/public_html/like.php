<?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        header('location:login.php');
        exit;
    }

    $postid = $_POST['postid'];
    $email = $_POST['email'];

    if(isset($_POST['like'])){
        $sql = "INSERT into likes(member_email, post_postid) 
        VALUES('$email', '$postid')";

        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
    }
    header("location:index.php");

?>