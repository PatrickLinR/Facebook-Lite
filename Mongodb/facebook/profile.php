<?php
    include('function.php');
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
        header('location:login.php');
        exit;
    }
?>


    <?php 
    $email = htmlspecialchars($_SESSION['email']);
    echo '
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
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <div class="row">
                    <a class="navbar-brand" href="#">
                        <img src="image/icon.png" height="40" alt="">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-light bg-dark font-weight-bold" href="index.php" >Home</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-light active font-weight-bold" href="#">Profile<span class="sr-only">(current)</span></a>
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
                    <h4 class="card-title">Profile setting</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Fill up this form to update your account</h6>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <form action="update.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="sn"><b>Screenname</b></label>
                                    <input type="text" placeholder="Enter Screen name" name="screenname" value='.getName($email).' class="form-control" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="status"><b>Status</b></label>
                                    <input type="text" placeholder="Enter your status" name="status" value='.getStatus($email).' class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location"><b>Location</b></label>
                                <input type="text" placeholder="Enter your location" name="location" value='.getLocation($email).' class="form-control" required>
                            </div>

                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0"><b>Visibility</b></legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="visibility" value="everyone" required>
                                        <label class="form-check-label">Everyone</label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="visibility" value="friends-only">
                                        <label class="form-check-label">Friends-only</label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="visibility" value="private">
                                        <label class="form-check-label">Private</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-dark" name="update">Submit</button>
                                </div>
                            </div>
                        </form>

                        <form action="profile.php" method="post">
                            <div class="form-group">
                                <label for="location" class="font-italic"><b>If you do not want to delete your account, do not touch this button!</b></label>
                                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#checkModal">Delete My Account</button>

                                <div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="checkModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="checkModalTitle">Double check</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to remove all data of your account from this website?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href="deleteacc.php" class="btn btn-dark"> Delete All</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="col-sm-3"></div>
            </div>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
        </html>';


    
    ?>
