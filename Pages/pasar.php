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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    // Query untuk mencari nama barang yang sesuai dengan keyword
    $query = "SELECT * FROM tb_jual WHERE nama_barang LIKE ? ";
    $stmt = $connect->prepare($query);
    $keyword = "%$keyword%"; // Tambahkan wildcard untuk pencarian yang lebih luas
    $stmt->bind_param("s", $keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    // Tampilkan hasil pencarian
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $nama_barang = $row['nama_barang'];
            $harga = $row['harga'];
            $stok = $row['stok'];
            $keterangan = $row['keterangan'];
            $foto = $row['foto'];

            // Format harga to Rupiah
            $harga_rupiah = "Rp " . number_format($harga, 0, ',', '.');

            // Tampilkan hasil pencarian sesuai format yang diinginkan
            echo '<div class="card px-0 m-1" style="width: 12rem;">';
            echo '<a href="deskripsi.php?id=' . $id . '">';
            echo '<img src="' . $foto . '" class="card-img-top" alt="...">';
            echo '</a>';
            echo '<div class="card-body">';
            echo '<p class="card-text mb-0 card-judul">' . $nama_barang . '</p>';
            echo '<p class="card-text card-harga">' . $harga_rupiah . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Barang tidak ditemukan.";
    }

    $stmt->close();
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
        <div class="container-fluid me-auto mb-2 mb-lg-0 d-flex flex-nowrap justify-content-between">
            <a class="navbar-brand d-none d-md-none d-lg-block" href="index.php">
                <img src="../Assets/Photos/logo_navbar.png" class="img-fluid" alt="Ternakku" width="164">
            </a>
            <a class="navbar-brand d-md-block d-lg-none" href="index.php">
                <img src="../Assets/Photos/logo.png" class="img-fluid" alt="Ternakku" width="50">
            </a>
            <form id="searchForm" class="d-flex justify-content-start" role="search">
                <input id="searchInput" class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-sm btn-primary me-2" style="background-color: #7FD0A7; border: none;" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <div class="navbar-brand">
                <a href="jualan.php" style="text-decoration: none;">
                    <i class="fa-solid fa-store fa-xl pe-4" style="color: #7fd0a7;"></i>
                </a>
                <a href="user.php">
                    <img src="<?php echo $foto_profil; ?>" class="rounded-circle" alt="Ternakku" height="60" width="60">
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-2 pb-3 custom-bg" style="background-color: #64B2FA; color: white;">
        <div class="container-fluid">
            <h1>Promo Terbaru</h1>
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

    <div class="container-fluid p-2 pb-0 pt-3" style="background-color: #F6F6F6;">
        <div class="container-fluid">
            <div class="row row-cols-2 row-cols-md-3 justify-content-center">
                <?php
                // Items per page
                $items_per_page = 12;

                // Current page
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

                // Offset calculation
                $offset = ($page - 1) * $items_per_page;

                $query = "SELECT * FROM tb_jual LIMIT $offset, $items_per_page";
                $result = mysqli_query($connect, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $nama_barang = $row['nama_barang'];
                        $harga = $row['harga'];
                        $stok = $row['stok'];
                        $keterangan = $row['keterangan'];
                        $foto = $row['foto'];

                        // Format harga to Rupiah
                        $harga_rupiah = "Rp " . number_format($harga, 0, ',', '.');

                        // Link to deskripsi.php with ID barang as parameter
                        echo '<div class="card px-0 m-1" style="width: 10rem;">';
                        echo '<a href="deskripsi.php?id=' . $id . '">';
                        echo '<img src="' . $foto . '" class="card-img-top" alt="...">';
                        echo '</a>';
                        echo '<div class="card-body">';
                        echo '<p class="card-text mb-0 card-judul">' . $nama_barang . '</p>';
                        echo '<p class="card-text card-harga">' . $harga_rupiah . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Tidak ada data.";
                }
                ?>
            </div>
        </div>
        <nav aria-label="Page navigation example" class="d-flex justify-content-center pt-3">
            <ul class="pagination">
                <?php
                // Count total products
                $total_rows = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM tb_jual"));

                // Total pages
                $total_pages = ceil($total_rows / $items_per_page);

                // Previous page
                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo;</a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>';
                }

                // Page links
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($page == $i) {
                        echo '<li class="page-item active"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }
                }

                // Next page
                if ($page < $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">&raquo;</a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>

    <div class="container-fluid">
        <footer class="p-1 y-1">
            <p class="class= text-center text-muted">© Ternakku 2024</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#searchForm').submit(function(event) {
                event.preventDefault(); // Prevent form submission

                var keyword = $('#searchInput').val().toLowerCase(); // Get search keyword

                $('.container-fluid.p-2.pb-0.pt-3 .card').each(function() {
                    var nama_barang = $(this).find('.card-judul').text().toLowerCase();

                    if (nama_barang.indexOf(keyword) > -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Reset search form
            $('#searchInput').on('input', function() {
                if ($(this).val() === '') {
                    $('.container-fluid.p-2.pb-0.pt-3 .card').show();
                }
            });
        });
    </script>
</body>

</html>