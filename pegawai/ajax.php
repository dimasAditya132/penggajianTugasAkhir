<?php
include "../koneksi.php";
$pegawai = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM golongan WHERE kode_golongan='$_GET[kode_golongan]'"));
$data = array(
            'gaji_pokok'    =>  $pegawai['gaji_pokok']);
echo json_encode($data);
?>