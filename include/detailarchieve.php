<section id="blog-header">
    <div class="container">
        <h1 class="text-white">BLOG</h1>
    </div>
</section><br><br>
<?php
if (isset($_GET['data'])) {
    $tanggal = $_GET['data'];
    $sql_archive = "SELECT `tanggal` FROM `blog` WHERE `tanggal`='$tanggal'";
    $query_archive = mysqli_query($koneksi, $sql_archive);
    while ($data_archive = mysqli_fetch_row($query_archive)) {
        $archive = $data_archive[0];
    } ?>
    <section id="blog-list">
        <main role="main" class="container">
            <h2 class='text-primary'>Archive: <?php echo $tanggal; ?></h2><br>
            <hr>
            <div class="row">
                <div class="col-md-9 blog-main">
                    <div class="blog-post">
                        <?php
                        $batas = 4;
                        if (!isset($_GET['halaman'])) {
                            $posisi = 0;
                            $halaman = 1;
                        } else {
                            $halaman = $_GET['halaman'];
                            $posisi = ($halaman - 1) * $batas;
                        }
                        $sql_d = "SELECT `b`.`judul`,`b`.`isi`, `b`.`tanggal`, `k`.`kategori_blog`, `u`.`nama`, `b`.`id_blog`, `b`.`sinopsis` FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog` = `k`.`id_kategori_blog` INNER JOIN `user` `u` ON `b`.`id_user`= `u`.`id_user` WHERE `b`.`tanggal`='$tanggal'";
                        $sql_d .= " ORDER BY `k`.`kategori_blog`, `b`.`judul` limit $posisi, $batas ";
                        $query_d = mysqli_query($koneksi, $sql_d);
                        $posisi = 1;
                        $jum_d = mysqli_num_rows($query_d);
                        $hasil = ceil($jum_d);
                        while ($data_d = mysqli_fetch_row($query_d)) {
                            $kategori_blog = $data_d[3];
                            $judul = $data_d[0];
                            $isi = $data_d[1];
                            $tanggal = $data_d[2];
                            $date = new DateTime($tanggal);
                            $nama = $data_d[4];
                            $id_blog = $data_d[5];
                            $sinopsis = $data_d[6];

                            if ($hasil == 0) {
                        ?>
                                <h2 class='blog-post-title'>Data tidak ditemukan</h2>
                    </div><br><br><!-- /.blog-post -->
                <?php
                            } else { ?>
                    <h2 class='blog-post-title'><?= $judul ?></h2>
                    <p class='blog-post-meta'><?= $date->format('F d, Y') ?> by <a href='#'><?= $nama ?></a></p>
                    <p><?= $sinopsis ?></p>
                    <a href="index.php?include=detail-blog&data=<?php echo $id_blog; ?>" class="btn btn-primary">Continue reading..</a> <br><br>


        <?php }
                        }
                    }
        ?>
                </div><!-- /.blog-post -->
                <nav class="blog-pagination">
                    <?php

                    $sql_jum = "SELECT `b`.`judul`,`b`.`isi`, `b`.`tanggal`, `k`.`kategori_blog`, `u`.`nama`, `b`.`id_blog` FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog` = `k`.`id_kategori_blog` INNER JOIN `user` `u` ON `b`.`id_user`= `u`.`id_user` WHERE `b`.`tanggal`='$tanggal'";
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
                            echo " <a class='btn btn-outline-primary' href='index.php?include=daftar-archive&data=$tanggal&halaman=$setelah' >Older</a>";
                            echo "<a class='btn btn-outline-primary'href='index.php?include=daftar-archive&data=$tanggal&halaman=$sebelum' >Newer</a>";
                        } else if ($halaman != 1) {
                            echo " <a class='btn btn-outline-secondary disabled' href='index.php?include=daftar-archive&data=$tanggal&halaman=$setelah' aria-disabled='true' >Older</a>";
                            echo "<a class='btn btn-outline-primary' href='index.php?include=daftar-archive&data=$tanggal&halaman=$sebelum' tabindex='-1'>Newer</a>";
                        } else if ($halaman != $jum_halaman) {
                            echo " <a class='btn btn-outline-primary' href='index.php?include=daftar-archive&data=$tanggal&halaman=$setelah' >Older</a>";
                            echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=daftar-archive&data=$tanggal&halaman=$sebelum' tabindex='-1' aria-disabled='true'>Newer</a>";
                        }
                    } ?>
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
    </section><br><br>