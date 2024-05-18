<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}
require 'koneksi.php';
//mengambil nim dari perameter url

$nim = $_GET['nim'];

// query ke tabel mahasiswa dengan kondisi atau berdasarkan nim

$query = "SELECT * FROM tabel_mahasiswa a JOIN tabel_jurusan b ON a.kode_jurusan=
b.kode_jurusan WHERE a.nim = '$nim'";
$resul = $conn-> query($query);
if($resul->num_rows > 0){
    $row = $resul-> fetch_assoc() ;
}else{
    //
    echo "Data mahasiswa tidak di temukan";
    header("Location: index.php");
    exit();
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
    <div class="container">
        <h1>Detail Mahasiswa</h1>
        <div class="fajrin">
            <table class="table">
                <tr>
                    <td>Nim</td>
                    <td>:</td>
                    <td><?=$row['nim']?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?=$row['nama']?></td>
                </tr>
                <tr>
                    <td>Jurusa</td>
                    <td>:</td>
                    <td><?=$row['nama_jurusan']?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?=$row['alamat']?></td>
                </tr>
                <tr>
                    <td>Jenis-kelamin</td>
                    <td>:</td>
                    <td><?=$row['jeniskelamin']?></td>
                </tr>
                <tr>
                    <td>No. Hp</td>
                    <td>:</td>
                    <td><?=$row['no_hp']?></td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td>:</td>
                    <td><img src="uploads/<?=$row['foto']?>" alt="Foto" width="100"></td>
                </tr>
            </table>
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
