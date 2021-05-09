<?php include("koneksi/koneksi.php");?>
<!-- gustisa -->
<!doctype html>
<html lang="en">
  <head>
   <?php include("includes/head.php"); ?>
  </head>
  <body>
    <?php include("includes/navigasi.php"); ?>

    <?php
      if(isset($_GET["include"])) {
        $include = $_GET['include'];
        if($include=="detail-buku") {
          include("include/detailbuku.php");
        }else if($include=="about-us") {
          include("include/aboutus.php");
        }else if($include=="detail-kategori-buku") {
          include("include/detailkategoribuku.php");
        }else if($include=="detail-kategori-blog") {
          include("include/detailkategoriblog.php");
        }else if($include=="detail-tag") {
          include("include/detailtag.php");
        }else if($include=="detail-archive") {
          include("include/detailarchieve.php");
        }else if($include=="blog") {
          include("include/blog.php");
        }else if($include=="detail-blog") {
          include("include/detailblog.php");
        }else if($include=="contact-us") {
          include("include/contactus.php");
        }else if($include=="konfirmasi-pesan") {
          include("include/konfirmasipesan.php");
        }else {
          include("include/index.php");
        }
      }else {
        include("include/index.php");
      }
    ?>
    <?php include("includes/footer.php"); ?>

    <!-- Script -->
    <?php include("includes/script.php");  ?>
  </body>
</html>