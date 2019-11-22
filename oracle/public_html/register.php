<html>
    <head>
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
                            <a class="nav-link text-light bg-dark font-weight-bold" href="login.php" >Login</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light active font-weight-bold" href="#">Register<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>


        <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 bg-light" >
            <div class="card-body">
                    <h4 class="card-title">Sign up</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Fill up this form to create your new account</h6>
                    <hr>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                <form action="register_action.php" method="POST">
                    <div class="form-group">
                        <label for="email"><b>Email</b></label>
                        <input type="email" placeholder="Enter Email" name="email" class="form-control" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fn"><b>Fullname</b></label>
                            <input type="text" placeholder="Enter Full name" name="fn" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sn"><b>Screenname</b></label>
                            <input type="text" placeholder="Enter Screen name" name="sn" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="psw"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="dob"><b>Date of Birth</b></label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="status"><b>Status</b></label>
                            <input type="text" placeholder="Enter your status" name="status"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location"><b>Location</b></label>
                        <input type="text" placeholder="Enter your location" name="location" class="form-control" required>
                    </div>
                    <div class="form-row">
                        <fieldset class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <legend class="col-form-label col-sm-2 pt-0"><b>Gender</b></legend>
                                    </div>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="male" checked>
                                    <label class="form-check-label">
                                        Male
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="female">
                                    <label class="form-check-label">
                                        Female
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="other">
                                    <label class="form-check-label">
                                        Other
                                    </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <legend class="col-form-label col-sm-2 pt-0"><b>Visibility</b></legend>
                                    </div>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="visibility" value="everyone" checked>
                                    <label class="form-check-label">
                                        Everyone
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="visibility" value="friends-only">
                                    <label class="form-check-label">
                                        Friends-only
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="visibility" value="private">
                                    <label class="form-check-label">
                                        Private
                                    </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-dark">Create new</button>
                        </div>
                    </div>
                
                
                </div>
            </form>
                <div class="col-sm-1"></div>
                </div>
                    <hr>
                    <div class="container signin">
                    <span class="font-italic col-sm-1">Have an account? </span>
                    <a href="login.php" class="btn btn-dark">Sign in</a>
                </div>
        </div>
        <div class="col-sm-3"></div>
        
        </div>

    </body>
</html>