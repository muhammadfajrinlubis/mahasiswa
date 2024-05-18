<?php
$host = "localhost";
$user = "root";
$password ="";
$database ="dbperkuliahan";

// membuat kineksi
// 1.OOP (Object Orianted Program)
$conn = new mysqli($host,$user,$password,$database);
if($conn->connect_error){
    die("Koneksi Gagal :".$conn->connect_errno);
}
?>