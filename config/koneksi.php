<?php

$conn = mysqli_connect("localhost", "root", "", "alumni_db");

if (!$conn) {
    die("Koneksi gagal");
}
