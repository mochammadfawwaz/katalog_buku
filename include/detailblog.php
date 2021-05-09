<?php
    // @session_start();
    // include('../koneksi/koneksi.php');
    if(isset($_GET['data'])){
    $id_blog = $_GET['data'];
    //get data blog
    $sql = "SELECT `k`.`kategori_blog`, `b`.`id_user`, `u`.`nama`, `b`.`judul`, `b`.`tanggal`, `b`.`isi` 
    FROM `blog` `b`
    INNER JOIN `kategori_blog` `k` 
    ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog`
    INNER JOIN `user` `u` 
    ON `b`.`id_user`=`u`.`id_user`
    WHERE `b`.`id_blog`='$id_blog'";
    $query = mysqli_query($koneksi,$sql);
    while($data = mysqli_fetch_row($query)){
    $kategori_blog = $data[0];
    $id_user = $data[1];
    $nama = $data[2];
    $judul = $data[3];
    $tanggal = $data[4];
    $isi = $data[5];
      }
    } 
  ?>
    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">BLOG</h1>
      </div>
    </section><br><br>
    <section id="blog-list">
      <main role="main" class="container">
        <div class="row">
          <div class="col-md-9 blog-main">
            <div class="blog-post">
              <h2 class="blog-post-title"><?php echo $judul; ?></h2>
              <p class="blog-post-meta"><?php echo $kategori_blog; ?> - <?php echo $tanggal; ?> by <a href="#"><?php echo $nama; ?></a></p>

              <p><?php echo $isi; ?></p>
            </div><br><br><!-- /.blog-post -->

           

          </div><!-- /.blog-main -->
      
          <aside class="col-md-3 blog-sidebar">
        <!-- categories -->
        <div class="pb-4">
          <h5>Kategori</h5>
          <ol class="list-group list-group-flush mb-0">
            <?php $sql_k = "SELECT `id_kategori_blog`,`kategori_blog` FROM `kategori_blog` ORDER BY `kategori_blog`";
            $query_k = mysqli_query($koneksi, $sql_k);
            while ($data_k = mysqli_fetch_row($query_k)) {
              $id_kat = $data_k[0];
              $nama_kat = $data_k[1]; ?>
              <li class="list-group-item"><a href="index.php?include=detail-kategori-blog&data=<?php echo $id_kat; ?>"><?php echo $nama_kat; ?></a></li>
            <?php } ?>
          </ol>
        </div>

        <!-- list archive blog -->
        <h5>Archives</h5>
        <ol class="list-group list-group-flush mb-5">
          <?php $sql_t = "SELECT `id_blog`,`tanggal` FROM `blog` GROUP BY `tanggal`";
          $query_t = mysqli_query($koneksi, $sql_t);
          while ($data_t = mysqli_fetch_row($query_t)) {
            $id_blog = $data_t[0];
            $Tanggal = $data_t[1]; ?>
            <li class="list-group-item"><a href="index.php?include=detail-archive&data=<?php echo $Tanggal; ?>"> <?php echo $Tanggal; ?></a></li>
          <?php } ?>
        </ol>
      </aside>
      
        </div><!-- /.row -->
      
      </main><!-- /.container -->
    </section>