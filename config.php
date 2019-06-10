<?php

$conn = mysqli_connect('localhost', 'root', '', 'phphobby');

if (!$conn) {
    die('Connection Error: '.mysqli_connect_error());
}