<?php

$conn = mysqli_connect("localhost", "root", "", "alumnidb");

if (!$conn) {
    die("Koneksi gagal");
}
