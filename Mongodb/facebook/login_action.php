<?php
    include('function.php');
    if(!isset($_POST['submit'])){
        header('location:login.php');
        exit;
    }
    
        session_start();
        $email = $_POST['un'];
        $password = $_POST['pw'];
        if(checkUser($email,$password)){
            $_SESSION['login']=true;
            $_SESSION['email']=$email;
            header("location: index.php");
            exit;
        } else {
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
                                ERROR
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Woooops!Something goes wrong~</h5>
                                <p class="card-text">Wrong password or email, please try again or sign up first</p>
                                <p class="card-text">Click button or wait for 2s back to login page</p>
                                <a href="" class="btn btn-dark">Back to Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                    </div>
                </body>
                </html>';
        }

        
?>
