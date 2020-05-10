<?php
    include '../koneksi.php';
?>

<html>
  <head>
    <title>Transaksi </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body>
    <h2 align="center">Data Transaksi</h2>
    <div class="col-md-8 offset-md-2">
      <div class="box-tools pull-left">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahtransaksi"><i class=""></i> Tambah Transaksi</a>
      </div>
      <br>
      <table border="1" align="center" class="table table-striped">
        <thead class="thead-dark">
          <tr align="center">
            <th >NO</th>
            <th >Kode Pegawai</th>
            <th >Nama Pegawai</th>
            <th >Tanggal</th>
            <th >Gaji Pokok</th>
            <th >Bonus</th>
            <th >Total</th>
            <th >Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            $queryview = mysqli_query($con, "SELECT t.kode_transaksi,p.kode_pegawai,p.nama_pegawai,t.tanggal,t.gaji_pokok,t.bonus,t.total FROM transaksi t, pegawai p WHERE t.kode_pegawai=p.kode_pegawai");
            while ($row = mysqli_fetch_assoc($queryview)) {
          ?>
          <tr>
            <td><?php echo $no++;?></td>
            <td align="center"><?php echo $row['kode_pegawai'];?></td>
            <td align="left"><?php echo $row['nama_pegawai'];?></td>
            <td align="center"><?php echo $row['tanggal'];?></td>
            <td align="left"><?php echo $row['gaji_pokok'];?></td>
            <td align="left"><?php echo $row['bonus'];?></td>
            <td align="left"><?php echo $row['total'];?></td>
            <td align="center">
              <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#updatetransaksi<?php echo $no; ?>"> Edit</a>
              <a href="#" class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#detailtransaksi<?php echo $no; ?>"> Detail</a>            
              <!-- modal detail -->
              <div id="detailtransaksi<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                <div class="modal-dialog">
                  <div class="example-modal">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Detail Data Transaksi</h3>
                      </div>
                      <div class="modal-body">
                          <?php
                          $kode_transaksi = $row['kode_transaksi'];
                          $query = "SELECT * FROM transaksi WHERE kode_transaksi='".$kode_transaksi."'";
                          $kode_pegawai = $row['kode_pegawai'];
                          $result = mysqli_query($con, $query);
                          while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                        <form action="" method="post" role="form">
                          <div class="form-group">
                            <div class="row">
                              <label for="nama_pegawai" class="col-sm-3 control-label text-right">Pegawai</label>
                              <div class="col-sm-8">
                                <select class="custom-select" id="edt_nama_pegawai" name="nama_pegawai" onchange="cek_edtdatabose()" disabled="">
                                  <?php 
                                  require_once "../koneksi.php";
                                  $pg = mysqli_query($con, "SELECT * FROM pegawai");
                                  ?>

                                  <?php foreach ($pg as $pgw):?>
                                    <option value="<?= $pgw['kode_pegawai']?>" <?php if ($pgw['kode_pegawai']==$row['kode_pegawai']){echo'selected';}?>><?= $pgw['nama_pegawai'];?></option>
                                  <?php endforeach;?>

                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Kode Pegawai</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="edt_kode_pegawai" name="kode_pegawai" placeholder="Kode Pegawai" value="<?php echo $row['kode_pegawai']; ?>" readonly></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Gaji Pokok</label>
                              <div class="col-sm-8"><input type="number" class="form-control" id="edt_gaji_pokok" name="gaji_pokok" placeholder="Gaji Pokok" value="<?php echo $row['gaji_pokok']; ?>" readonly></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Bonus</label>
                              <div class="col-sm-8"><input type="number" class="form-control" id="edt_bonus" name="bonus" placeholder="Bonus" value="<?php echo $row['bonus']; ?>" readonly></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button id="nosave" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
                            <input type="hidden" value="<?php echo $kode_transaksi ?>" name="kode_transaksi">
                          </div>
                          <?php
                            }
                          ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- modal detail -->
              <!-- modal update user -->
              <div id="updatetransaksi<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                <div class="modal-dialog">
                  <div class="example-modal">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Edit Data Transaksi</h3>
                      </div>
                      <div class="modal-body">
                          <?php
                          $kode_transaksi = $row['kode_transaksi'];
                          $query = "SELECT * FROM transaksi WHERE kode_transaksi='".$kode_transaksi."'";
                          $kode_pegawai = $row['kode_pegawai'];
                          $result = mysqli_query($con, $query);
                          while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                        <form action="../transaksi/function_transaksi.php?act=updatetransaksi" method="post" role="form">
                          <div class="form-group">
                            <div class="row">
                              <label for="nama_pegawai" class="col-sm-3 control-label text-right">Pegawai</label>
                              <div class="col-sm-8">
                                <select class="custom-select" id="edt_nama_pegawai" name="nama_pegawai" onchange="cek_edtdatabose()">
                                  <?php 
                                  require_once "../koneksi.php";
                                  $pg = mysqli_query($con, "SELECT * FROM pegawai");
                                  ?>

                                  <?php foreach ($pg as $pgw):?>
                                    <option value="<?= $pgw['kode_pegawai']?>" <?php if ($pgw['kode_pegawai']==$row['kode_pegawai']){echo'selected';}?>><?= $pgw['nama_pegawai'];?></option>
                                  <?php endforeach;?>

                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Kode Pegawai</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="edt_kode_pegawai" name="kode_pegawai" placeholder="Kode Pegawai" value="<?php echo $row['kode_pegawai']; ?>" readonly></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Gaji Pokok</label>
                              <div class="col-sm-8"><input type="number" class="form-control" id="edt_gaji_pokok" name="gaji_pokok" placeholder="Gaji Pokok" value="<?php echo $row['gaji_pokok']; ?>" readonly></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Bonus</label>
                              <div class="col-sm-8"><input type="number" class="form-control" id="edt_bonus" name="bonus" placeholder="Bonus" value="<?php echo $row['bonus']; ?>" readonly></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button id="nosave" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="update" class="btn btn-primary" value="Simpan">
                            <input type="hidden" value="<?php echo $kode_transaksi ?>" name="kode_transaksi">
                          </div>
                          <?php
                            }
                          ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- modal update user -->
            </td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>
    <!-- modal insert -->
    <div class="example-modal">
      <div id="tambahtransaksi" class="modal fade" role="dialog" style="display:none;">
        <div class="modal-dialog"> 
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Tambah Transaksi</h3>
            </div>
            <div class="modal-body">
              <form action="../transaksi/function_transaksi.php?act=tambahtransaksi" method="post" role="form">
              <div class="form-group">
                  <div class="row">
                    <label for="nama_pegawai" class="col-sm-3 control-label text-right">Pegawai</label>
                    <div class="col-sm-8">
                      <select class="custom-select" id="nama_pegawai" name="nama_pegawai" onchange="cek_database()">
                      <option>--PILIH--</option>
				                <?php
                        include '../koneksi.php';
                        $datapegawai = mysqli_query($con,"SELECT * FROM pegawai");
				                while($row=mysqli_fetch_array($datapegawai)){
					                  echo "<option value='$row[kode_pegawai]'>$row[nama_pegawai]</option>";
				                }
				                ?>
				              </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label class="col-sm-3 control-label text-right">Kode Pegawai</label>
                  <div class="col-sm-8"><input type="text" class="form-control" id="kode_pegawai" name="kode_pegawai" placeholder="Kode Pegawai" readonly></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label class="col-sm-3 control-label text-right">Gaji Pokok</label>
                  <div class="col-sm-8"><input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" placeholder="Gaji Pokok" readonly></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label class="col-sm-3 control-label text-right">Bonus</label>
                  <div class="col-sm-8"><input type="number" class="form-control" id="bonus" name="bonus" placeholder="Bonus" readonly></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button id="nosave" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Batal</button>
                  <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!-- modal insert close -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript">
      function cek_database(){
        var kode_pegawai = $("#nama_pegawai").val();
          $.ajax({
            url: 'pegawaiajax.php',
            data:"kode_pegawai="+kode_pegawai,
            success : function (data) {
            var json = data,
            obj = JSON.parse(json);
            console.log(json);
            $('#kode_pegawai').val(obj.kode_pegawai);
            $('#gaji_pokok').val(obj.gaji_pokok);
            $('#bonus').val(obj.bonus);
          }
        })
      }
        function cek_edtdatabose(){
        var kode_pegawai = $("#edt_nama_pegawai").val();
          $.ajax({
            url: 'pegawaiajax.php',
            data:"kode_pegawai="+kode_pegawai,
            success : function (data) {
              var json = data,
              obj = JSON.parse(json);
              console.log(obj);
              $('#edt_kode_pegawai').val(obj.kode_pegawai);
              $('#edt_gaji_pokok').val(obj.gaji_pokok);
              $('#edt_bonus').val(obj.bonus);
            }
          })
        }
    </script>
  </body>
</html>