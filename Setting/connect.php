<?php
function koneksi()
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'ternak';

    // Membuat koneksi
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Periksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    return $conn;
}
