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
    $uploadDirectory = '../Users/' . $username . '/Informasi/';

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tempFileName = $_FILES['foto']['tmp_name'];
        $originalFileName = $_FILES['foto']['name'];
        $uploadedFilePath = $uploadDirectory . $originalFileName;

        if (move_uploaded_file($tempFileName, $uploadedFilePath)) {
            $jual = mysqli_query($connect, "INSERT INTO tb_info (user,judul,deskripsi,foto) VALUES ('$username','$judul','$deskripsi','$uploadedFilePath')");
            if ($jual) {
                header('location:berita.php');
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

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $hapus = mysqli_query($connect, "DELETE FROM tb_info WHERE id='$id'");
    if ($hapus) {
        header('location:berita.php');
    } else {
        echo 'Gagal';
        header('location:berita.php');
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $uploadDirectory = '../Users/' . $username . '/Informasi/';

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tempFileName = $_FILES['foto']['tmp_name'];
        $originalFileName = $_FILES['foto']['name'];
        $uploadedFilePath = $uploadDirectory . $originalFileName;

        // Menghapus foto lama sebelum mengganti dengan yang baru
        $getData = mysqli_query($connect, "SELECT foto FROM tb_info WHERE id = '$id'");
        $oldData = mysqli_fetch_assoc($getData);
        $oldFilePath = $oldData['foto'];
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath); // Hapus file gambar lama
        }

        if (move_uploaded_file($tempFileName, $uploadedFilePath)) {
            // File uploaded successfully

            // Insert the file location (relative path) into the database
            $update = mysqli_query($connect, "UPDATE tb_info SET user = '$username', judul = '$judul', deskripsi='$deskripsi', foto='$uploadedFilePath' WHERE id = '$id'");
            if ($update) {
                header('location:berita.php');
            } else {
                echo 'Gagal';
                header('location:berita.php');
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
                        <a class="nav-link" href="informasi.php">Informasi</a>
                    </li>
                </ul>
                <form class="d-flex justify-content-end">
                    <div class="navbar-brand">
                        <a href="#" style="text-decoration: none;">
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

    <div class="container-xxl p-2 pb-3 custom-bg" style="background-color: #7fd0a7; color: white;">
        <div class="d-flex justify-content-center text-jual">
            <h1 class="text-center pt-2 pe-2">TAMBAH INFORMASI</h1>
            <button class="btn btn-outline-primary" style="border-color: white; color: white; font-family: POPPINBOLD;" type="button" data-bs-toggle="modal" data-bs-target="#modalInfo">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        <div class="container g-0">
            <div class="table-responsive">
                <table id="table" style="color: white;" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $datajual = mysqli_query($connect, "SELECT * FROM tb_info WHERE user = '$username'");
                        $i = 1;
                        while ($data = mysqli_fetch_array($datajual)) {
                            $id = $data['id'];
                            $judul = $data['judul'];
                            $deskripsi = $data['deskripsi'];
                            $foto = $data['foto'];
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $judul; ?></td>
                                <td><?= $deskripsi; ?></td>
                                <td><img src="<?= $foto; ?>" alt="Foto Cover" style="max-width: 50px;"></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $id; ?>">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $id; ?>">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete The Modal -->
                            <div class="modal" id="delete<?= $id; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header" style="color: black;">
                                            <h4 class="modal-title">Hapus Informasi</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body" style="color: black;">
                                                Apakah anda yakin ingin menghapus informasi <?= $judul; ?> ?
                                                <input type="hidden" name="id" value="<?= $id; ?>">
                                                <br>
                                                <br>
                                                <hr>
                                                <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Edit The Modal -->
                            <div class="modal" id="edit<?= $id; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="color: black;">Edit Informasi</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="judul" value="<?= $judul; ?>" class="form-control" required>
                                                    <label for="floatingInput">Judul</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <textarea name="deskripsi" value="<?= $deskripsi; ?>"></textarea>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="file-input" type="file" name="foto" placeholder="Foto Cover" id="foto" accept=".jpeg, .jpg, .png" max-file-size="10000000" required>
                                                </div>
                                                <input type="hidden" name="id" value="<?= $id; ?>">
                                                <button type="submit" class="btn btn-primary" name="update">Submit</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php
                        };
                        ?>
                    </tbody>
                </table>
            </div>
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

    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/sp-2.2.0/datatables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        new DataTable('#table');
        $(document).ready(function() {
            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('#deleteID').val(id);
            });
        });

        $(document).ready(function() {
            // Inisialisasi TinyMCE
            tinymce.init({
                selector: 'textarea',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
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
        });
    </script>
</body>

</html>