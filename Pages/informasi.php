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
    $nama = $row['nama'];
    $alamat = $row['alamat'];
    if ($foto === null || empty($foto)) {
        $foto = "../Assets/Photos/user.png"; // Ganti dengan lokasi foto default
    }
}

if (isset($_POST['info'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $uploadDirectory = '../Users/' . $username . '/Jualan/';

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tempFileName = $_FILES['foto']['tmp_name'];
        $originalFileName = $_FILES['foto']['name'];
        $uploadedFilePath = $uploadDirectory . $originalFileName;

        if (move_uploaded_file($tempFileName, $uploadedFilePath)) {
            $jual = mysqli_query($connect, "INSERT INTO tb_info (judul,deskripsi,foto) VALUES ('$judul','$deskripsi','$uploadedFilePath')");
            if ($jual) {
                header('location:informasi.php');
                exit();
            } else {
                echo 'Gagal';
                var_dump(mysqli_error($connect)); // Tampilkan error SQL
                exit();
            }
        }
    } else {
        echo 'Error Handling The Picture!';
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
    <script src="https://cdn.tiny.cloud/1/gb21oq42znxe4xtaxqjcusooaly1hw155wywc5bu91q8l2u1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                        <a class="nav-link" href="#">Informasi</a>
                    </li>
                </ul>
                <form class="d-flex justify-content-end">
                    <div class="navbar-brand">
                        <a href="berita.php" style="text-decoration: none;">
                            <i class="fa-solid fa-circle-info fa-xl pe-2" style="color: #7fd0a7;"></i>
                        </a>
                        <a href="user.php">
                            <img src="<?php echo $foto; ?>" class="rounded-circle" alt="Ternakku" height="60" width="60">
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-2 pb-3" style="background-color: #F6F6F6;">
        <div class="container-fluid d-flex my-3">
            <h1>Informasi Terkini</h1>
        </div>
        <div class="container-fluid">
            <div class="row row-cols-2 row-cols-md-3 justify-content-center">
                <?php
                // Items per page
                $items_per_page = 12;

                // Current page
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

                // Offset calculation
                $offset = ($page - 1) * $items_per_page;

                $query = "SELECT * FROM tb_info LIMIT $offset, $items_per_page";
                $result = mysqli_query($connect, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $judul = $row['judul'];
                        $deskripsi = $row['deskripsi'];
                        $foto = $row['foto'];
                        echo '<div class="card px-0 m-1" style="width: 10rem;">';
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
            <nav aria-label="Page navigation example" class="d-flex justify-content-center pt-3">
                <ul class="pagination">
                    <?php
                    // Count total products
                    $total_rows = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM tb_info"));

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
    </div>

    <div class="container-fluid">
        <footer class="p-1 y-1">
            <p class="class= text-center text-muted">© Ternakku 2024</p>
        </footer>
    </div>

    <!-- Modal Informasi -->
    <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 class="modal-title fs-4" id="exampleModalLabel">Informasi</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" name="judul" class="form-control" id="floatingInput" placeholder="Nama Barang">
                            <label for="floatingInput">Judul</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="deskripsi" id="content-editor" placeholder="Deskripsi" class="form-control"></textarea>
                            <label for="floatingInput">Deskripsi</label>
                        </div>
                        <div class="mb-3">
                            <input class="file-input" type="file" name="foto" placeholder="Foto Cover" id="foto" accept=".jpeg, .jpg, .png" max-file-size="10000000" required>
                        </div>
                        <div class="mt-3">
                            <button class="form-control" name="info" type="submit" class="btn btn-primary col" style="background-color: #7FD0A7;font-family: POPPINBOLD; border: none;">Daftarkan</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
        });
    </script>
</body>

</html>