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
                    <i class="fa-solid fa-bag-shopping fa-xl" style="color: #7fd0a7;"></i>
                    <img src="../Assets/Photos/tester.png" class="rounded-circle" width="50">
                </div>
            </form>
        </div>
    </nav>

    <div class="container-fluid p-2 pb-3 pt-3" style="background-color: #F6F6F6;">
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-md-3 d-flex justify-content-center g-0">
                    <img src="../Assets/Photos/tester.png" class="img-fluid" alt="Tester" style="max-width: 100%;" width="338">
                </div>
                <div class="col-md-7 col-deskripsi px-4">
                    <h1>Asam Urat</h1>
                    <h6>2.000 terjual</h6>
                    <h3>Rp 25.000</h3>
                    <div class=" container px-0 d-flex justify-content-start">
                        <div class="row g-0">
                            <div class="col-xxl-6">
                                <div class="input-group pe-2 align-items-center">
                                    <p class="me-2 mb-0 text-counter">Kuantitas</p>
                                    <button type="button" class="btn btn-outline-secondary" data-target="#inputQuant" data-toggle="counter" data-action="minus">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input id="inputQuant" type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                                    <button type="button" class="btn btn-outline-secondary" data-target="#inputQuant" data-toggle="counter" data-action="plus">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 d-flex align-items-end">
                        <button type="button" class="btn btn-primary me-2" style="background-color: #7FD0A7; font-family: POPPIN; border: none;">
                            <i class="fa-solid fa-bag-shopping"></i>
                            Masukkan Keranjang
                        </button>
                        <button class="btn btn-outline-primary" type="button" style="border-color: #7FD0A7; color: #7FD0A7; font-family: POPPIN;">Middle</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-2">
            <h3 class="p-2" style="background-color: #7fd0a7; color: white;">Keterangan Produk</h2>

        </div>
    </div>

    <div class="container-fluid">
        <footer class="p-1 y-1">
            <p class="class= text-center text-muted">© Ternakku 2024</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Temukan elemen tombol plus dan minus
            var btnPlus = document.querySelector('[data-action="plus"]');
            var btnMinus = document.querySelector('[data-action="minus"]');

            // Temukan elemen input counter
            var inputCounter = document.querySelector('#inputQuant');

            // Tambahkan event listener untuk tombol plus
            btnPlus.addEventListener('click', function() {
                var currentValue = parseInt(inputCounter.value);
                var maxValue = parseInt(inputCounter.getAttribute('max'));

                if (!isNaN(maxValue) && currentValue < maxValue) {
                    inputCounter.value = currentValue + 1;
                } else if (isNaN(maxValue)) {
                    inputCounter.value = currentValue + 1;
                }
            });

            // Tambahkan event listener untuk tombol minus
            btnMinus.addEventListener('click', function() {
                var currentValue = parseInt(inputCounter.value);
                var minValue = parseInt(inputCounter.getAttribute('min'));

                if (!isNaN(minValue) && currentValue > minValue) {
                    inputCounter.value = currentValue - 1;
                } else if (isNaN(minValue)) {
                    inputCounter.value = currentValue - 1;
                }
            });
        });
    </script>
</body>

</html>