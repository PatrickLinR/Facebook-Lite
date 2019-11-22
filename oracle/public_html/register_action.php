<?php

        include('conn.php');
        include('function.php');
        $email = $_POST["email"];
        $fn = $_POST["fn"];
        $sn = $_POST["sn"];
        $dob = $_POST["dob"];
        $gender = $_POST["gender"];
        $status = $_POST["status"];
        $location = $_POST["location"];
        $password = $_POST["psw"];
        $visibility = $_POST["visibility"];

        

        echo '<!DOCTYPE html>
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
                        Message
                        </div>
                        <div class="card-body">';
                        if(checkSignup($email)){
                            echo '<h5 class="card-title">Something wrong~</h5>
                            <p class="card-text">This email is already sign up, please login or use another email</p>
                            <p class="card-text">Click button or wait for 2s to login page</p>
                            <a href="login.php" class="btn btn-dark">Login</a>';
                        } else {
                            signup($email, $fn, $sn, $dob, $gender, $status, $location, $password, $visibility);
                            echo '<h5 class="card-title">Congratulations~</h5>
                            <p class="card-text">Sign up successfully</p>
                            <p class="card-text">Click button or wait for 2s to login page</p>
                            <a href="login.php" class="btn btn-dark">Login</a>';
                        }
                        echo '</div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
                </div>
            </body>
            </html>';
        header("Refresh:2;url=login.php");
        oci_close($conn);
        exit;
        

?>