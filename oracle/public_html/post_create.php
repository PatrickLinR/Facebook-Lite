<?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        header('location:login.php');
        exit;
    }
    $body = $_POST['textPost'];
    $email = $_POST['email'];

    $insert = "INSERT INTO post(postid, posttimestamp, body, member_email, post_postid, parentpostid) 
    VALUES(FACEBOOK_SEQUENCE.NEXTVAL, to_timestamp(to_char(sysdate,'YYYY-MM-DD HH24:MI:SS'),'YYYY-MM-DD HH24:MI:SS'), '$body', '$email', :post_postid, :parentpostid)";

    $stpo = oci_parse($conn, $insert);

    if(isset($_POST['post'])){
        $postpostid = null;
        $parentpostid = null;
        oci_bind_by_name($stpo, "post_postid", $postpostid);
        oci_bind_by_name($stpo, "parentpostid", $parentpostid);
        oci_execute($stpo);
    } else if (isset($_POST['response'])){
        $postpostid = $_POST['postpostid'];
        $parentpostid = $_POST['parentpostid'];
        oci_bind_by_name($stpo, "post_postid", $postpostid);
        oci_bind_by_name($stpo, "parentpostid", $parentpostid);
        oci_execute($stpo);
    }
    header('location: index.php');
    
    oci_close($conn);
?>