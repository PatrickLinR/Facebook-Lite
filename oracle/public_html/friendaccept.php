<?php
    include('conn.php');
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        // echo "login first";
        header('location:login.php');
        exit;
    }
    
    $email = $_POST['email'];
    $targetemail = $_POST['targetemail'];
    if(isset($_POST['accept'])){
        $query = "INSERT INTO friendwith (member_one_email, member_two_email, startdate) 
        VALUES('$email', '$targetemail', to_date(sysdate,'yyyy-mm-dd'))";

        $stid = oci_parse($conn, $query);
        oci_execute($stid);

        $status = 'accepted';
        $update = "UPDATE friendshiprequest
        SET requeststatus='$status'
        WHERE member_requester_email='$email' and member_recepient_email='$targetemail'";

        $stpo = oci_parse($conn, $update);
        oci_execute($stpo);

        // echo "Now he/she is your friend already!! Enjoy~<br>Back home after 2s~";
        header('location:index.php');
        exit;

    } else if(isset($_POST['disagree'])){


        $disagree = "DELETE FROM friendshiprequest WHERE member_requester_email='$email' and member_recepient_email='$targetemail'";

        $stdis = oci_parse($conn, $disagree);
        oci_execute($stdis);

        // echo "Ignore this request successfully<br>Back home after 2s~";
        header('location:index.php');
        exit;
    }
?>
