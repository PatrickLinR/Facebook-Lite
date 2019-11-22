<?php
    session_start();
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        header('location:index.php');
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
        <div class="col-sm-6 bg-light">
            <div class="card-body">
                    <h4 class="card-title">Sign in</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Login with your account</h6>
                    <hr>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form action="login_action.php" method="POST">
                        <div class="form-group">
                            <label for="un"><b>Email address</b></label>
                            <input type="email" placeholder="email@example.com" name="un" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="pw"><b>Password</b></label>
                            <input type="password" placeholder="Password" name="pw" class="form-control" required>
                        </div>
                        
                        <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-dark" name="submit">Let's Go!</button>
                        </div>
                    </div>
                        
                    </form>
                    
                </div>
                <div class="col-sm-1"></div>
                <div class="container signup">
                <hr>
                <span class="font-italic col-sm-1">New user? Sign up your own account from here </span> 
                <a href="register.php" class="btn btn-dark">Sign up</a>
                </div>
                <div class="col-sm-3"></div>
        </div>
        </div></div><div class="col-sm-3"></div>
    </body>
</html>