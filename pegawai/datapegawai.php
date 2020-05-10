<?php
  include '../koneksi.php';
?>

<html>
  <head>
    <title>Pegawai </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body>
    <h2 align="center">Data Pegawai</h2>
    <div class="">
      <div class="box-tools pull-left">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahpegawai"><i class=""></i> Tambah Pegawai</a>
      </div>
      <br>
      <table border="1" align="center" class="table table-striped">
        <thead class="thead-dark">
          <tr align="center" >
            <th width="2%"  >NO</th>
            <th width="12%" >Nama Pegawai</th>
            <th width="6%"  >Jenis Kelamin</th>
            <th width="5%"  >Tempat Lahir</th>
            <th width="7%"  >Tanggal Lahir</th>
            <th width="5%"  >Status Menikah</th>
            <th width="5%"  >Golongan</th>
            <th width="5%"  >Gaji Pokok</th>
            <th width="7%"  >Divisi</th>
            <th width="5%"  >Bonus</th>
            <th width="20%" >Alamat</th>
            <th width="7%"  >Tanggal Masuk</th>
            <th width="4%"  >Status</th>
            <th width="10%" >Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            $queryview = mysqli_query($con, "SELECT p.kode_pegawai, p.nama_pegawai,p.jenis_kelamin,p.tempat_lahir,p.tgl_lahir,p.status_menikah,g.nama_golongan,p.gaji_pokok,d.nama_divisi,p.bonus,p.alamat,p.tgl_masuk,p.status FROM pegawai p, golongan g, divisi d WHERE p.kode_golongan=g.kode_golongan AND p.kode_divisi=d.kode_divisi");
            while ($row = mysqli_fetch_assoc($queryview)) {
          ?>
          <?php
          $cekjk =$row['jenis_kelamin'];
          if($cekjk=="P" || $cekjk=="p"){
              $jenis_kelamin="Perempuan";
          }else{
              $jenis_kelamin="Laki-laki";
          }
          $cekkw =$row['status_menikah'];
          if($cekkw=="K" || $cekkw=="k"){
              $kw="Kawin";
          }else{
              $kw="Belum Kawin";
          }
          ?>
          <tr align="center">
            <td><?php echo $no++;?></td>
            <td><?php echo $row['nama_pegawai'];?></td>
            <td><?php echo $jenis_kelamin; ?></td>
            <td><?php echo $row['tempat_lahir'];?></td>
            <td><?php echo $row['tgl_lahir'];?></td>
            <td><?php echo $kw; ?></td>
            <td><?php echo $row['nama_golongan'];?></td>
            <td><?php echo $row['gaji_pokok'];?></td>
            <td><?php echo $row['nama_divisi'];?></td>
            <td><?php echo $row['bonus'];?></td>
            <td><?php echo $row['alamat'];?></td>
            <td><?php echo $row['tgl_masuk'];?></td>
            <td><?php echo $row['status'];?></td>
            <td align="center">
              <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#updatepegawai<?php echo $no; ?>"> Edit</a>
              <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletepegawai<?php echo $no; ?>"> Delete</a>                                          
              <!-- modal delete -->
              <div class="example-modal">
                <div id="deletepegawai<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Konfirmasi Delete Data Pegawai</h3>
                      </div>
                      <div class="modal-body">
                        <h4 align="center" >Apakah anda yakin ingin menghapus data pegawai <?php echo $row['nama_pegawai'];?><strong><span class="grt"></span></strong> ?</h4>
                      </div>
                      <div class="modal-footer">
                        <button id="nodelete" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
                                  <a href="../pegawai/function_pegawai.php?act=deletepegawai&kode_pegawai=<?php echo $row['kode_pegawai']; ?>" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- modal delete -->
              <!-- modal update user -->
              <div class="example-modal">
                <div id="updatepegawai<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Edit Data Pegawai</h3>
                      </div>
                      <div class="modal-body">
                        <?php
                          $kode_pegawai = $row['kode_pegawai'];
                          $jenis_kelamin = $row['jenis_kelamin'];
                          $status_menikah = $row['status_menikah'];
                          $kode_golongan = $row['kode_golongan'];
                          $query = "SELECT * FROM pegawai WHERE kode_pegawai='".$kode_pegawai."'";
                          $result = mysqli_query($con, $query);
                          while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <form action="../pegawai/function_pegawai.php?act=updatepegawai" method="post" role="form">
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Nama Pegawai <span class="text-red">*</span></label>         
                              <div class="col-sm-8"><input type="text" class="form-control" name="nama_pegawai" placeholder="Nama Pegawai" value="<?php echo $row["nama_pegawai"]; ?>"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label for="jenis_kelamin" class="col-sm-3 control-label text-right">Jenis Kelamin</label>
                              <div class="col-sm-8">
                                <select class="custom-select" name="jenis_kelamin">
                                  <option value="L" <?php if($jenis_kelamin == 'L' || $jenis_kelamin == 'l') { echo 'selected="selected"'; } ?>>Laki-laki</option>
                                  <option value="P" <?php if($jenis_kelamin == 'P' || $jenis_kelamin == 'p') { echo 'selected="selected"'; } ?>>Perempuan</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Tempat Lahir<span class="text-red">*</span></label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $row["tempat_lahir"]; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Tanggal Lahir <span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir" value="<?php echo $row["tgl_lahir"]; ?>"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label for="status_menikah" class="col-sm-3 control-label text-right">Status Menikah</label>
                              <div class="col-sm-8">
                                <select class="custom-select" name="status_menikah">
                                  <option value="B" <?php if($status_menikah == 'B' || $status_menikah == 'b') { echo 'selected="selected"'; } ?>>Belum Kawin</option>
                                  <option value="K" <?php if($status_menikah == 'K' || $status_menikah == 'k') { echo 'selected="selected"'; } ?>>Kawin</option>
                                </select>
                              </div>
                          </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label for="nama_golongan" class="col-sm-3 control-label text-right">Golongan</label>
                              <div class="col-sm-8">
                                <select class="custom-select" id="edit_nama_golongan" name="nama_golongan"  onchange="cek_edtdatabase()">                                
                                  <?php 
                                  require_once "../koneksi.php";
                                  $dg = mysqli_query($con, "SELECT * FROM golongan");
                                  ?>

                                  <?php foreach ($dg as $key):?>
                                    <option value="<?= $key['kode_golongan']?>" <?php if ($key['kode_golongan']==$row['kode_golongan']){echo'selected';}?>><?= $key['nama_golongan'];?></option>
                                  <?php endforeach;?>

                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Gaji Pokok<span class="text-red"></span></label>
                              <div class="col-sm-8"><input type="text" class="form-control input-md" id="edit_gaji_pokok" name="gaji_pokok" placeholder="Gaji Pokok" value="<?php echo $row['gaji_pokok']; ?>" readonly></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label for="nama_divisi" class="col-sm-3 control-label text-right">Divisi</label>
                              <div class="col-sm-8">
                                <select class="custom-select" id="edit_nama_divisi" name="nama_divisi" onchange="cek_edtdatabose()">
                                <?php 
                                  require_once "../koneksi.php";
                                  $dv = mysqli_query($con, "SELECT * FROM divisi");
                                  ?>

                                  <?php foreach ($dv as $kay):?>
                                    <option value="<?= $kay['kode_divisi']?>" <?php if ($kay['kode_divisi']==$row['kode_divisi']){echo'selected';}?>><?= $kay['nama_divisi'];?></option>
                                  <?php endforeach;?>

                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Bonus<span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="text" class="form-control input-md" id="edit_bonus" name="bonus"  value="<?php echo $row["bonus"];?>" place  holder="Bonus" readonly></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Alamat<span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $row["alamat"]; ?>"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Tanggal Masuk<span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="date" class="form-control" name="tgl_masuk" placeholder="Tanggal Masuk" value="<?php echo $row["tgl_masuk"]; ?>"></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button id="nosave" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="update" class="btn btn-primary" value="Simpan">
                            <input type="hidden" value="<?php echo $kode_pegawai ?>" name="kode_pegawai">
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
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- modal insert -->
    <div class="example-modal">
      <div id="tambahpegawai" class="modal fade" role="dialog" style="display:none;">
        <div class="modal-dialog"> 
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Tambah Pegawai Baru</h3>
            </div>
            <div class="modal-body">
              <form action="../pegawai/function_pegawai.php?act=tambahpegawai" method="post" role="form">
                <div class="form-group">
                  <div class="row">
                    <label class="col-sm-3 control-label text-right">Nama Pegawai <span class="text-red">*</span></label>         
                    <div class="col-sm-8"><input type="text" class="form-control" name="nama_pegawai" placeholder="Nama Pegawai" value=""></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label for="jenis_kelamin" class="col-sm-3 control-label text-right">Jenis Kelamin</label>
                    <div class="col-sm-8">
                      <select class="custom-select" name="jenis_kelamin">
                        <option value="L">Laki-laki</option>
				                <option value="P">Perempuan</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                      <label class="col-sm-3 control-label text-right">Tempat Lahir<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-sm-3 control-label text-right">Tanggal Lahir <span class="text-red">*</span></label>
                    <div class="col-sm-8"><input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir" value=""></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label for="status_menikah" class="col-sm-3 control-label text-right">Status Menikah</label>
                    <div class="col-sm-8">
                      <select class="custom-select" name="status_menikah">
                        <option value="B">Belum Kawin</option>
				                <option value="K">Kawin</option>
                      </select>
                    </div>
                </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label for="nama_golongan" class="col-sm-3 control-label text-right">Golongan</label>
                    <div class="col-sm-8">
                      <select class="custom-select" id="nama_golongan" name="nama_golongan" onchange="cek_database()">
                      <option>--PILIH--</option>
				                <?php
                        include '../koneksi.php';
                        $datagolongan = mysqli_query($con,"SELECT * FROM golongan");
				                while($row=mysqli_fetch_array($datagolongan)){
					                  echo "<option value='$row[kode_golongan]'>$row[nama_golongan]</option>";
				                }
				                ?>
				              </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-sm-3 control-label text-right">Gaji Pokok<span class="text-red"></span></label>
                    <div class="col-sm-8"><input type="text" class="form-control input-md" id="gaji_pokok" name="gaji_pokok" placeholder="Gaji Pokok" readonly></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label for="nama_divisi" class="col-sm-3 control-label text-right">Divisi</label>
                    <div class="col-sm-8">
                      <select class="custom-select" id="nama_divisi" name="nama_divisi" onchange="cek_databose()">
                      <option>--PILIH--</option>
				                <?php
                        include '../koneksi.php';
                        $datadivisi = mysqli_query($con,"SELECT * FROM divisi");
				                while($row=mysqli_fetch_array($datadivisi)){
					                  echo "<option value='$row[kode_divisi]'>$row[nama_divisi]</option>";
				                }
				                ?>
				              </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-sm-3 control-label text-right">Bonus<span class="text-red">*</span></label>
                    <div class="col-sm-8"><input type="text" class="form-control input-md" id="bonus" name="bonus" placeholder="Bonus" readonly></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-sm-3 control-label text-right">Alamat<span class="text-red">*</span></label>
                    <div class="col-sm-8"><input type="text" class="form-control" name="alamat" placeholder="Alamat" value=""></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-sm-3 control-label text-right">Tanggal Masuk<span class="text-red">*</span></label>
                    <div class="col-sm-8"><input type="date" class="form-control" name="tgl_masuk" placeholder="Tanggal Masuk" value=""></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button id="nosave" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Batal</button>
                  <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><!-- modal insert close -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript">
      function cek_database(){
        var kode_golongan = $("#nama_golongan").val();
          $.ajax({
            url: 'ajax.php',
            data:"kode_golongan="+kode_golongan,
            success : function (data) {
            var json = data,
            obj = JSON.parse(json);
            console.log(json);
            $('#gaji_pokok').val(obj.gaji_pokok);
          }
        })
      }
      function cek_databose(){
        var kode_divisi = $("#nama_divisi").val();
          $.ajax({
            url: 'ajaxdivisi.php',
            data:"kode_divisi="+kode_divisi,
            success : function (data) {
              var json = data,
              obj = JSON.parse(json);
              console.log(json);
              $('#bonus').val(obj.bonus);
            }
          })
        }
        function cek_edtdatabose(){
        var kode_divisi = $("#edit_nama_divisi").val();
          $.ajax({
            url: 'ajaxdivisi.php',
            data:"kode_divisi="+kode_divisi,
            success : function (data) {
              var json = data,
              obj = JSON.parse(json);
              console.log(obj);
              $('#edit_bonus').val(obj.bonus);
            }
          })
        }
        function cek_edtdatabase(){
        var kode_golongan = $("#edit_nama_golongan").val();
          $.ajax({
            url: 'ajax.php',
            data:"kode_golongan="+kode_golongan,
            success : function (data) {
            var json = data,
            obj = JSON.parse(json);
            console.log(obj);
            $('#edit_gaji_pokok').val(obj.gaji_pokok);
          }
        })
      }
    </script>
  </body>
</html>