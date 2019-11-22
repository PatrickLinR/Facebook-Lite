<?php
    function checkUser($email, $pwd){
        include('conn.php');
        $sql="select email, password from member where email = '$email' and password = '$pwd'";
        $result=oci_parse($conn,$sql);
        oci_execute($result);
        $row = oci_fetch_all($result, $res);
        return $row;
    }

    function signup($email, $fn, $sn, $dob, $gender, $status, $location, $psw, $visibility){
        include('conn.php');
        $query = "INSERT INTO MEMBER (email, fullname, screenname, dob, gender, status, location, password, visibility)
        VALUES ('$email', '$fn', '$sn', to_date('$dob','yyyy-mm-dd'), '$gender', '$status', '$location', '$psw', '$visibility')";
        
        $stid = oci_parse($conn, $query);

        oci_execute($stid);
    }

    function checkSignup($email){
        include('conn.php');
        $sql="select email from member where email = '$email'";
        $result=oci_parse($conn,$sql);
        oci_execute($result);
        $row = oci_fetch_array($result);
        return $row[0];
    }

    function getName($email){
        include('conn.php');
        $sql="select screenname from member where email = '$email'";
        $sn = oci_parse($conn, $sql);
        oci_execute($sn, OCI_DEFAULT);
        $row = oci_fetch_array($sn);
        // oci_close($conn);
        return $row[0];
    }

    function checkPost($id){
        include('conn.php');
        $sql="select postid from post where postid = '$id'";
        $post = oci_parse($conn, $sql);
        oci_execute($post, OCI_DEFAULT);
        $row = oci_fetch_array($post);
        // oci_close($conn);
        return $row[0];
    }

    function getPostEmail($id){
        include('conn.php');
        $sql="select member_email from post where postid = '$id' order by posttimestamp";
        $pb = oci_parse($conn, $sql);
        oci_execute($pb, OCI_DEFAULT);
        $row = oci_fetch_array($pb);
        // oci_close($conn);
        return $row[0];
    }



    function getPostBody($id){
        include('conn.php');
        $sql="select dbms_lob.substr(body, 4000, 1) from post where postid = '$id'";
        $body = oci_parse($conn, $sql);
        oci_execute($body, OCI_DEFAULT);
        $row = oci_fetch_array($body);
        // oci_close($conn);
        return $row[0];

    }

    function getPostVisibility($email){
        
        include('conn.php');
        $sql="select visibility from member where email = '$email'";
        $body = oci_parse($conn, $sql);
        oci_execute($body, OCI_DEFAULT);
        $row = oci_fetch_array($body);
        // oci_close($conn);
        return $row[0];
    }

    function getParentPostid($id){
        include('conn.php');
        $sql="select parentpostid from post where postid = '$id'";
        $parentpostid = oci_parse($conn, $sql);
        oci_execute($parentpostid, OCI_DEFAULT);
        $row = oci_fetch_array($parentpostid);
        // oci_close($conn);
        return $row[0];
    }

    function getPostpostid($id){
        include('conn.php');
        $sql="select post_postid from post where postid = '$id'";
        $postpostid = oci_parse($conn, $sql);
        oci_execute($postpostid, OCI_DEFAULT);
        $row = oci_fetch_array($postpostid);
        return $row[0];
    }

    function getStatus($email){
        include('conn.php');
        $sql="select status from member where email = '$email'";
        $status = oci_parse($conn, $sql);
        oci_execute($status, OCI_DEFAULT);
        $row = oci_fetch_array($status);
        return $row[0];
    }

    function getLocation($email){
        include('conn.php');
        $sql="select location from member where email = '$email'";
        $location = oci_parse($conn, $sql);
        oci_execute($location, OCI_DEFAULT);
        $row = oci_fetch_array($location);
        return $row[0];
    }

    function getVisibility($email){
        include('conn.php');
        $sql="select visibility from member where email = '$email'";
        $visibility = oci_parse($conn, $sql);
        oci_execute($visibility, OCI_DEFAULT);
        $row = oci_fetch_array($visibility);
        if($row[0] == 'everyone'){
            return 'Public';
        } else if($row[0] == 'friends-only') {
            return 'Friends-only';
        } else if($row[0] == 'private'){
            return 'Private';
        }
    }

    function checkRequest($email, $targetemail){
        include('conn.php');
        $sql="select requeststatus from friendshiprequest where member_requester_email = '$email' and member_recepient_email = '$targetemail'";
        $check = oci_parse($conn, $sql);
        oci_execute($check, OCI_DEFAULT);
        $row = oci_fetch_array($check);
        return $row[0];
    }

    function checkReceiving($email, $targetemail){
        include('conn.php');
        $sql="select requeststatus from friendshiprequest where member_recepient_email = '$email' and member_requester_email = '$targetemail'";
        $check = oci_parse($conn, $sql);
        oci_execute($check, OCI_DEFAULT);
        $row = oci_fetch_array($check);
        return $row[0];
    }

    function getRequest($email, $status){
        include('conn.php');
        $sql="select member_recepient_email from friendshiprequest where member_requester_email='$email' and requeststatus = '$status'";
        $request = oci_parse($conn, $sql);
        oci_execute($request, OCI_DEFAULT);
        $row = oci_fetch_array($request);
        $array[] = $row[0];
        while($row = oci_fetch_array($request)){
            array_push($array, $row[0]);
        }
        return $array;
    }

    function getReceiving($email, $status){
        include('conn.php');
        $sql="select member_requester_email from friendshiprequest where member_recepient_email='$email' and requeststatus = '$status'";
        $receiving = oci_parse($conn, $sql);
        oci_execute($receiving, OCI_DEFAULT);
        $row = oci_fetch_array($receiving);
        $array[] = $row[0];
        while($row = oci_fetch_array($receiving)){
            array_push($array, $row[0]);
        }
        return $array;
    }

    function getFriendshipDate($email, $targetemail){
        include('conn.php');
        $sql="SELECT startdate FROM friendwith WHERE member_one_email='$email' and member_two_email='$targetemail' 
        UNION SELECT startdate FROM friendwith WHERE member_one_email='$targetemail' and member_two_email='$email'";
        $date = oci_parse($conn, $sql);
        oci_execute($date, OCI_DEFAULT);
        $row = oci_fetch_array($date);
        return $row[0];
    }

    function getFriendEmailList($email){
        include('conn.php');
        $sql="SELECT member_two_email FROM friendwith WHERE member_one_email='$email' 
        UNION SELECT member_one_email FROM friendwith WHERE member_two_email='$email'";
        $friend = oci_parse($conn, $sql);
        oci_execute($friend, OCI_DEFAULT);
        $row = oci_fetch_array($friend);
        $array[] = $row[0];
        while($row = oci_fetch_array($friend)){
            array_push($array, $row[0]);
        }
        return $array;
    }

    function deleteFriend($email, $targetemail){
        include('conn.php');
        $sql="DELETE FROM friendwith WHERE member_one_email='$email' and member_two_email='$targetemail'";
        $sql2="DELETE FROM friendwith WHERE member_two_email='$email' and member_one_email='$targetemail'";
        $sql3="DELETE FROM friendshiprequest WHERE member_requester_email='$email' and member_recepient_email='$targetemail'";
        $sql4="DELETE FROM friendshiprequest WHERE member_recepient_email='$email' and member_requester_email='$targetemail'";
        $del = oci_parse($conn, $sql);
        $del2 = oci_parse($conn, $sql2);
        $del3 = oci_parse($conn, $sql3);
        $del4 = oci_parse($conn, $sql4);
        oci_execute($del);
        oci_execute($del2);
        oci_execute($del3);
        oci_execute($del4);
        return 'Friend deleted';
    }

    function checkLike($email, $postid){
        include('conn.php');
        $sql="SELECT member_email, post_postid FROM likes WHERE member_email='$email' and post_postid='$postid'";
        $like = oci_parse($conn, $sql);
        oci_execute($like, OCI_DEFAULT);
        $row = oci_fetch_array($like);
        return $row[0];
    }

    function getLike($postid){
        include('conn.php');
        $sql="SELECT member_email FROM likes WHERE post_postid='$postid'";
        $like = oci_parse($conn, $sql);
        oci_execute($like, OCI_DEFAULT);
        $row = oci_fetch_array($like);
        $array[] = $row[0];
        while($row = oci_fetch_array($like)){
            array_push($array, $row[0]);
        }
        $i = 0;
        if($array[0] != null){
            echo "<br>";
            while($i < sizeof($array)){
                echo "[<b>",getName($array[$i]),"</b>] ";
                $i++;
            }
            echo "Like it";
        }
        
        return $row[0];
    }

    function deleteAllPosts($email){
        include('conn.php');
        $posttimestamp = null;
        $body = null;
        $postpostid = null;
        $parentpostid = null;
        $mEmail = null;
        $sql = "UPDATE post
        SET posttimestamp='$posttimestamp', member_email = '$mEmail', body = '$body', post_postid = '$postpostid', parentpostid = '$parentpostid' WHERE member_email = '$email'";
        $delpost = oci_parse($conn, $sql);
        oci_execute($delpost);
        return 'Post deleted';
    }

    function deleteAllFriends($email){
        include('conn.php');
        $sql = "DELETE FROM friendwith WHERE member_one_email = '$email'"; 
        $sql2 = "DELETE FROM friendwith WHERE member_two_email = '$email'";
        $delfri = oci_parse($conn, $sql);
        $delfri2 = oci_parse($conn, $sql2);
        oci_execute($delfri);
        oci_execute($delfri2);
        return 'Friends deleted';
    }

    function deleteAllRequests($email){
        include('conn.php');
        $sql = "DELETE FROM friendshiprequest WHERE member_requester_email='$email'";
        $sql2 = "DELETE FROM friendshiprequest WHERE member_recepient_email='$email'";
        $delreq = oci_parse($conn, $sql);
        $delreq2 = oci_parse($conn, $sql2);
        oci_execute($delreq);
        oci_execute($delreq2);
        return 'Request deleted';
    }

    function deleteAllLikes($email){
        include('conn.php');
        $sql =  "DELETE FROM likes WHERE member_email='$email'";
        $dellike = oci_parse($conn, $sql);
        oci_execute($dellike);
        return 'Like deleted';
    }

    function deleteMember($email){
        include('conn.php');
        echo deleteAllLikes($email);
        echo deleteAllFriends($email);
        echo deleteAllRequests($email);
        echo deleteAllPosts($email);
        $sql = "DELETE FROM member WHERE email='$email'";
        $delete = oci_parse($conn, $sql);
        header('location:logout.php');
        oci_execute($delete);
        
    }
?>