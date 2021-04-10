<?php
if(isset($_SESSION['id_konten'])){
    $id_konten = $_SESSION['id_konten'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal'];
 if(empty($judul)) {
    header("Location:index.php?include=edit-konten&data=".$judul."&notif=editkosong");
 }else if(empty($isi)) {
    header("Location:index.php?include=edit-konten&data=".$isi."&notif=editkosong");
 }else if(empty($tanggal)) {
    header("Location:index.php?include=edit-konten&data=".$tanggal."&notif=editkosong");
 }else{
    $sql = "update `konten` set `judul`='$judul', `isi` = '$isi', `tanggal` = '$tanggal'
    where `id_konten`='$id_konten'";
    mysqli_query($koneksi,$sql);
    header("Location:index.php?include=konten&notif=editberhasil");
 }
}
?>