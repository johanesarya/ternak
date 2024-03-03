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
    $foto = $row['foto'];
    if ($foto === null || empty($foto)) {
        $foto = "../Assets/Photos/user.png"; // Ganti dengan lokasi gambar default
    }
}
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
    <link rel="stylesheet" href="../Assets/CSS/main.css">
    <link rel="icon" href="../Assets/Photos/logo.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-none d-md-none d-lg-block" href="#">
                <img src="../Assets/Photos/logo_navbar.png" class="img-fluid" alt="Ternakku" width="164">
            </a>
            <a class="navbar-brand d-md-block d-lg-none" href="#">
                <img src="../Assets/Photos/logo.png" class="img-fluid" alt="Ternakku" width="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Beranda</a>
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
                            <i class="fa-solid fa-circle-info fa-xl pe-4" style="color: #7fd0a7;"></i>
                        </a>
                        <a href="jualan.php" style="text-decoration: none;">
                            <i class="fa-solid fa-store fa-xl pe-4" style="color: #7fd0a7;"></i>
                        </a>
                        <a href="user.php">
                            <img src="<?php echo $foto; ?>" class="rounded-circle" alt="Ternakku" height="60" width="60">
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-xxl p-2 pb-3 custom-bg" style="background-color: #64B2FA; color: white;">
        <div class="container-fluid">
            <a href="pasar.php" style="text-decoration: none; color: white;">
                <h1>Mau Beli apa?</h1>
            </a>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="container-fluid text-center">
                    <div class="carousel-item active" data-bs-interval="1000">
                        <img src="../Assets/Photos/1.png" class="d-block vw-100">
                    </div>
                    <div class="carousel-item" data-bs-interval="1000">
                        <img src="../Assets/Photos/2.png" class="d-block vw-100">
                    </div>
                    <div class="carousel-item" data-bs-interval="1000">
                        <img src="../Assets/Photos/3.png" class="d-block vw-100">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid p-2 pb-3" style="background-color: #F6F6F6;">
        <div class="container-fluid">
            <a href="informasi.php" style="text-decoration: none; color: black;">
                <h1>Informasi Terkini</h1>
            </a>
        </div>
        <div class="container-fluid">
            <div class="row row-cols-2 row-cols-md-3 justify-content-center">
                <?php
                $query = "SELECT * FROM tb_info LIMIT 6";
                $result = mysqli_query($connect, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $judul = $row['judul'];
                        $deskripsi = $row['deskripsi'];
                        $foto = $row['foto'];
                        echo '<div class="card px-0 m-1" style="width: 11rem;">';
                        echo '<a href="penjelasan_informasi.php?id=' . $id . '">';
                        echo '<img src="' . $foto . '" class="card-img-top" alt="...">';
                        echo '</a>';
                        echo '<div class="card-body">';
                        echo '<p class="card-text mb-0 card-judul">' . $judul . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Tidak ada data.";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <footer class="p-1 y-1">
            <p class="class= text-center text-muted">© Ternakku 2024</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>