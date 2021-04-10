<?php
    $id_kategori_blog = $_POST['kategori_blog'];
    $judul = $_POST['judul'];
    $id_user = $_SESSION['id_user'];
    $tanggal = $_POST['tanggal'];
    $isi = $_POST['isi'];

    if(empty($id_kategori_blog)) {
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=kategoriblog");
    }else if(empty($judul)) {
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=judul");
    }else if(empty($tanggal)) {
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=tanggal");
    }else if(empty($isi)) {
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=isi");
    }else {
        $sql = "INSERT INTO `blog`(`id_kategori_blog`, `id_user`, `tanggal`, `judul`, `isi`) VALUES ('$id_kategori_blog', '$id_user', '$tanggal', '$judul', '$isi')";
        mysqli_query($koneksi, $sql);
        $id_blog = mysqli_insert_id($koneksi);

        header("Location:index.php?include=blog&notif=tambahberhasil");
    }
?>