<?php 
    include('conn.php');
    include('function.php');
    session_start();
    $myEmail = htmlspecialchars($_SESSION['email']);
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        header('location:login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facebook index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dirk bg-dark ">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <div class="row">
            <a class="navbar-brand" href="#">
                <img src="image/icon.png" height="40" alt="">
            </a>
            
        </div>
    </div>
    </header>

    <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8 bg-light">
    
        <div class="card-body">
            <h4 class="card-title">Home Page</h4>
            <h6 class="card-subtitle mb-2 text-muted">This is the home page of Facebook Lite website</h6>
            <hr>
        </div>
    <div class="row">
    <div class="col-sm-2 border-right border-muted">
        <div class="account">
            <div class="card-body">
                <h5>Welcome</h5>
                <ul class="list-group list-group-flush bg-light mb-1">
                    <li class="list-group-item bg-light"><b>Screen Name: </b><br><?php echo getName($myEmail);?></li>
                    <li class="list-group-item bg-light"><b>Status: </b><br><?php echo getStatus($myEmail);?></li>
                    <li class="list-group-item bg-light"><b>Location: </b><br><?php echo getLocation($myEmail);?></li>
                    <li class="list-group-item bg-light"><b>Visibility: </b><br><?php echo getVisibility($myEmail);?></li>
                </ul>
                <div class="list-group list-group-flush mt-1 border-bottom border-muted">
                    <a href="profile.php" class="list-group-item list-group-item-action bg-light">Profile Setting</a>
                    <a href="logout.php" class="list-group-item list-group-item-action bg-light">Sign out</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-7 border-right border-muted">
    
    
    
    
    <div class="newpost">
        <div class="form-group">
            <form action="post_create.php" method="POST">
            <?php 
                echo '<input type="text" name="email" value='.$myEmail.' style="display:none" readonly>';
            ?>
            <label for="textPost"><b>Create a new post</b></label><hr>
            <textarea rows=4 name='textPost' class="form-control" placeholder='Say something' style="resize: none" required></textarea>
            <div class="row m-auto p-2 justify-content-end "><button type="submit" class="btn btn-dark" name="post">POST!</button></div>
            </form>
        </div>
    </div><hr>
    <div class="showpost">
        <?php 
            $i = 1;
            while(checkPost($i)){
                $postEmail = getPostEmail($i);
                $friendwithPost = getFriendshipDate($myEmail, $postEmail);
                $postVisibility = getPostVisibility($postEmail);

                $condition1 = $postVisibility == 'everyone';
                $condition2 = $postVisibility == 'friends-only' && $friendwithPost;
                $condition3 = $postEmail == $myEmail;

                if(getPostBody($i)){
                    if(getParentPostid($i) == null){
                        if($condition1 || $condition2 || $condition3){
                            echo '<div class="post">
                            <div class="card">
                            <div class="card-header">
                            <b>',getName($postEmail),'</b> 
                            said: </div>
                            <div class="card-body"><p>', 
                            getPostBody($i),'</p><footer class="blockquote-footer">', 
                            getLike($i),'</footer></div>';
                            if(!checkLike($myEmail, $i)){
                                echo '
                                
                                <form action="like.php" method="POST">
                                <div class="row m-auto p-2 justify-content-end">
                                
                                <input type="text" name="email" value='.$myEmail.' style="display:none" readonly>
                                <input type="text" name="postid" value='.$i.' style="display:none" readonly>
                                <button type="submit" class="btn btn-danger btn-sm" name="like">Like</button>
                                </div>
                                </form>';
                            } else {
                                echo '
                                <form action="" method="">
                                <div class="row m-auto p-2 justify-content-end">
                                <button type="button" class="btn btn-danger btn-sm" disabled="disabled" >Like</button>
                                </div></form>';
                            }
                            echo '<form action="post_create.php" method="POST">
                            <input type="text" name="email" value='.$myEmail.' style="display:none" readonly>
                            <input type="text" name="postpostid" value='.$i.' style="display:none" readonly>
                            <input type="text" name="parentpostid" value='.$i.' style="display:none" readonly>
                            <textarea rows=2 class="form-control" name="textPost" placeholder="reply here..." style="resize:none" required></textarea>
                            <div class="row m-auto p-2 justify-content-end"><button type="submit" class="btn btn-dark" name="response">Comment</button></div>
                            </form>';
                            $n = 1;
                            while(checkPost($n)){
                                $responseEmail = getPostEmail($n);
                                $friendwithResponse = getFriendshipDate($myEmail, $responseEmail);
                                $responseVisibility = getPostVisibility($responseEmail);
                                $responsePostEmail = getPostEmail(getPostpostid($n));
        
                                $possibility1 = $responseVisibility == 'everyone';
                                $possibility2 = $responseVisibility == 'friends-only' && $friendwithResponse;
                                $possibility3 = $responsePostEmail == $myEmail;
                                $possibility4 = $responseEmail == $myEmail && $responsePostEmail;
                                if(getPostBody($n)){
                                    if(getParentPostid($n) == $i){
                                        if($possibility1 || $possibility2 || $possibility3 || $possibility4){
                                            echo '<div class="response">
                                            <div class="card">
                                            <div class="card-header">
                                            <b>',getName($responseEmail),'</b> 
                                            response to <b>',getName($responsePostEmail),'</b>: </div>
                                            <div class="card-body"><p>',
                                            getPostBody($n),'</p><footer class="blockquote-footer">', 
                                            getLike($n),'</footer></div>';
                                            if(!checkLike($myEmail, $n)){
                                                echo '<form action="like.php" method="POST">
                                                <div class="row m-auto p-2 justify-content-end">
                                                <input type="text" name="email" value='.$myEmail.' style="display:none" readonly>
                                                <input type="text" name="postid" value='.$n.' style="display:none" readonly>
                                                <button type="submit" class="btn btn-danger btn-sm" name="like">Like</button>
                                                </div></form>';
                                            } else {
                                                echo '<form action="" method="">
                                                <div class="row m-auto p-2 justify-content-end">
                                                <button type="button" class="btn btn-danger btn-sm" disabled="disabled" >Like</button>
                                                </div></form>';
                                            }
                                            echo '<form action="post_create.php" method="POST">
                                            <input type="text" name="email" value='.$myEmail.' style="display:none" readonly>
                                            <input type="text" name="postpostid" value='.$n.' style="display:none" readonly>
                                            <input type="text" name="parentpostid" value='.$i.' style="display:none" readonly>
                                            <textarea rows=1 class="form-control" name="textPost" placeholder="reply here...." style="resize:none" required></textarea>
                                            <div class="row m-auto p-2 justify-content-end">
                                            <button type="submit" class="btn btn-dark" name="response">Reply</button>
                                            </div>
                                            </form>
                                            </div>
                                            </div>';
                                        }
                                    }
                                }
                                $n++;
                            }
                            echo '
                            </div></div><br>';
                        }
                    }
                }
                $i++;
            }
        ?>
        
    </div>
    
    </div><div class="col-sm-3">
        <div class="friend">
            <div class="usersearch">
            <div class="form-group">
                
                <form action="friendsearch.php" method="post">
                <label for="un"><b>Find your friends</b></label>
                    <input type="text" class="form-control" name="email" placeholder="User's email.." required>
                    <div class="row m-auto p-2 justify-content-end">
                    <button type="submit" class="btn btn-primary" name="search">Search</button>
                    </div>
                </form>
                </div>
            </div>
            <div class="friendlist border-bottom border-muted">
                <b>Friend list: </b><br>
                <?php 
                    $arrayFriendEmail = getFriendEmailList($myEmail);
                    $c = 0;
                    if($arrayFriendEmail[0] != null){
                        echo '<ul class="list-group list-group-flush bg-light mb-1">';
                        while($c < sizeof($arrayFriendEmail)){
                            echo '<li class="list-group-item bg-light"><b>[',$arrayFriendEmail[$c],']: ', getName($arrayFriendEmail[$c]), '</b><br>
                                Start from: <b>', getFriendshipDate($myEmail, $arrayFriendEmail[$c]), '</b><form action="frienddelete.php" method="post">
                                <input type="text" name="email" value='.$arrayFriendEmail[$c].' style="display:none">
                                <input type="text" name="targetemail" value='.$myEmail.' style="display:none">
                                <div class="row m-auto p-2 justify-content-end">
                                <button type="submit" class="btn btn-secondary btn-sm" name="delete">Delete</button></div>
                                </form></li>';
                            $c++;
                        }
                        echo '</ul>';
                    } else {
                        echo "You don't have friend now, add friend by searching them!";
                    }
                ?>
            </div>
            <div class="friendrequest border-bottom border-muted">
                <b>Request from: </b><br>
                <?php 
                    $arrayReceiving = getReceiving($myEmail, "applied");
                    $a = 0;
                    if($arrayReceiving[0] != null){
                        echo '<ul class="list-group list-group-flush bg-light mb-1">';
                        while($a < sizeof($arrayReceiving)){
                            echo '<li class="list-group-item bg-light"> <b>[',$arrayReceiving[$a],']: ', getName($arrayReceiving[$a]), '</b>
                            <form action="friendaccept.php" method="post">
                                <input type="text" name="email" value='.$arrayReceiving[$a].' style="display:none">
                                <input type="text" name="targetemail" value='.$myEmail.' style="display:none">
                                <div class="row m-auto pt-1">
                                <div class="col-sm">
                                <button type="submit" class="btn btn-secondary btn-sm" name="accept">Agree</button>
                                </div>
                                <div class="col-sm">
                                <button type="submit" class="btn btn-secondary btn-sm" name="disagree">Reject</button>
                                </div>
                                </div>
                                </form></li>';
                            $a++;
                        }
                        echo '</ul>';
                    } else {
                        echo "Empty~";
                    }
                ?>
            </div>
            
            <div class="myrequest">
                <b>Your requests: </b><br>
                <?php 
                    $arrayRequest = getRequest($myEmail, "applied");
                    $b = 0;
                    if($arrayRequest[0] != null){
                        echo '<ul class="list-group list-group-flush bg-light mb-1">';
                        while($b < sizeof($arrayRequest)){
                            echo '<li class="list-group-item bg-light">Waiting for acceptence from <b>[',$arrayRequest[$b],"]: ", getName($arrayRequest[$b]), "</b></li>";
                            $b++;
                        }
                        echo '</ul>';
                    } else {
                        echo "Empty~";
                    }
                    
                ?>
            </div>
        </div></div></div>
    
    </div>
    <div class="col-sm-2"></div></div>
</body>
</html>
<?php

    oci_close($conn);
?>