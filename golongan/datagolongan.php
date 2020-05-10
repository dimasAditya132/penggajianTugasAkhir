<?php
    include '../koneksi.php';
?>

<html>
  <head>
    <title>Golongan </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body>
    <h2 align="center">Data Golongan</h2>
    <div class="col-md-6 offset-md-3">
      <div class="box-tools pull-left">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahgolongan"><i class=""></i> Tambah Golongan</a>
      </div>
      <br>
      <table border="1" align="center" class="table table-striped">
        <thead class="thead-dark">
          <tr align="center">
              <th>NO</th>
              <th>Nama Golongan</th>
              <th>Gaji Pokok</th>
              <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            $queryview = mysqli_query($con, "SELECT * FROM golongan");
            while ($row = mysqli_fetch_assoc($queryview)) {
          ?>
          <tr>
            <td><?php echo $no++;?></td>
            <td><?php echo $row['nama_golongan'];?></td>
            <td><?php echo $row['gaji_pokok'];?></td>
            <td align="center">
              <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#updategolongan<?php echo $no; ?>"> Edit</a>
              <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletegolongan<?php echo $no; ?>"> Delete</a>  
              <!-- modal delete -->
              <div class="example-modal">
                <div id="deletegolongan<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Konfirmasi Delete Data Golongan</h3>
                      </div>
                      <div class="modal-body">
                        <h4 align="center" >Apakah anda yakin ingin menghapus golongan <?php echo $row['nama_golongan'];?><strong><span class="grt"></span></strong> ?</h4>
                      </div>
                      <div class="modal-footer">
                        <button id="nodelete" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
                        <a href="../golongan/function_golongan.php?act=deletegolongan&kode_golongan=<?php echo $row['kode_golongan']; ?>" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- modal delete -->
              <!-- modal update user -->
              <div class="example-modal">
                <div id="updategolongan<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Edit Data Golongan</h3>
                      </div>
                      <div class="modal-body">
                        <form action="../golongan/function_golongan.php?act=updategolongan" method="post" role="form">
                          <?php
                          $kode_golongan = $_GET['kode_golongan'];
                          $query = "SELECT * FROM golongan WHERE kode_golongan='$kode_golongan'";
                          $result = mysqli_query($con, $query);
                          while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Nama Golongan <span class="text-red">*</span></label>         
                              <div class="col-sm-8"><input type="text" class="form-control" name="nama_golongan" placeholder="Nama Golongan" value="<?php echo $row['nama_golongan']; ?>"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Gaji Pokok <span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="number" class="form-control" name="gaji_pokok" placeholder="Gaji Pokok" value="<?php echo $row['gaji_pokok']; ?>"></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button id="nosave" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="update" class="btn btn-primary" value="Simpan">
                            <input type="hidden" value="<?php echo $kode_golongan ?>" name="kode_golongan">
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
      <div id="tambahgolongan" class="modal fade" role="dialog" style="display:none;">
        <div class="modal-dialog"> 
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Tambah Golongan Baru</h3>
            </div>
            <div class="modal-body">
              <form action="../golongan/function_golongan.php?act=tambahgolongan" method="post" role="form">
                <div class="form-group">
                  <div class="row">
                    <label class="col-sm-3 control-label text-right">Nama Golongan <span class="text-red">*</span></label>         
                    <div class="col-sm-8"><input type="text" class="form-control" name="nama_golongan" placeholder="Nama Golongan" value=""></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-sm-3 control-label text-right">Gaji Pokok <span class="text-red">*</span></label>
                    <div class="col-sm-8"><input type="number" class="form-control" name="gaji_pokok" placeholder="Gaji Pokok" value=""></div>
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
  </body>
</html>