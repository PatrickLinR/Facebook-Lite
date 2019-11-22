<?php
    include('conn.php');
    include('function.php');
    session_start();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
    <body>
    <header class="navbar navbar-expand-lg navbar-dirk bg-dark ">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            <div class="row">
                <a class="navbar-brand" href="#">
                    <img src="image/icon.png" height="40" alt="">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-light active font-weight-bold" href="#" >Login</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light bg-dark font-weight-bold" href="register.php">Register<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
        <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card text-center">
                <div class="card-header">
                    ERROR
                </div>
                <div class="card-body">
                    <?php
                        $targetemail = $_POST['targetemail'];
                        $email = $_POST['email'];
                        $status = 'applied';
                        if (getFriendshipDate($email, $targetemail)){
                            echo '<h5 class="card-title">Something wrong~</h5>
                            <p class="card-text">He/She is already your friend~ Please check your friend list</p>
                            <p class="card-text">Click button or wait for 2s to home page</p>
                            <a href="index.php" class="btn btn-dark">Back Home</a>';
                            header('Refresh:2;url=index.php');
                            exit;
                        } else if(checkRequest($email, $targetemail)){
                            echo '<h5 class="card-title">Something wrong~</h5>
                            <p class="card-text">You already sent your request, just wait him to accept you as his friend XD</p>
                            <p class="card-text">Click button or wait for 2s to home page</p>
                            <a href="index.php" class="btn btn-dark">Back Home</a>';
                            header('Refresh:2;url=index.php');
                            exit;
                        } else if (checkReceiving($email, $targetemail)){
                            echo '<h5 class="card-title">Something wrong~</h5>
                            <p class="card-text">Lucky! He/She already sent you a request~ Just check your request receiving list XD</p>
                            <p class="card-text">Click button or wait for 2s to home page</p>
                            <a href="index.php" class="btn btn-dark">Back Home</a>';
                            header('Refresh:2;url=index.php');
                            exit;
                        } else {
                            $query = "INSERT INTO friendshiprequest (member_requester_email, member_recepient_email, requestdate, requeststatus) 
                            VALUES ('$email', '$targetemail', to_date(sysdate,'yyyy-mm-dd'), '$status')";
                        
                            $stid = oci_parse($conn, $query);

                            oci_execute($stid);
                            header('location:index.php');
                            exit;
                        }
                    ?>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </body>
</html>