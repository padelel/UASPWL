<?php

$servername = 'localhost:3306';
$username = 'root';
$pass = '';
$db = 'uas_gamestore';

$conn = mysqli_connect($servername, $username, $pass, $db );

if(!$conn){
    die("Connection Failed: ". mysqli_connect_error());
}

date_default_timezone_set('Asia/Jakarta');
?>