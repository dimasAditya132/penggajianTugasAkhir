<?php
    include '../koneksi.php';

    if($_GET['act']== 'tambahdivisi'){
        $kode_divisi  = $_POST['kode_divisi'];
        $nama_divisi  =$_POST['nama_divisi'];
        $bonus     =$_POST['bonus'];

        $cekkode = mysqli_query($con,"SELECT RIGHT(kode_divisi,2) AS kg FROM divisi WHERE left(kode_divisi,1)='D' ORDER BY kode_divisi DESC LIMIT 1");

        $row = mysqli_fetch_array($cekkode);
        $kd=$row['kg'];
        $kod = $kd+1;
        if($kod<10){
            $kode="D0".$kod;
        }else{
            $kode="D".$kod;
        }

        $querytambah =  mysqli_query($con, "INSERT INTO divisi VALUES('$kode' , '$nama_divisi' , '$bonus')");

    	if ($querytambah) {
            # code redicet setelah insert ke index
            header("location:../divisi/datadivisi.php");
        }
        else{
            echo "ERROR, tidak berhasil". mysqli_error($con);
        }
    }

    if($_GET['act'] == 'updatedivisi'){
        $kode_divisi    = $_POST['kode_divisi'];
        $nama_divisi    = $_POST['nama_divisi'];
        $bonus          = $_POST['bonus'];

        //query update
        $queryupdate = mysqli_query($con, "UPDATE divisi SET nama_divisi='$nama_divisi',bonus='$bonus' WHERE kode_divisi='$kode_divisi' ");

        if ($queryupdate) {
            # credirect ke page index
            header("location:../divisi/datadivisi.php");    
        }
        else{ 
            echo "ERROR, data gagal diupdate". mysqli_error($con);
        }
    }

    if ($_GET['act'] == 'deletedivisi'){
        $kode_divisi = $_GET['kode_divisi'];

        //query hapus
        $querydelete = mysqli_query($con, "DELETE FROM divisi WHERE kode_divisi='$kode_divisi'");

        if ($querydelete) {
            # redirect ke index.php
            header("location:../divisi/datadivisi.php");
        }
        else{
            echo "ERROR, data gagal dihapus". mysqli_error($con);
        }

        mysqli_close($con);
    }
?>