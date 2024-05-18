<?php
require 'koneksi.php';

session_start();

if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit;
}

if (isset($_GET['nim'])) {
  $nim = $_GET['nim'];
  $sql = "SELECT * FROM tabel_mahasiswa WHERE nim='$nim'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $sqljurusan = "SELECT * FROM tabel_jurusan";
  $resultjurusan = mysqli_query($conn, $sqljurusan);
}

if (isset($_POST['submit'])) {


    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kode_jurusan = $_POST['kode_jurusan'];
    $alamat = $_POST['alamat'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $no_hp = $_POST['no_hp'];


    $sql = "UPDATE tabel_mahasiswa SET nim='$nim', nama='$nama', kode_jurusan='$kode_jurusan', alamat='$alamat', 
          jeniskelamin='$jeniskelamin', no_hp='$no_hp' WHERE nim='$nim'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Data Mahasiswa</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Form Edit Data Mahasiswa</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <table class="table">
                <tr>
                    <td><label for="nim">NIM</label></td>
                    <td>:</td>
                    <td><input type="text" id="nim" name="nim" class="form-control" value="<?= $row['nim'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td>:</td>
                    <td><input type="text" id="nama" name="nama" class="form-control" value="<?= $row['nama'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="kode_jurusan">Jurusan</label></td>
                    <td>:</td>
                    <td>
                        <select name="kode_jurusan" id="kode_jurusan" class="form-control" required>
                            <option value="">Pilih Jurusan</option>
                            <?php foreach ($resultjurusan as $rowj) : ?>
                                <option value="<?= $rowj['kode_jurusan'] ?>" <?php if ($rowj['kode_jurusan'] == $row['kode_jurusan']) {
                                                                                    echo "selected";
                                                                                } ?>>
                                    <?= $rowj['nama_jurusan'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat</label></td>
                    <td>:</td>
                    <td><input type="text" id="alamat" name="alamat" class="form-control" value="<?= $row['alamat'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="jeniskelamin">Jenis Kelamin</label></td>
                    <td>:</td>
                    <td>
                        <select id="jeniskelamin" name="jeniskelamin" class="form-control">
                            <option value="Laki-Laki" <?php if ($row['jeniskelamin'] == 'laki-laki') {
                                                            echo 'selected';
                                                        } ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php if ($row['jeniskelamin'] == 'Perempuan') {
                                                            echo 'selected';
                                                        } ?>>Perempuan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="no_hp">Nomor HP</label></td>
                    <td>:</td>
                    <td><input type="text" id="nohp" name="no_hp" class="form-control" value="<?= $row['no_hp'] ?>"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="submit" name="submit" value="Edit" class="btn btn-primary">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <Sure! Here's the modified code with Bootstrap classes added to the HTML elements:

