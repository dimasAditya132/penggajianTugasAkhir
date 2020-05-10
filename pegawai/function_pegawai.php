<?php
    include '../koneksi.php';

    if($_GET['act']== 'tambahpegawai'){
        $kode_pegawai   =$_POST['kode_pegawai'];
        $nama_pegawai   =$_POST['nama_pegawai'];
        $jenis_kelamin  =$_POST['jenis_kelamin'];
        $tempat_lahir   =$_POST['tempat_lahir'];
        $tgl_lahir      =$_POST['tgl_lahir'];
        $status_menikah =$_POST['status_menikah'];
        $kode_golongan  =$_POST['nama_golongan'];
        $gaji_pokok     =$_POST['gaji_pokok'];
        $kode_divisi    =$_POST['nama_divisi'];
        $bonus          =$_POST['bonus'];
        $alamat         =$_POST['alamat'];
        $tgl_masuk      =$_POST['tgl_masuk'];
        $status         =$_POST['status'];

        $cekkode = mysqli_query($con,"SELECT RIGHT(kode_pegawai,4) AS np FROM pegawai WHERE left(kode_pegawai,1)='K' ORDER BY kode_pegawai DESC LIMIT 1");

        $row = mysqli_fetch_array($cekkode);
        $kd=$row['np'];
        $kod = $kd+1;
        if($kod<10){
            $kode="K000".$kod;
        }else if($kod<100){
            $kode="K00".$kod;
        }else if($kod<1000){
            $kode="K0".$kod;
        }else{
            $kode="K".$kod;
        }

        $querytambah =  mysqli_query($con, "INSERT INTO pegawai(kode_pegawai,nama_pegawai,jenis_kelamin,tempat_lahir,tgl_lahir,status_menikah,kode_golongan,gaji_pokok,kode_divisi,bonus,alamat,tgl_masuk,status) VALUES('$kode','$nama_pegawai','$jenis_kelamin','$tempat_lahir','$tgl_lahir','$status_menikah','$kode_golongan','$gaji_pokok','$kode_divisi','$bonus','$alamat','$tgl_masuk','A')");

    	if ($querytambah) {
            # code redicet setelah insert ke index
            header("location:../pegawai/datapegawai.php");
        }
        else{
            echo "ERROR, tidak berhasil". mysqli_error($con);
        }
    }

    if($_GET['act'] == 'updatepegawai'){
        $kode_pegawai   =$_POST['kode_pegawai'];
        $nama_pegawai   =$_POST['nama_pegawai'];
        $jenis_kelamin  =$_POST['jenis_kelamin'];
        $tempat_lahir   =$_POST['tempat_lahir'];
        $tgl_lahir      =$_POST['tgl_lahir'];
        $status_menikah =$_POST['status_menikah'];
        $kode_golongan  =$_POST['nama_golongan'];
        $gaji_pokok     =$_POST['gaji_pokok'];
        $kode_divisi    =$_POST['nama_divisi'];
        $bonus          =$_POST['bonus'];
        $alamat         =$_POST['alamat'];
        $tgl_masuk      =$_POST['tgl_masuk'];
        $status         =$_POST['status'];

        //query update
        $queryupdate = mysqli_query($con, "UPDATE pegawai SET nama_pegawai='$nama_pegawai',jenis_kelamin='$jenis_kelamin',tempat_lahir='$tempat_lahir',tgl_lahir='$tgl_lahir',status_menikah='$status_menikah',kode_golongan='$kode_golongan',gaji_pokok='$gaji_pokok',kode_divisi='$kode_divisi',bonus='$bonus',alamat='$alamat',tgl_masuk='$tgl_masuk',status='A' WHERE kode_pegawai='$kode_pegawai' ");

        if ($queryupdate) {
            # credirect ke page index
            header("location:../pegawai/datapegawai.php");    
        }
        else{ 
            echo "ERROR, data gagal diupdate ". mysqli_error($con);
        }
    }

    if ($_GET['act'] == 'deletepegawai'){
        $kode_pegawai = $_GET['kode_pegawai'];

        //query hapus
        $querydelete = mysqli_query($con, "DELETE FROM pegawai WHERE kode_pegawai='$kode_pegawai'");

        if ($querydelete) {
            # redirect ke index.php
            header("location:../pegawai/datapegawai.php");
        }
        else{
            echo "ERROR, data gagal dihapus". mysqli_error($con);
        }

        mysqli_close($con);
    }
?>