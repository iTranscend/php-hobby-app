<?php 
    session_start();

    include 'config.php';

    if ( isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];
        $name = $row['first_name'].' '.$row['last_name'];

    } else {
        header("Location: ../phphobby/login.php?message=You have been logged out!");
        exit();
    }
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
                                    <a class="nav-link"><?php echo $name; ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Logout</a>
                                </li>
                        </ul>
                    </form>
                </div>
                <!-- <form class="form-inline">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link"><?php echo $name; ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Logout</a>
                                </li>
                        </ul>
                    </form> -->
        </nav>
        

    <div class="container">
                <form>

                    <fieldset>
                        <legend>Add a Hobby</legend>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="hobbyTitle" placeholder="Landscaping.." required>
                        </div>
                        <div class="form-group">
                            <label for="details">Details:</label>
                            <textarea class="form-control" id="details" rows="3" name="hobbyDetails"  placeholder="Every Tuesday and Friday..." ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Add</button>
                    </fieldset>
                    <?php 
                        if (isset($_POST['submit'])) {
                            echo '<alert class="alert alert-success">Book Added</alert>';

                            $hobbyTitle = mysqli_real_escape_string($conn, $_POST['hobbyTitle']);
                            $hobbyDetails = mysqli_real_escape_string($conn, $_POST['hobbyDetails']);

                            $sql = "INSERT INTO hobbies (title, details, user_id) values ('$hobbyTitle', '$hobbyDetails', '$user_id')";
                            mysqli_query($conn, $sql);

                            echo '<div class="alert alert-success alert-dismissible fade show">
                                Book Added
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';

                        }
                    ?>
                </form>
         <hr>   
        <h2>My Hobbies</h2>
        <div class="row" style="margin: inherit; padding: inherit;">
            <div class="card col-md-sm" style="width: 16rem">
                <div class="card-body">
                    <h5 class="card-title">Reading</h5>
                    <p class="card-text">Non-fiction all the way. But fiction's still cool though<p>
                    <button type="submit" class="btn btn-danger">Remove</button>
                </div>
            </div>
            <p> .. </p>
            <div class="card col-md-sm" style="width: 16rem">
                <div class="card-body">
                    <h5 class="card-title">Reading</h5>
                    <p class="card-text">Non-fiction all the way. But fiction's still cool though<p>
                    <button type="submit" class="btn btn-danger">Remove</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light justify-content-center" style="background-color: #e3f2fd;">
        <ul class="nav">
            <li class="nav-item">
                <p> &copy; <?php  $time = time(); echo $date = Date('Y', $time); ?> || Developed by <a class="active" href="http://femibankole.com" style="display: inline;">Femi Bankole</a>
            </li>       
        </ul>         
    </nav>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <script src="bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>