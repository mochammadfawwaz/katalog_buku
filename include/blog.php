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
          <?php


          $batas = 1;
          if (!isset($_GET['halaman'])) {
            $posisi = 0;
            $halaman = 1;
          } else {
            $halaman = $_GET['halaman'];
            $posisi = ($halaman - 1) * $batas;
          }
          $sql_b = "SELECT `b`.`id_blog`, `k`.`kategori_blog`, `b`.`tanggal`, `b`.`judul`, `b`.`isi`, `u`.`nama` FROM `blog` `b` INNER JOIN `user` `u` ON `b`.`id_user` = `u`.`id_user` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog` = `k`.`id_kategori_blog`";
            $sql_b .= " ORDER BY `b`.`judul`, `k`.`kategori_blog` limit $posisi, $batas";
            $query_b = mysqli_query($koneksi, $sql_b);
            $posisi = 1;
            while($data_b = mysqli_fetch_row($query_b)){
              $id_blog = $data_b['0'];
              $kategori_blog = $data_b['1'];
              $tanggal = $data_b['2'];
              $judul = $data_b['3'];
              $isi = $data_b['4'];
              $nama = $data_b['5'];
            ?>
            <h2 class="blog-post-title"><a href="#"><?= $judul; ?></a></h2>
            <p class="blog-post-meta"><?= $tanggal; ?> by <?= $nama; ?></p>
            <!--<img src="slideshow/slide-1.jpg" class="img-fluid" alt="Responsive image"><br><br>-->

            <p class="text-justify"><?= $isi; ?> <br> <b>...</b></p>
            <a href="index.php?include=detail-blog&data=<?php echo $id_blog; ?>" class="btn btn-primary">Continue reading..</a> <br><br>
          <?php $posisi++;
          } ?>
        </div><!-- /.blog-post --><br><br>
        <nav class="blog-pagination">
          <?php
          $sql_jum = "SELECT `b`.`id_blog`, `k`.`kategori_blog`, `b`.`tanggal`, `b`.`judul`, `b`.`isi`, `u`.`nama` FROM `blog` `b` INNER JOIN `user` `u` ON `b`.`id_user` = `u`.`id_user` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog` = `k`.`id_kategori_blog`";
          $sql_jum .= " ORDER BY `k`.`kategori_blog`, `b`.`Judul`";
          $query_jum = mysqli_query($koneksi, $sql_jum);
          $jum_data = mysqli_num_rows($query_jum);
          $jum_halaman = ceil($jum_data / $batas);

          if ($jum_halaman == 0) {
            echo 'tidak ada halaman';
          } else if ($jum_halaman == 1) {
            echo " <a class='btn btn-outline-secondary disabled' href='#' aria-disabled='true'>Older</a>";
            echo "<a class='btn btn-outline-secondary disabled' href='#' tabindex='-1' aria-disabled='true'>Newer</a>";
          } else {
            $sebelum = $halaman - 1;
            $setelah = $halaman + 1;


            if ($halaman > 1 && $halaman < $jum_halaman) {
              echo " <a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$setelah' >Older</a>";
              echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$sebelum' >Newer</a>";
            } else if ($halaman != 1) {
              echo " <a class='btn btn-outline-secondary disabled' href='index.php?include=blog&halaman=$setelah' aria-disabled='true' >Older</a>";
              echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$sebelum' tabindex='-1'>Newer</a>";
            } else if ($halaman != $jum_halaman) {
              echo " <a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$setelah' >Older</a>";
              echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=blog&halaman=$sebelum' tabindex='-1' aria-disabled='true'>Newer</a>";
            }
          } ?>
        </nav>

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
              <li class="list-group-item"><a href="index.php?include=detail-kategori-buku&data=<?php echo $id_kat; ?>"><?php echo $nama_kat; ?></a></li>
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
            <li class="list-group-item"><a href="index.php?include=daftar-archive&data=<?php echo $Tanggal; ?>"> <?php echo $Tanggal; ?></a></li>
          <?php } ?>
        </ol>
      </aside>

    </div><!-- /.row -->

  </main><!-- /.container -->
</section><br><br>