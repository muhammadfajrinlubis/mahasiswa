<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //query ke tabel_pengguna
    $query = "SELECT * FROM tabel_pengguna WHERE username='$username' 
    AND password='$password'";
    $result = $conn->query($query);

    //cek apakah hasil query di atas ditemukan atau tidak
   

    // cek apakah username dan password cocok
    if ($result->num_rows > 0) {
        //simpan session 
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('login gagal');</script>";
    }
    if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>

  <body>
    <div class="container col-md-4 mt-4">
        <h2 class="text-center">Login From</h2>
    <div class="container">
    <form action="" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
   
  </div>
  <div class="mb-3">
    <label for="username" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<footer class="bg-dark text-light text-center mt-5">
    <p> &copy; 2023 muhammad Fajrin Lubis</p>
</footer>
    
</html>