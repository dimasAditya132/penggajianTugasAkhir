<?php
    include '../koneksi.php';

    if($_GET['act']== 'tambahgolongan'){
        $kode_golongan  =$_POST['kode_golongan'];
        $nama_golongan  =$_POST['nama_golongan'];
        $gaji_pokok     =$_POST['gaji_pokok'];

        $cekkode = mysqli_query($con,"SELECT RIGHT(kode_golongan,2) AS kg FROM golongan WHERE left(kode_golongan,1)='G' ORDER BY kode_golongan DESC LIMIT 1");

        $row = mysqli_fetch_array($cekkode);
        $kd=$row['kg'];
        $kod = $kd+1;
        if($kod<10){
            $kode="G0".$kod;
        }else{
            $kode="G".$kod;
        }

        $querytambah =  mysqli_query($con, "INSERT INTO golongan VALUES('$kode' , '$nama_golongan' , '$gaji_pokok')");

    	if ($querytambah) {
            # code redicet setelah insert ke index
            header("location:../golongan/datagolongan.php");
        }
        else{
            echo "ERROR, tidak berhasil". mysqli_error($con);
        }
    }

    if($_GET['act'] == 'updategolongan'){
        $kode_golongan  = $_POST['kode_golongan'];
        $nama_golongan  = $_POST['nama_golongan'];
        $gaji_pokok     = $_POST['gaji_pokok'];

        //query update
        $queryupdate = mysqli_query($con, "UPDATE golongan SET nama_golongan='$nama_golongan',gaji_pokok='$gaji_pokok' WHERE kode_golongan='$kode_golongan' ");

        if ($queryupdate) {
            # credirect ke page index
            header("location:../golongan/datagolongan.php");    
        }
        else{ 
            echo "ERROR, data gagal diupdate". mysqli_error($con);
        }
    }

    if ($_GET['act'] == 'deletegolongan'){
        $kode_golongan = $_GET['kode_golongan'];

        //query hapus
        $querydelete = mysqli_query($con, "DELETE FROM golongan WHERE kode_golongan='$kode_golongan'");

        if ($querydelete) {
            # redirect ke index.php
            header("location:../golongan/datagolongan.php");
        }
        else{
            echo "ERROR, data gagal dihapus". mysqli_error($con);
        }

        mysqli_close($con);
    }
?>