<?php
    $penerbit = $_POST['penerbit'];
    $alamat = $_POST['alamat'];
    if(empty($penerbit)) {
        header("Location:index.php?include=tambah-konten&notif=tambahkosong");
    } else if(empty($alamat)) {
        header("Location:index.php?include=tambah-konten&notif=tambahkosong");
    }else {
        $sql = "INSERT INTO `penerbit` (`penerbit`, `alamat`) VALUES ('$judul', '$alamat')";
        echo $sql;
        mysqli_query($koneksi, $sql);
        header("Location:index.php?include=penerbit&notif=tambahberhasil");
    }
?>