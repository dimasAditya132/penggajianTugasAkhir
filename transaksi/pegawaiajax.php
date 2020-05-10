<?php
include "../koneksi.php";
$pegawai = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM pegawai WHERE kode_pegawai='$_GET[kode_pegawai]'"));
$data = array(
    'kode_pegawai'  =>  $pegawai['kode_pegawai'],
    'gaji_pokok'    =>  $pegawai['gaji_pokok'],
    'bonus'         =>  $pegawai['bonus']);
echo json_encode($data);
?>