<?php
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal'];
    if(empty($judul)) {
        header("Location:index.php?include=tambah-konten?notif=tambahkosong");
    } else if(empty($isi)) {
        header("Location:index.php?include=tambah-konten?notif=tambahkosong");
    } else if(empty($tanggal)) {
        header("Location:index.php?include=tambah-konten?notif=tambahkosong");
    }else {
        $sql = "INSERT INTO `konten` (`judul`, `isi`, `tanggal`) VALUES ('$judul', '$isi', '$tanggal')";
        echo $sql;
        mysqli_query($koneksi, $sql);
        header("Location:index.php?include=konten&notif=tambahberhasil");
    }
?>