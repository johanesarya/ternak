<?php
// Mulai sesi
session_start();

// Hapus semua variabel sesi
session_unset();

// Hapus sesi
session_destroy();

// Redirect ke halaman login atau halaman lain setelah logout
header("Location: ../index.php");
exit();
