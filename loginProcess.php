<?php
include 'connection.php';
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) == 1) {
    session_start();
    $_SESSION['username'] = $username;
    header("location: dataPendaftaranOnline.php");
} else {
    header("location: login.php?pesan=gagal");    
}
?>