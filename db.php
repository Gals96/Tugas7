<?php
$conn = mysqli_connect("localhost", "root", "", "akademik");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
