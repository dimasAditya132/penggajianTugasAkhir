<?php
    include '../koneksi.php';
?>

<html>
  <head>
    <title>Divisi </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body>
    <h2 align="center">Data Divisi</h2>
    <div class="col-md-6 offset-md-3">
      <div class="box-tools pull-left">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahdivisi"><i class=""></i> Tambah Divisi</a>
      </div>
      <br>
      <table border="1" align="center" class="table table-striped">
        <thead class="thead-dark">
          <tr align="center">
            <th>NO</th>
            <th>Nama Divisi</th>
            <th>Bonus</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            $queryview = mysqli_query($con, "SELECT * FROM divisi");
            while ($row = mysqli_fetch_assoc($queryview)) {
          ?>
          <tr>
            <td><?php echo $no++;?></td>
            <td><?php echo $row['nama_divisi'];?></td>
            <td><?php echo $row['bonus'];?></td>
            <td align="center">
              <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#updatedivisi<?php echo $no; ?>"> Edit</a>
              <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletedivisi<?php echo $no; ?>"> Delete</a>            
              <!-- modal delete -->
              <div class="example-modal">
                <div id="deletedivisi<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Konfirmasi Delete Data Divisi</h3>
                      </div>
                      <div class="modal-body">
                        <h4 align="center" >Apakah anda yakin ingin menghapus divisi <?php echo $row['nama_divisi'];?><strong><span class="grt"></span></strong> ?</h4>
                      </div>
                      <div class="modal-footer">
                        <button id="nodelete" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
                        <a href="../divisi/function_divisi.php?act=deletedivisi&kode_divisi=<?php echo $row['kode_divisi']; ?>" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- modal delete -->
              <!-- modal update user -->
              <div id="updatedivisi<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                <div class="modal-dialog">
                  <div class="example-modal">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Edit Data Divisi</h3>
                      </div>
                      <div class="modal-body">
                        <form action="../divisi/function_divisi.php?act=updatedivisi" method="post" role="form">
                          <?php
                          $kode_divisi = $row['kode_divisi'];
                          $query = "SELECT * FROM divisi WHERE kode_divisi='$kode_divisi'";
                          $result = mysqli_query($con, $query);
                          while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Nama Divisi <span class="text-red">*</span></label>         
                              <div class="col-sm-8"><input type="text" class="form-control" name="nama_divisi" placeholder="Nama Divisi" value="<?php echo $row['nama_divisi']; ?>"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <label class="col-sm-3 control-label text-right">Bonus <span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="number" class="form-control" name="bonus" placeholder="Bonus" value="<?php echo $row['bonus']; ?>"></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button id="nosave" type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="update" class="btn btn-primary" value="Simpan">
                            <input type="hidden" value="<?php echo $kode_divisi ?>" name="kode_divisi">
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
      <div id="tambahdivisi" class="modal fade" role="dialog" style="display:none;">
        <div class="modal-dialog"> 
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Tambah Divisi Baru</h3>
            </div>
            <div class="modal-body">
              <form action="../divisi/function_divisi.php?act=tambahdivisi" method="post" role="form">
                <div class="form-group">
                  <div class="row">
                  <label class="col-sm-3 control-label text-right">Nama Divisi <span class="text-red">*</span></label>         
                  <div class="col-sm-8"><input type="text" class="form-control" name="nama_divisi" placeholder="Nama Divisi" value=""></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label class="col-sm-3 control-label text-right">Bonus <span class="text-red">*</span></label>
                  <div class="col-sm-8"><input type="number" class="form-control" name="bonus" placeholder="Bonus" value=""></div>
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