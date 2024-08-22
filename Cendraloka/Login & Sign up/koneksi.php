<?php
$servername = "localhost";
$database = "db-user";
$username = "root";
$password = "";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
} else {
    echo "Koneksi Berhasil";
}
?>
