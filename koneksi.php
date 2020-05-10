<?php
$host="localhost";
$username="kopisusu";
$password="kopisusu123";
$database="penggajian";

$con = mysqli_connect("localhost","kopisusu","kopisusu123","penggajian");

	if(!$con){
		echo "Gagal Koneksi";
	}
?>