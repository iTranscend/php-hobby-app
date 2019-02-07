<?php 
    session_start();
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
    <link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
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
            <h3>Login</h3>
            <?php 
            if(isset($_POST['submit'])) {
                include_once 'config.php';

                // Collecting the user's details
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $passKey = mysqli_real_escape_string($conn, $_POST['password']);


                if (!empty($email) && !empty($passKey)) {
                    
                    $sql = "SELECT email, password FROM users WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);

                    // Check the number of results(i.e. rows) returned
                    $resultCheck = mysqli_num_rows($result);

                    // Fetch and check the user's password to see if it matches the supplied passkey
                    $row = mysqli_fetch_assoc($result);
                    $hashedPassKey = $row['password'];
                    $truth = password_verify($passKey, $hashedPassKey);  // boolean

                    if ($resultCheck < 1 || $truth != 1) {
                        echo '<div class="alert alert-danger alert-dismissible fade show">
                        Incorrect Email or Password
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    } else {
                        if ($resultCheck = 1 && $truth == 1) {
                            session_start();
                            $_SESSION['email'] = $email;
                            header("Location: ../phphobby/home.php");
                            exit();
                        }
                    }
                } else {
                    echo '<div class="alert alert-danger">Please fill in all fields</div>';
                }
            }

            ?>
            <form enctype="multipart/form-data" method="POST" onsubmit="return(validate());">
                <div class="form-row">
                    <div class="form-group col-md-5">
                    <label for="inputEmail4">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-5">
                    <label for="inputPassword4">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" required>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
            </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="bootstrap-4.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <script src="bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>