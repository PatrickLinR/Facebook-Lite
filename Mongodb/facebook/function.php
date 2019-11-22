<?php
    function checkUser($email, $pwd){
        $filter = [
            'email'=>$email,
            'password'=>$pwd
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.member", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0];
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function checkSignup($email){
        $filter = [
            'email'=>$email
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.member", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return true;
            } else{
                return false;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function signup($email, $fn, $sn, $dob, $gender, $status, $location, $psw, $visibility){
        $bulk=new MongoDB\Driver\BulkWrite;
        $user = [
            'email' => $email,
            'visibility'=>$visibility,
            'dob'=>$dob,
            'status'=>$status,
            'screenname'=>$sn,
            'location'=>$location,
            'gender'=>$gender,
            'fullname'=>$fn,
            'password'=>$psw
        ];
        try{
            $bulk->insert($user);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.member", $bulk);
            return true;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getName($email){
        $filter = [
            'email'=>$email
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.member", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->screenname;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function createPost($body, $member_email, $postpostid, $parentpostid){
        $postId = getMaxPostId();
        $date = new DateTime();
        $postTimeStamp = $date->getTimestamp();
        if($postpostid != null){
            $postpostid = (int)$postpostid;
        }
        if($parentpostid != null){
            $parentpostid = (int)$parentpostid;
        }
        $post = [
            'postid'=>$postId,
            'posttimestamp'=>$postTimeStamp,
            'body'=>$body,
            'member_email'=>$member_email,
            'postpostid'=>$postpostid,
            'parentpostid'=>$parentpostid
        ];
        try{
            $bulk=new MongoDB\Driver\BulkWrite;
            $bulk->insert($post);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.post", $bulk);
            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getMaxPostId(){
        $filter = [
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.post", $query);
            $row=$execute->toArray();
            return sizeof($row);
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function checkPost($id){
        $filter = [
            'postid'=>$id
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.post", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return true;
            } else{
                return false;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getPostEmail($id){
        $filter = [
            'postid'=>$id
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.post", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->member_email;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function sendRequest($email, $targetemail, $status){
        $time = date("y-m-d");
        $bulk=new MongoDB\Driver\BulkWrite;
        $request = [
            'member_requester_email'=>$email,
            'member_recepient_email'=>$targetemail,
            'requestdate'=>$time,
            'requeststatus'=>$status
        ];
        try{
            $bulk->insert($request);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.friendshiprequest", $bulk);
            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getPostBody($id){
        $filter = [
            'postid'=>$id
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.post", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->body;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }

    }

    function getPostVisibility($email){
        $filter = [
            'email'=>$email
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.member", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->visibility;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getParentPostid($id){
        $filter = [
            'postid'=>$id
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.post", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->parentpostid;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getPostpostid($id){
        $filter = [
            'postid'=>$id
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.post", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->postpostid;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getStatus($email){
        $filter = [
            'email'=>$email
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.member", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->status;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getLocation($email){
        $filter = [
            'email'=>$email
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.member", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->location;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getVisibility($email){
        $filter = [
            'email'=>$email
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.member", $query);
            $row=$execute->toArray();
            if($row[0]->visibility == "everyone"){
                return "Public";
            } else if($row[0]->visibility == "friends-only"){
                return "Friends-only";
            } else if($row[0]->visibility == "private"){
                return "Private";
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function checkRequest($email, $targetemail){
        $filter = [
            'member_requester_email'=>$email,
            'member_recepient_email'=>$targetemail
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.friendshiprequest", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->requeststatus;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function checkReceiving($email, $targetemail){
        $filter = [
            'member_recepient_email'=>$email,
            'member_requester_email'=>$targetemail
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.friendshiprequest", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return $row[0]->requeststatus;
            } else{
                return null;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function updateProfile($email, $sn, $sta, $loc, $vis){
        $bulk=new MongoDB\Driver\BulkWrite;
        $user = [
            'email' => $email];
        
        $update = ['$set'=>[
            'visibility'=>$vis,
            'status'=>$sta,
            'screenname'=>$sn,
            'location'=>$loc]
        ];
        try{
            $bulk->update($user, $update);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.member", $bulk);
            return true;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getRequest($email, $status){
        $filter = [
            'member_requester_email'=>$email,
            'requeststatus'=>$status
        ];
        try{
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $query=new MongoDB\Driver\Query($filter);
            $execute=$manager->executeQuery("Facebook.friendshiprequest", $query);
            $row=$execute->toArray();
            $array = array();
            if(sizeof($row)!=0){
                $array[0] = $row[0]->member_recepient_email;
                for($i = 1; $i < sizeof($row); ++$i){
                    array_push($array, $row[$i]->member_recepient_email);
                }
            }
            
            return $array;

        }catch(MongoDB\Driver\Exception\Exception $e){
        }
    }

    function getReceiving($email, $status){
        $filter = [
            'member_recepient_email'=>$email,
            'requeststatus'=>$status
        ];
        try{
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $query=new MongoDB\Driver\Query($filter);
            $execute=$manager->executeQuery("Facebook.friendshiprequest", $query);
            $row=$execute->toArray();
            $array = array();
            if(sizeof($row)!=0){
                $array[0] = $row[0]->member_requester_email;
                for($i = 1; $i < sizeof($row); ++$i){
                    array_push($array, $row[$i]->member_requester_email);
                }
            }
            
            return $array;

        }catch(MongoDB\Driver\Exception\Exception $e){
        }
    }

    function acceptRequest($email, $targetemail){
        $time = date("y-m-d");
        $status = "accepted";
        $bulk=new MongoDB\Driver\BulkWrite;
        $friend = [
            'member_one_email'=>$email,
            'member_two_email'=>$targetemail,
            'startdate'=>$time
        ];
        try{
            $bulk->insert($friend);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.friendwith", $bulk);
            changeRequestStatus($email, $targetemail, $status);
            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function changeRequestStatus($email, $targetemail, $status){
        $bulk=new MongoDB\Driver\BulkWrite;
        $request1 = [
            'member_requester_email'=>$email,
            'member_recepient_email'=>$targetemail
        ];
        $request2 = ['$set'=>[
            'requeststatus'=>$status]
        ];

        $bulk->update($request1, $request2);
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $execute = $manager->executeBulkWrite("Facebook.friendshiprequest", $bulk);
        return;
        
    }

    function rejectRequest($email, $targetemail){
        $bulk=new MongoDB\Driver\BulkWrite;
        $request = [
            'member_requester_email'=>$email,
            'member_recepient_email'=>$targetemail
        ];
        try{
            $bulk->delete($request);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.friendshiprequest", $bulk);
            return true;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getFriendshipDate($email, $targetemail){
        $filter1 = [
            'member_one_email'=>$email,
            'member_two_email'=>$targetemail
        ];
        $filter2 = [
            'member_two_email'=>$email,
            'member_one_email'=>$targetemail
        ];
        try{
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $query1=new MongoDB\Driver\Query($filter1);
            $execute1=$manager->executeQuery("Facebook.friendwith", $query1);
            $row1=$execute1->toArray();
            $query2=new MongoDB\Driver\Query($filter2);
            $execute2=$manager->executeQuery("Facebook.friendwith", $query2);
            $row2=$execute2->toArray();
            $array = array();
            if(sizeof($row1)!=0){
                $array[0] = $row1[0]->startdate;
                for($i = 1; $i < sizeof($row1); ++$i){
                    array_push($array, $row1[i]->startdate);
                }
            }
            if(sizeof($row2)!=0){
                $array[0] = $row2[0]->startdate;
                for($i = 1; $i < sizeof($row2); ++$i){
                    array_push($array, $row2[i]->startdate);
                }
            } 
            if(sizeof($array)!=0){
                return $array[0];
            } else{
                return null;
            }


        }catch(MongoDB\Driver\Exception\Exception $e){
        }
    }

    function getFriendEmailList($email){
        $filter1 = [
            'member_one_email'=>$email
        ];
        $filter2 = [
            'member_two_email'=>$email
        ];
        try{
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $query1=new MongoDB\Driver\Query($filter1);
            $execute1=$manager->executeQuery("Facebook.friendwith", $query1);
            $row1=$execute1->toArray();
            $query2=new MongoDB\Driver\Query($filter2);
            $execute2=$manager->executeQuery("Facebook.friendwith", $query2);
            $row2=$execute2->toArray();
            $array = array();
            if(sizeof($row1)!=0){
                $array[0] = $row1[0]->member_two_email;
                for($i = 1; $i < sizeof($row1); ++$i){
                    array_push($array, $row1[$i]->member_two_email);
                }
            }
            if(sizeof($row2)!=0){
                $array[0] = $row2[0]->member_one_email;
                for($i = 1; $i < sizeof($row2); ++$i){
                    array_push($array, $row2[$i]->member_one_email);
                }
            } 
            
            return $array;

        }catch(MongoDB\Driver\Exception\Exception $e){
        }
    }

    function deleteFriend($email, $targetemail){
        $request1 = [
            'member_requester_email'=>$email,
            'member_recepient_email'=>$targetemail
        ];
        $request2 = [
            'member_recepient_email'=>$email,
            'member_requester_email'=>$targetemail
        ];
        $request3 = [
            'member_one_email'=>$email,
            'member_two_email'=>$targetemail
        ];
        $request4 = [
            'member_two_email'=>$email,
            'member_one_email'=>$targetemail
        ];
        try{
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $bulk=new MongoDB\Driver\BulkWrite;
            $bulk->delete($request1);
            $bulk->delete($request2);
            $execute = $manager->executeBulkWrite("Facebook.friendshiprequest", $bulk);
            $bulk=new MongoDB\Driver\BulkWrite;
            $bulk->delete($request3);
            $bulk->delete($request4);
            $execute = $manager->executeBulkWrite("Facebook.friendwith", $bulk);

            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function checkLike($email, $postid){
        $filter = [
            'post_postid'=>$postid,
            'member_email'=>$email
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.likes", $query);
            $row=$execute->toArray();
            if(sizeof($row)!=0){
                return true;
            } else{
                return false;
            }
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function getLike($postid){
        $filter = [
            'post_postid'=>$postid
        ];
        try{
            $query=new MongoDB\Driver\Query($filter);
            $manager=new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute=$manager->executeQuery("Facebook.likes", $query);
            $row=$execute->toArray();
            $i = 0;
            if(sizeof($row)!=0){
                echo "<br>";
                if(sizeof($row)<4){
                    while($i < sizeof($row)){
                        echo "[<b>",getName($row[$i]->member_email),"</b>] ";
                        $i++;
                    }
                } else {
                    while($i < 4){
                        echo "[<b>",getName($row[$i]->member_email),"</b>] ";
                        $i++;
                    }
                    echo "... Intotal ",sizeof($row), " users ";
                }
                echo "Like it";
            } 
            
            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function createLikes($email, $postid){
        $bulk=new MongoDB\Driver\BulkWrite;
        $like = [
            'member_email'=>$email,
            'post_postid'=>(int)$postid
        ];
        try{
            $bulk->insert($like);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.likes", $bulk);
            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function deleteAllPosts($email){
        $posttimestamp = null;
        $body = null;
        $postpostid = null;
        $parentpostid = null;
        $mEmail = null;
        $user = [
            'member_email' => $email];
        
        $update = ['$set'=>[
            'posttimestamp'=>$posttimestamp,
            'member_email'=>$mEmail,
            'postpostid'=>$postpostid,
            'parentpostid'=>$parentpostid,
            'body'=>$body]
        ];
        try{
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

            $query=new MongoDB\Driver\Query($user);
            $execute=$manager->executeQuery("Facebook.post", $query);
            $row=$execute->toArray();

            for($i=0; $i<sizeof($row); ++$i){
                $bulk=new MongoDB\Driver\BulkWrite;
                $bulk->update($user, $update);
                $execute = $manager->executeBulkWrite("Facebook.post", $bulk);
            }
            return true;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function deleteAllFriends($email){
        $friend1 = [
            'member_one_email'=>$email
        ];
        $friend2 = [
            'member_two_email'=>$email
        ];
        try{
            $bulk=new MongoDB\Driver\BulkWrite;
            $bulk->delete($friend1);
            $bulk->delete($friend2);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.friendwith", $bulk);
            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function deleteAllRequests($email){
        $request1 = [
            'member_requester_email'=>$email
        ];
        $request2 = [
            'member_recepient_email'=>$email
        ];

        try{
            $bulk=new MongoDB\Driver\BulkWrite;
            $bulk->delete($request1);
            $bulk->delete($request2);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.friendshiprequest", $bulk);
            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function deleteAllLikes($email){
        $bulk=new MongoDB\Driver\BulkWrite;
        $likes = [
            'member_email'=>$email
        ];
        try{
            $bulk->delete($likes);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.likes", $bulk);
            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }

    function deleteMember($email){
        deleteAllLikes($email);
        deleteAllFriends($email);
        deleteAllRequests($email);
        deleteAllPosts($email);
        $member = [
            'email'=>$email
        ];
        try{
            $bulk=new MongoDB\Driver\BulkWrite;
            $bulk->delete($member);
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $execute = $manager->executeBulkWrite("Facebook.member", $bulk);
            return;
        }catch(MongoDB\Driver\Exception\Exception $e){

        }
    }
?>