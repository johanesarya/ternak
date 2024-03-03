<?php
session_start();
include '../Setting/connect.php';

$connect = koneksi();

$username = $_SESSION['user'];

// Query untuk mengambil data user berdasarkan username
$query = "SELECT * FROM tb_akun WHERE user=?";
$stmt = $connect->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // User ditemukan, ambil data
    $row = $result->fetch_assoc();
    $foto_profil = $row['foto'];
    $nama = $row['nama'];
    $alamat = $row['alamat'];
    if ($foto_profil === null || empty($foto_profil)) {
        $foto_profil = "../Assets/Photos/user.png"; // Ganti dengan lokasi foto default
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data produk berdasarkan ID
    $query2 = "SELECT * FROM tb_info WHERE id=?";
    $stmt2 = $connect->prepare($query2);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows === 1) {
        // Data produk ditemukan
        $row = $result2->fetch_assoc();
        $id_info = $row['id'];
        $judul = $row['judul'];
        $deskripsi = $row['deskripsi'];
        $foto = $row['foto'];
    } else {
        // Produk tidak ditemukan
        echo "Produk tidak ditemukan.";
        exit();
    }
} else {
    // ID tidak ada
    echo "ID tidak tersedia.";
    exit();
}

$stmt->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rumah bagi Petani dan Peternak Indonesia | Ternakku</title>

    <!-- Font Awesome CSS -->
    <script src="https://kit.fontawesome.com/fb009de0c3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="../Assets/CSS/main.css">
    <link rel="icon" href="../Assets/Photos/logo.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-none d-md-none d-lg-block" href="index.php">
                <img src="../Assets/Photos/logo_navbar.png" class="img-fluid" alt="Ternakku" width="164">
            </a>
            <a class="navbar-brand d-md-block d-lg-none" href="index.php">
                <img src="../Assets/Photos/logo.png" class="img-fluid" alt="Ternakku" width="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pasar.php">Pasar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="informasi.php">Informasi</a>
                    </li>
                </ul>
                <form class="d-flex justify-content-end">
                    <div class="navbar-brand">
                        <a href="berita.php" style="text-decoration: none;">
                            <i class="fa-solid fa-circle-info fa-xl pe-2" style="color: #7fd0a7;"></i>
                        </a>
                        <a href="user.php">
                            <img src="<?php echo $foto_profil; ?>" class="rounded-circle" alt="Ternakku" height="60" width="60">
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-xxl p-2 py-5 custom-bg" style="background-color: #7fd0a7; color: white;">
        <div class="container g-0 d-flex justify-content-center">
            <div class="row container-fluid">
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                    <img src="<?= $foto; ?>" width="500" class="img-fluid" alt="User Photo">
                </div>
                <div class="col-md-7 pt-3">
                    <h1><?= $judul; ?></h1>
                    <p><?= $deskripsi; ?></p>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <footer class="p-1 y-1">
            <p class="class= text-center text-muted">© Ternakku 2024</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>