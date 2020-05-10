<?php
include '../koneksi.php';

if($_GET['act']== 'tambahtransaksi'){
    $kode_transaksi = $_POST['kode_transaksi'];
    $kode_pegawai   = $_POST['kode_pegawai'];
    $gaji_pokok     = $_POST['gaji_pokok'];
    $bonus          = $_POST['bonus'];
    $total          = $gaji_pokok+$bonus;
    $tanggal        = date("Y-m-d H:i:s");
    $cekid          = date('ymd');
        
        $cekkode = mysqli_query($con,
        "SELECT RIGHT(kode_transaksi,3) AS id FROM transaksi 
        WHERE left(kode_transaksi,6)='$cekid' ORDER BY kode_transaksi DESC LIMIT 1");

        $row = mysqli_fetch_array($cekkode);
        $id=$row['id'];
        $kod = $id+1;
        if($kod<10){
            $kode=$cekid."00".$kod;
        }else if($kod<100){
            $kode=$cekid."0".$kod;
        }else{
            $kode=$cekid.$kod;
        }

        $querytambah =  mysqli_query($con, "INSERT INTO transaksi
        (kode_transaksi,kode_pegawai,tanggal,gaji_pokok,bonus,total) VALUES
        ('$kode','$kode_pegawai','$tanggal','$gaji_pokok','$bonus','$total')");

		if ($querytambah) {
            # code redicet setelah insert ke index
            header("location:../transaksi/datatransaksi.php");
        }
        else{
            echo "ERROR, tidak berhasil". mysqli_error($con);
        }
        }

if($_GET['act'] == 'updatetransaksi'){
    $kode_transaksi = $_POST['kode_transaksi'];
    $kode_pegawai   = $_POST['kode_pegawai'];
    $gaji_pokok     = $_POST['gaji_pokok'];
    $bonus          = $_POST['bonus'];
    $total          = $gaji_pokok+$bonus;
    $tanggal        = date("Y-m-d H:i:s");

    //query update
    $queryupdate = mysqli_query($con, "UPDATE transaksi SET kode_pegawai='$kode_pegawai',tanggal='$tanggal',gaji_pokok='$gaji_pokok',bonus='$bonus',total='$total' WHERE kode_transaksi='$kode_transaksi' ");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../transaksi/datatransaksi.php");    
    }
    else{ 
        echo "ERROR, data gagal diupdate". mysqli_error($con);
    }
}
?>