<?php
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal'];
    if(empty($judul)) {
        header("Location:tambahkonten.php?notif=tambahkosong");
    } else if(empty($isi)) {
        header("Location:tambahkonten.php?notif=tambahkosong");
    } else if(empty($tanggal)) {
        header("Location:tambahkonten.php?notif=tambahkosong");
    }else {
        $sql = "INSERT INTO `konten` (`judul`, `isi`, `tanggal`) VALUES ('$judul', '$isi', '$tanggal')";
        echo $sql;
        mysqli_query($koneksi, $sql);
        header("Location:konten.php?notif=tambahberhasil");
    }
?>