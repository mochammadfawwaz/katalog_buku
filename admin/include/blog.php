    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fab fa-blogger"></i> Blog</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Blog</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Blog</h3>
                <div class="card-tools">
                  <a href="index.php?include=tambah-blog" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Blog</a>
                </div>
              </div>
              <?php 
                 $batas = 2;
                          
                 if(!isset($_GET['halaman'])) {
                   $posisi = 0;
                   $halaman = 1;
                 }else {
                   $halaman = $_GET['halaman'];
                   $posisi = ($halaman - 1) * $batas;
                 }         
              ?>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="post" action="index.php?include=blog">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
              <?php if(!empty($_GET['jenis'])) { ?>
                <?php if($_GET['notif'] == "tambahberhasil") { ?>
                <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
              <?php }} ?>
              <?php if(!empty($_GET['notif'])){?>
                <?php if($_GET['notif']=="tambahberhasil"){?>
                  <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                    <?php }else if($_GET['notif']=="editberhasil"){?>
                      <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                    <?php } ?>
                 <?php }?>
              </div>
              <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="10%">Kategori</th>
                        <th width="15%">Judul</th>
                        <th width="15%">Sinopsis</th>
                        <th width="15%">Tangal</th>
                        <th width="20%">Isi</th>
                        <th width="10%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <!-- Ambil Data -->
                    <?php 

                    if(isset($_POST["katakunci"])){
                      $katakunci_blog = $_POST["katakunci"];
                      $_SESSION['katakunci_blog'] = $katakunci_blog;
                     }

                    $sql_b = "SELECT `b`.`id_blog` ,`k`.`kategori_blog`,`b`.`judul`, `b`.`sinopsis`, `b`.`tanggal`, `b`.`isi`
                    FROM `blog` `b` 
                    INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog` = `k`. `id_kategori_blog`";
                    
                    if (!empty($katakunci_blog)) {
                      $sql_b .= " where `b`.`Judul` LIKE '%$katakunci_blog%' ";
                    }

                    $sql_b .= " ORDER BY `b`.`judul`, `k`.`kategori_blog` limit $posisi, $batas ";

                    if(isset($_SESSION["katakunci_blog"])) {
                      $katakunci_blog = $_SESSION['katakunci_blog'];
                    }

                    $query_b = mysqli_query($koneksi, $sql_b);
                    $no = $posisi+1;
                    while($data_b = mysqli_fetch_row($query_b)) {
                      $id_blog = $data_b[0];
                      $kategori_blog = $data_b[1];
                      $judul = $data_b[2];
                      $sinopsis = $data_b[3];
                      $tanggal = $data_b[4];
                      $isi = $data_b[5];
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $kategori_blog; ?></td>
                        <td><?php echo $judul; ?></td>
                        <td><?php echo $sinopsis; ?></td>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo $isi; ?></td>
                        <td align="center">
                          <a href="index.php?include=edit-blog&data=<?php echo $id_blog; ?>" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                          <a href="index.php?include=detail-blog&data=<?php echo $id_blog; ?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                          <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $judul; ?>'))window.location.href='index.php?include=blog&aksi=hapus&data=<?php echo $id_blog; ?>&if=hapusberhasil'" class="btn btn-xs btn-warning"><i class="fas fa-trash" title="Hapus"></i></a>    
                        </td>
                      </tr>
                      <?php $no++; }?>  
                    </tbody>
                  </table>  
              </div>
              <?php 
                $sql_jum = "SELECT `b`.`id_blog`, `b`.`judul`,`k`.`kategori_blog`, `b`.`tanggal`, `b`.`isi`
                FROM `blog` `b` 
                INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog` = `k`. `id_kategori_blog`";
                if (!empty($katakunci_blog)){
                  $sql_jum .= " where `b`.`Judul` LIKE '%$katakunci_blog%'";
                 }
                $sql_jum .= " ORDER BY `b`.`Judul`";
                $query_jum = mysqli_query($koneksi, $sql_jum);
                $jum_data = mysqli_num_rows($query_jum);
                $jum_halaman = ceil($jum_data/$batas);
              ?>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                <?php 
                    if($jum_halaman == 0) {
                      // tidak ada halaman
                    }else if($jum_halaman == 1) {
                      echo "<li class='page-item'><a class='page-link'>1</a></li>";
                    }else {
                      $sebelum = $halaman - 1;
                      $setelah = $halaman + 1;

                      if($halaman != 1) {
                        echo "
                        <li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=1'>First</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=$sebelum'><<</a></li>";
                      }
                      for($i=1; $i<=$jum_halaman; $i++) {
                        if($i > $halaman - 5 and $i < $halaman + 5 ){
                          if($i!=$halaman) {
                            echo "<li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=$i'>$i</a></li>";
                          }else {
                            echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                          }
                        }
                      }
                      if($halaman != $jum_halaman) {
                        echo "<li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=$setelah'>»</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=$jum_halaman'>Last</a></li>";
                      }
                    }
                  ?>
                </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->