<?php
include 'Setting/connect.php';

$connect = koneksi();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        // Proses Signup
        $username = $_POST["email"];
        $password = $_POST["pass"];

        $validDomain = 'gmail.com';
        $pattern = '/^[a-zA-Z0-9._%+-]+@' . preg_quote($validDomain, '/') . '$/';

        if (!preg_match($pattern, $username)) {
            $error = "Email harus menggunakan domain $validDomain";
        } else {
            $hashedPassword = hash('sha512', $password);
            $alamat = null;
            $foto = null;

            $query = "INSERT INTO tb_akun (user, pass, alamat, foto) VALUES (?, ?, ?, ?)";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("ssss", $username, $hashedPassword, $alamat, $foto);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['user'] = $username;
                echo '<script>alert("Signup berhasil. Anda akan diarahkan ke halaman index."); window.location.href = "index.php";</script>';
                exit();
            } else {
                $error = "Error: " . $connect->error;
            }

            $stmt->close();
        }
    } elseif (isset($_POST['signin'])) {
        // Proses Signin
        $username = $_POST["email"];
        $password = $_POST["pass"];

        $hashedPassword = hash('sha512', $password);

        $query = "SELECT * FROM tb_akun WHERE user=? AND pass=?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $username, $hashedPassword);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Login berhasil
            session_start();
            $_SESSION['user'] = $username;
            echo '<script>alert("Login berhasil. Anda akan diarahkan ke halaman index."); window.location.href = "Pages/index.php";</script>';
            exit();
        } else {
            // Login gagal
            $error = "Username atau password salah";
            echo '<script>alert("Login gagal. ' . $error . '");</script>';
        }

        $stmt->close();
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
    <link rel="stylesheet" href="Assets/CSS/main.css">
    <link rel="icon" href="Assets/Photos/logo.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-none d-md-none d-lg-block" href="#">
                <img src="Assets/Photos/logo_navbar.png" class="img-fluid" alt="Ternakku" width="164">
            </a>
            <a class="navbar-brand d-md-block d-lg-none" href="#">
                <img src="Assets/Photos/logo.png" class="img-fluid" alt="Ternakku" width="50">
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
                        <a class="nav-link" href="#" onclick="return cekLogin()">Pasar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="return cekLogin()">Informasi</a>
                    </li>
                </ul>
                <form class="d-flex justify-content-end">
                    <div id="btn-navbar">
                        <button class="btn btn-outline-primary" type="button" style="border-color: #7FD0A7; color: #7FD0A7; font-family: POPPINBOLD;" data-bs-toggle="modal" data-bs-target="#modalMasuk">Masuk</button>
                        <button class="btn btn-primary" type="button" style="background-color: #7FD0A7;font-family: POPPINBOLD; border: none;" data-bs-toggle="modal" data-bs-target="#modalDaftar">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-xxl p-2 pb-3 custom-bg" style="background-color: #64B2FA; color: white;">
        <div class="container-fluid">
            <h1>Mau Beli apa?</h1>
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
                        <img src="Assets/Photos/1.png" class="d-block vw-100">
                    </div>
                    <div class="carousel-item" data-bs-interval="1000">
                        <img src="Assets/Photos/2.png" class="d-block vw-100">
                    </div>
                    <div class="carousel-item" data-bs-interval="1000">
                        <img src="Assets/Photos/3.png" class="d-block vw-100">
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
            <h1>Informasi Terkini</h1>
        </div>
        <div class="container-fluid justify-content-center">
            <div class="row row-cols-2 row-cols-md-3 justify-content-center">
                <?php
                $query = "SELECT * FROM tb_info LIMIT 6";
                $result = mysqli_query($connect, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $judul = $row['judul'];
                        $deskripsi = $row['deskripsi'];
                        $foto = str_replace('../Users', 'Users', $row['foto']);
                        echo '<div class="card px-0 m-1" style="width: 10rem;">';
                        echo '<a href="#" onclick="return cekLogin()">';
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

    <!-- Modal Masuk -->
    <div class="modal fade" id="modalMasuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 class="modal-title fs-4" id="exampleModalLabel">Masuk</h1>
                            </div>
                            <div class="col d-flex align-items-center justify-content-end daftar">
                                <a class="modal-title fs-6 float-end" data-toggle="modal" href="#modalDaftar">Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="mt-3">
                            <button class="form-control" name="signin" type="submit" class="btn btn-primary col" style="background-color: #7FD0A7;font-family: POPPINBOLD; border: none;">Masuk</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Daftar -->
    <div class="modal fade" id="modalDaftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 class="modal-title fs-4" id="exampleModalLabel">Daftar</h1>
                            </div>
                            <div class="col d-flex align-items-center justify-content-end daftar">
                                <a class="modal-title fs-6 float-end" data-toggle="modal" href="#modalMasuk">Masuk</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="mt-3">
                            <button name="signup" type="submit" class=" form-control btn btn-primary col" style="background-color: #7FD0A7;font-family: POPPINBOLD; border: none;">Daftar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
                <?php if (isset($error)) {
                    echo "<p class='mt-3 text-danger text-center'>$error</p>";
                } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#modalMasuk .daftar a').click(function() {
                $('#modalMasuk').modal('hide');
                $('#modalDaftar').modal('show');
            });
            $('#modalDaftar .daftar a').click(function() {
                $('#modalMasuk').modal('show');
                $('#modalDaftar').modal('hide');
            });
        });

        function cekLogin() {
            var loggedIn = '<?php echo isset($_SESSION['user']) ? "true" : "false"; ?>';

            if (loggedIn !== "true") {
                var alertMessage = "Silakan login terlebih dahulu untuk mengakses halaman ini.";
                alert(alertMessage);
                return false;
            }
        }
    </script>
</body>

</html>