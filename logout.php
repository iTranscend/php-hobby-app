<?php 

    session_start();

    session_destroy();
    header("Location: ../phphobby/login.php?message=Logout Successful");
    exit();
?>