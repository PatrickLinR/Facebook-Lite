<?php
    include('function.php');
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        header('location:login.php');
        exit;
    }
    $body = $_POST['textPost'];
    $email = $_POST['email'];
    
    if(isset($_POST['post'])){
        createPost($body, $email, null, null);
    } else if(isset($_POST['response'])) {
        $postpostid = $_POST['postpostid'];
        $parentpostid = $_POST['parentpostid'];
        createPost($body, $email, $postpostid, $parentpostid);
    }


    header('location: index.php');
    
    oci_close($conn);
?>