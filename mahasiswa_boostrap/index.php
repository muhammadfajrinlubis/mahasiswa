<?php
require 'koneksi.php';
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;

}

//Ambil data mahasiwa dari table_mahasiwa
$que = "SELECT * FROM tabel_mahasiswa JOIN tabel_jurusan ON tabel_mahasiswa.kode_jurusan
 = tabel_jurusan.kode_jurusan";

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

//ambil nama mahasiswa dari form pencarian
if(isset($_GET['search'])){
    $keyword = $_GET['search'];
    $que .= " WHERE tabel_mahasiswa.nama LIKE '%$keyword%'";
   
}
$total_mhs = mysqli_num_rows($conn->query($que));
$total_pages = ceil($total_mhs/$limit);

$que .= " ORDER BY tabel_mahasiswa.nim LIMIT $limit OFFSET $offset ";

$result = $conn->query($que);



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
    <nav class="navbar navbar-expand-lg text-light bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Data</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex justify-content-end text-dark">
            <span>
                 <?=$_SESSION['username']; ?>
            </span>
                <a class="logout ml-2" href="logout.php">Logout</a>
            </div>
        </div>

    </nav>

    <div class="container py-3">
        <h2>Data Mahasiswa</h2>

        <a href="tambah_mahasiswa.php" class="btn btn-primary">Tambah Mahasiswa</a>
        <form class="text-center" method="GET">
            <div class="input-group py-3">
                <input type="text" name="search" class="form-control">
                <div class="input-group-append">
                    <input type="submit" value="Cari" class="btn btn-primary">
                </div>
            </div>
        </form><br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Nama Jurusan</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr class="data" style="border: 1px solid ">
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['nama_jurusan'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['jeniskelamin'] ?></td>
                        <td><?= $row['no_hp'] ?></td>
                        <td class="aksi">
                            <a href="lihat_mahasiswa.php?nim=<?= $row['nim']; ?>" class="btn btn-primary btn-sm">Lihat</a>
                            <a href="edit_mahasiswa.php?nim=<?= $row['nim']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a onclick="return confirm('Apakah Kamu Yakin?')" href="hapus_mahasiswa.php?nim=<?= $row['nim']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile;?>
        </tbody>
        
        <table class="table">
        <?php if($total_pages > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>    
        </ul>
    </nav>
<?php endif; ?>


    <!-- Isi tabel di sini -->
</table>

          <footer class="text-center bg-dark text-light mt-5 ">
            2023 &copy; Mohammad Fajrin Lubis
        </footer>
        <script src="bootstrap/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </table>
    </body>

</html>
</html>

<?php
    $conn->close();
?>