<?php
    $tag = $_POST['tag'];
    if(empty($tag)) {
        header("Location:index.php?include=tambah-tag&notif=tambahkosong");
    }else {
        $sql = "INSERT INTO `tag` (`tag`) VALUES ('$tag')";
        echo $sql;
        mysqli_query($koneksi, $sql);
        header("Location:index.php?include=tag&notif=tambahberhasil");
    }
?>