<?php

$conn = mysqli_connect('localhost', 'root', '1234#', 'phphobby');

if (!$conn) {
    die('Connection Error: '.mysqli_connect_error());
}