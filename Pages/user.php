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

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $uploadDirectory = '../Users/' . $username . '/Profil/';

    // Membuat folder jika belum ada
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // Membuat folder dengan izin 0777
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tempFileName = $_FILES['foto']['tmp_name'];
        $originalFileName = $_FILES['foto']['name'];
        $uploadedFilePath = $uploadDirectory . $originalFileName;

        $getData = mysqli_query($connect, "SELECT foto FROM tb_akun WHERE user = '$username'");
        $oldData = mysqli_fetch_assoc($getData);
        $oldFilePath = $oldData['foto'];
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        if (move_uploaded_file($tempFileName, $uploadedFilePath)) {
            // File uploaded successfully

            // Insert the file location (relative path) into the database
            $update = mysqli_query($connect, "UPDATE tb_akun SET nama = '$nama', alamat = '$alamat', foto='$uploadedFilePath' WHERE user = '$username'");
            if ($update) {
                header('location:user.php');
                exit();
            } else {
                echo 'Gagal';
                header('location:user.php');
                exit();
            }
        }
    } else {
        // Handle the case where no file was uploaded
        echo 'Error Handling The Picture!';
    }
}

if (isset($_POST['jual'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $keterangan = $_POST['keterangan'];
    $uploadDirectory = '../Users/' . $username . '/Jualan/';

    // Membuat folder jika belum ada
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // Membuat folder dengan izin 0777
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tempFileName = $_FILES['foto']['tmp_name'];
        $originalFileName = $_FILES['foto']['name'];
        $uploadedFilePath = $uploadDirectory . $originalFileName;

        if (move_uploaded_file($tempFileName, $uploadedFilePath)) {
            $jual = mysqli_query($connect, "INSERT INTO tb_jual (user,nama,harga,stok,keterangan,foto) VALUES ('$username','$nama','$harga','$stok','$keterangan','$uploadedFilePath')");
            if ($jual) {
                header('location:user.php');
                exit();
            } else {
                echo 'Gagal';
                header('location:user.php');
                exit();
            }
        }
    } else {
        // Handle the case where no file was uploaded
        echo 'Error Handling The Picture!';
    }
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
                        <a href="riwayat.php" style="text-decoration: none;">
                            <i class="fa-solid fa-bag-shopping fa-xl pe-4" style="color: #7fd0a7;"></i>
                        </a>
                        <a href="user.php">
                            <img src="<?php echo $foto; ?>" class="rounded-circle" alt="Ternakku" width="80">
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-xxl p-2 pb-3 custom-bg" style="background-color: #7fd0a7; color: white;">
        <h1 class="text-center pt-2">UPDATE AKUN</h1>
        <div class="container g-0 d-flex justify-content-center">
            <form method="post" enctype="multipart/form-data">
                <div class="row container-fluid">
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <img src="<?php echo $foto; ?>" width="500" class="img-fluid" alt="User Photo">
                    </div>
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input name="nama" value="<?php echo $nama; ?>" type="text" class="form-control" id="nama">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input name="alamat" value="<?php echo $alamat; ?>" type="text" class="form-control" id="alamat">
                        </div>
                        <div class="mb-3">
                            <input class="file-input" type="file" name="foto" placeholder="Foto Profil" id="foto" accept=".jpeg, .jpg, .png" max-file-size="10000000">
                        </div>
                        <button type="submit" name="update" class="btn btn-primary form-control">Submit</button>

                    </div>
                </div>
            </form>
        </div>
        <div class="text-center mt-3">
            <form method="post" action="../Setting/logout.php">
                <button class="btn btn-danger" type="submit" name="logout">Logout</button>
            </form>
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