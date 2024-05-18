<?php
require 'koneksi.php';
$nim = $_GET['nim'];
$query = "DELETE FROM tabel_mahasiswa WHERE nim='$nim'";
if($conn->query($query)==true){
    header("Location: index.php");
    exit();
}else{
    echo"error".$conn->error;
}
?>