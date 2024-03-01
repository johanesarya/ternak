<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunitas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Komunitas</h1>

        <!-- Form untuk membuat postingan -->
        <form>
            <div class="mb-3">
                <label for="postContent" class="form-label">Tulis Postingan Anda</label>
                <textarea class="form-control" id="postContent" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>

        <hr>

        <!-- Card untuk setiap postingan -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Judul Postingan</h5>
                <p class="card-text">Isi dari postingan Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
            </div>
            <!-- Komentar -->
            <div class="card-footer">
                <h6 class="card-subtitle mb-2 text-muted">Komentar</h6>
                <!-- Komentar pertama -->
                <div class="mb-3">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/50" alt="..." class="rounded-circle" width="50">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mt-0">Nama Pengguna</h6>
                            Komentar pertama Lorem ipsum dolor sit amet consectetur adipisicing elit...
                        </div>
                    </div>
                </div>
                <!-- Form untuk menambah komentar -->
                <form>
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="Tulis komentar..." rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Komentar</button>
                </form>
            </div>
        </div>

        <!-- Card lainnya untuk postingan -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Judul Postingan Lainnya</h5>
                <p class="card-text">Isi dari postingan Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
            </div>
            <!-- Komentar -->
            <div class="card-footer">
                <h6 class="card-subtitle mb-2 text-muted">Komentar</h6>
                <!-- Komentar kedua -->
                <div class="mb-3">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/50" alt="..." class="rounded-circle" width="50">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mt-0">Nama Pengguna</h6>
                            Komentar kedua Lorem ipsum dolor sit amet consectetur adipisicing elit...
                        </div>
                    </div>
                </div>
                <!-- Form untuk menambah komentar -->
                <form>
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="Tulis komentar..." rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Komentar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle dengan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>