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
    $query2 = "SELECT * FROM tb_jual WHERE id=?";
    $stmt2 = $connect->prepare($query2);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows === 1) {
        // Data produk ditemukan
        $row = $result2->fetch_assoc();
        $id_barang = $row['id'];
        $user_jual = $row['user'];
        $nama_barang = $row['nama_barang'];
        $harga = $row['harga'];
        $stok = $row['stok'];
        $keterangan = $row['keterangan'];
        $foto = $row['foto'];

        // Format harga to Rupiah
        $harga_rupiah = "Rp " . number_format($harga, 0, ',', '.');
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

if (isset($_POST['bayar'])) {
    $nama_barang = $_POST['nama_barang'];
    $alamat = $_POST['alamat'];
    $jumlah = $_POST['jumlah'];
    $total = $jumlah * $harga;
    $uploadDirectory = '../Users/' . $username . '/Pembelian/';

    // Membuat folder jika belum ada
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // Membuat folder dengan izin 0777
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tempFileName = $_FILES['foto']['tmp_name'];
        $originalFileName = $_FILES['foto']['name'];
        $uploadedFilePath = $uploadDirectory . $originalFileName;

        if (move_uploaded_file($tempFileName, $uploadedFilePath)) {
            // Simpan ke tabel tb_beli
            $jual = mysqli_query($connect, "INSERT INTO tb_beli (nama_barang, jumlah, total, user_penjual, user_pembeli, alamat, bukti_bayar) VALUES ('$nama_barang', '$jumlah', '$total', '$user_jual', '$username', '$alamat', '$uploadedFilePath')");

            // Kurangi stok barang di tb_jual
            $updateStok = mysqli_query($connect, "UPDATE tb_jual SET stok = stok - '$jumlah' WHERE id = '$id_barang'");

            if ($jual && $updateStok) {
                // Jika sukses, kembali ke pasar.php
                header('location: riwayat.php');
                exit();
            } else {
                // Jika gagal, tampilkan pesan
                echo 'Gagal melakukan pembelian.';
                exit();
            }
        } else {
            // Jika gagal upload file
            echo 'Error handling the picture!';
        }
    } else {
        // Jika tidak ada file yang diupload
        echo 'No file uploaded!';
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
        <div class="container-fluid me-auto mb-2 mb-lg-0 d-flex flex-nowrap justify-content-between">
            <a class="navbar-brand d-none d-md-none d-lg-block" href="index.php">
                <img src="../Assets/Photos/logo_navbar.png" class="img-fluid" alt="Ternakku" width="164">
            </a>
            <a class="navbar-brand d-md-block d-lg-none" href="index.php">
                <img src="../Assets/Photos/logo.png" class="img-fluid" alt="Ternakku" width="50">
            </a>
            <form class="d-flex justify-content-start" role="search">
                <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-sm btn-primary me-2" style="background-color: #7FD0A7; border: none;" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <form class="d-flex justify-content-end">
                <div class="navbar-brand me-0">
                    <button type="button" style="background-color: white; border-color:white;" class="btn btn-primary position-relative">
                        <a href="riwayat.php">
                            <i class="fa-solid fa-bag-shopping fa-xl" style="color: #7fd0a7;"></i>
                        </a>
                    </button>
                    <a href="user.php">
                        <img src="<?php echo $foto_profil; ?>" class="rounded-circle" alt="Ternakku" width="80">
                    </a>
                </div>
            </form>
        </div>
    </nav>

    <div class="container-fluid p-2 pb-3 pt-3" style="background-color: #F6F6F6;">
        <div class="container-fluid p-4">
            <div class="row container-fluid">
                <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
                <input type="hidden" name="user_jual" value="<?= $user_jual; ?>">
                <div class="col-md-3 d-flex justify-content-center g-0">
                    <img src="<?= $foto; ?>" class="img-fluid" alt="<?= $nama_barang; ?>" style="max-width: 100%;" width="338">
                </div>
                <div class="col-md-7 col-deskripsi px-4 pt-2">
                    <h1><?= $nama_barang; ?></h1>
                    <h6>Stok Barang: <?= $stok; ?></h6>
                    <h3><?= $harga_rupiah; ?></h3>
                    <div class="pt-3 d-flex align-items-end">
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalYakin" style="border-color: #7FD0A7; color: #7FD0A7; font-family: POPPIN;">
                            Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-2 text-penjualan">
            <h3 class="p-2 container-fluid" style="background-color: #7fd0a7; color: white;">Keterangan Produk</h3>
            <p><?= $keterangan; ?></p>
        </div>
    </div>

    <div class="container-fluid">
        <footer class="p-1 y-1">
            <p class="class= text-center text-muted">© Ternakku 2024</p>
        </footer>
    </div>

    <!-- Modal Yakin -->
    <div class="modal fade" id="modalYakin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 class="modal-title fs-4" id="exampleModalLabel">Validasi</h1>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="card-title">Pilih Metode Pembayaran</h5>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h4>Transfer Bank</h4>
                            <p>Silakan transfer ke rekening berikut:</p>
                            <p><strong>Bank:</strong> Bank ABC</p>
                            <p><strong>Nomor Rekening:</strong> 1234-5678-9012</p>
                            <p><strong>Atas Nama:</strong> Ternakku</p>
                        </div>
                        <div class="col-md-6">
                            <h4>E-Wallet</h4>
                            <p>Anda juga dapat menggunakan e-wallet berikut:</p>
                            <p><strong>OVO:</strong> 0812-3456-7890</p>
                            <p><strong>GoPay:</strong> 0812-3456-7890</p>
                            <p><strong>Dana:</strong> 0812-3456-7890</p>
                        </div>
                    </div>
                    <hr>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="total" id="total_hidden">
                        <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
                        <input type="hidden" name="user_jual" value="<?= $user_jual; ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input name="nama_barang" value="<?php echo $nama_barang; ?>" type="text" class="form-control" id="nama" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input name="alamat" value="<?php echo $alamat; ?>" type="text" class="form-control" id="alamat" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Beli</label>
                            <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Beli" onkeyup="hitungTotal()">
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total Harga</label>
                            <div class="input-group">
                                <input name="total" value="Rp <?= number_format($harga, 0, ',', '.'); ?>" type="text" class="form-control" id="total" readonly>
                                <button class="btn btn-primary" type="button" id="hitungTotalBtn" onclick="hitungTotal()" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Hitung Total</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="bukti" class="form-label">Bukti Pembayaran</label>
                            <input class="file-input" type="file" name="foto" placeholder="Foto Profil" id="foto" accept=".jpeg, .jpg, .png" max-file-size="10000000" required>
                        </div>
                        <button type="submit" name="bayar" class="btn btn-primary form-control">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function hitungTotal() {
            var jumlah = document.getElementById('jumlah').value;
            var harga = <?= $harga; ?>;
            var total = jumlah * harga;
            document.getElementById('total').value = "Rp " + total.toLocaleString('id-ID');
            document.getElementById('total_hidden').value = total; // Update nilai input hidden
        }
    </script>
</body>

</html>