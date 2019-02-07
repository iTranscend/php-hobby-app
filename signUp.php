<?php
    include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HobbyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.min.css">
</head>
<body>

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="index.html">HobbyApp</a>
              
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                      <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                  </ul>

                  <form class="form-inline">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="signUp.php">Sign-Up</a>
                                </li>
                        </ul>
                    </form>
                </div>
        </nav>

    <div class="container">
            
        <br>
        <br>
        <br>

        <div class="container">
            <h3>Sign-Up</h3>
    <?php 
        if (isset($_POST['submit'])) {
            include_once 'config.php';

            $firstName = mysqli_real_escape_string($conn, $_POST['firstname']);
            $lastName = mysqli_real_escape_string($conn, $_POST['lastname']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $passKey = mysqli_real_escape_string($conn, $_POST['passkey']);
            $hashedPassKey = password_hash($passKey, PASSWORD_ARGON2I);

            if ( empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($hashedPassKey)) {
                echo '<div class="alert alert-danger">Please fill in all fields</div>';
            } else {
                $sql2 = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql2);
                $checkResult = mysqli_num_rows($result);
                
                if ($checkResult > 0) {
                    echo '<div class="alert alert-danger">This email is already in use.</div>';
                } else {
                    $sql = "INSERT INTO users (first_name, last_name, email, phone, password) values ('$firstName', '$lastName', '$email', '$phone', '$hashedPassKey')";
                    $query = mysqli_query($conn, $sql);
                    echo '<div class="alert alert-success">Your sign up was successful. please proceed to <a href="login.php">login</div>';
                }
            }
        }
    ?>
            <form name="signUpForm" method="POST" enctype="multipart/form-data" onsubmit="return(signUpValidate());">
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first-name">Firstname</label>
                    <input type="text" name="firstname" class="form-control" id="first-name" placeholder="Firstname" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="last-name">Lastname</label>
                    <input type="text" name="lastname" class="form-control" id="last-name" placeholder="Lastname" required>
                </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group-col-md-6">
                        <label for="phone">Phone Number:</label>
                        <input type="number" name="phone" class="form-control" id="phone" placeholder="+23408156898764" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword">Password</label>
                        <input type="password" name="passkey" class="form-control" id="inputPassword" placeholder="Password" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPasswordconf">Confirm Your Password</label>
                        <input type="password" name="passkeyconf" class="form-control" id="inputPasswordconf" placeholder="Please Re-type your Password" required>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
            </form>
            </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Local bootstrap js file -->
    <script src="bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>