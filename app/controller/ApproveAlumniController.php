<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("location: ../../public/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_request = $_POST['id_request'];
    $alumni_id = $_POST['alumni_id'];

    $req = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM update_requests WHERE id='$id_request'"));

    $pekerjaan = $req['pekerjaan_baru'];
    $perusahaan = $req['perusahaan_baru'];
    $linkedin = $req['linkedin_baru'];
    $instagram = $req['instagram_baru'];

    mysqli_query($conn, "UPDATE alumni_profiles SET 
                        pekerjaan = '$pekerjaan', 
                        perusahaan = '$perusahaan', 
                        linkedin = '$linkedin', 
                        instagram = '$instagram',
                        verification_status = 'verified' 
                        WHERE id = '$alumni_id'");

    mysqli_query($conn, "UPDATE update_requests SET status='approved', admin_notes='Data telah divalidasi oleh admin' WHERE id='$id_request'");

    header("location: ../../public/admin_validasi.php");
    exit;
}