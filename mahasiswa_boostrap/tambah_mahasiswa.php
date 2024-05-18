<?PHP

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

require 'koneksi.php';
$query_jurusan = "SELECT * FROM tabel_jurusan ";
$result_jurusan = $conn->query($query_jurusan);

if(isset($_POST["submit"])){

 

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$kode_jurusan = $_POST['kode_jurusan'];
$alamat= $_POST['alamat'];
$jeniskelamin = $_POST['jeniskelamin'];
$no_hp = $_POST['no_hp'];

//Menguploat file foto ke folder
$target_dir="uploads/";
$file_name = $_FILES["foto"]["name"];
$tmp_file = $_FILES['foto']['tmp_name'];
$target_file = $target_dir .$file_name;


//menyimpan data ke tabel_mahasiswa dari variabel post
//memindahkan file tmp ke directory peyimpanan
move_uploaded_file($tmp_file,$target_file);
$query = "INSERT INTO tabel_mahasiswa (nim,nama,kode_jurusan,alamat,jeniskelamin,no_hp,foto) VALUES
('$nim','$nama','$kode_jurusan','$alamat','$jeniskelamin','$no_hp','$file_name')";

//Lakukan pengecekan apakah data tersimpan ke data tersimpan ke db atau tidak
if($conn->query($query)===true){
    //redice kembalik ke halamat index
    header("Location: index.php");
    exit();
}else{
    echo "Error !!".$query;
}
// Cek apakah NIM sudah ada sebelumnya
$query_check_nim = "SELECT * FROM tabel_mahasiswa WHERE nim = '$nim'";
$result_check_nim = $conn->query($query_check_nim);

if ($result_check_nim->num_rows > 0) {
    // NIM sudah ada, lakukan penanganan sesuai kebutuhan
  
    echo "<script>alert('nim sudah ada');</script>";
    
    exit();
}


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<body class="nama">
    <div class="container">
        <h1>Tambah Mahasiswa</h1>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="number" class="form-control" name="nim" id="nim">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">NAMA</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <div class="mb-3">
                <label for="kode_jurusan" class="form-label">Pilih Jurusan</label>
                <select class="form-select" name="kode_jurusan" id="kode_jurusan">
                    <option value="">Pilih Jurusan</option>
                    <?php foreach($result_jurusan as $row):?>
                        <option value="<?= $row['kode_jurusan']?>"><?=$row['nama_jurusan']?></option>
                    <?php endforeach?>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">ALAMAT</label>
                <input type="text" class="form-control" name="alamat" id="alamat">
            </div>
            <div class="mb-3">
                <label for="jeniskelamin" class="form-label">JENIS-KELAMIN</label>
                <select class="form-select" name="jeniskelamin" id="jeniskelamin">
                    <option value="laki-laki">laki-laki</option>
                    <option value="perempuan">perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">NO HP</label>
                <input type="number" class="form-control" name="no_hp" id="no_hp">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">FOTO</label>
                <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
            </div>
            <div class="mb-3">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
                <input type="submit" class="btn btn-primary" value="Tambahkan" name="submit">
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
</body>
</html>
