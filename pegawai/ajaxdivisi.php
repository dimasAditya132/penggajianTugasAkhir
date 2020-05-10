<?php
include "../koneksi.php";
$divisi = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM divisi WHERE kode_divisi='$_GET[kode_divisi]'"));
$data = array(
            'bonus'    =>  $divisi['bonus']);
echo json_encode($data);
?>