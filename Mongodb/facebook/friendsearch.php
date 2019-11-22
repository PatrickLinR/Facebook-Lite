<?php
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
                <a class="navbar-brand" href="index.php">
                    <img src="image/icon.png" height="40" alt="" >
                </a>
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
                <div class="card-body">
                    <?php
                        $email = htmlspecialchars($_SESSION['email']);
                        $targetemail = $_POST["email"];
                        if($targetemail == $email) {
                            echo '<h5 class="card-title">ERROR</h5>
                            <p class="card-text">You always follow yourself everywhere</p>
                            <p class="card-text">Click button to home page</p>
                            <a href="index.php" class="btn btn-dark">Back Home</a>';
                        } else if(getName($targetemail) == null) {
                            echo '<h5 class="card-title">ERROR</h5>
                            <p class="card-text">Cannot find that user, try the register email but not name, back home after 2s~</p>
                            <p class="card-text">Click button to home page</p>
                            <a href="index.php" class="btn btn-dark">Back Home</a>';
                        } else if(getName($targetemail)){
                            echo '<h5 class="card-title">Searching Result</h5>
                            <p class="card-text">Search result: <b>', getName($targetemail), '</b></p>';
                            echo '<form action="friendrequest.php" method="post">
                            <input type="text" name="email" value="'.$email.'" style="display:none" readonly>
                            <input type="text" name="targetemail" value="'.$targetemail.'" style="display:none" readonly>
                            <button type="submit" class="btn btn-dark" name="request">Add Friend</button>
                            <a href="index.php" class="btn btn-dark">Back Home</a>
                            </form>';
                        }
                    ?>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </body>
</html>