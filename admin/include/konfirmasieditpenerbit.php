<?php
if(isset($_SESSION['id_penerbit'])){
    $id_penerbit = $_SESSION['id_penerbit'];
    $penerbit = $_POST['penerbit'];
    $alamat = $_POST['alamat'];
 if(empty($penerbit)) {
    header("Location:index.php?include=tambah-penerbit&data=".$penerbit."&notif=editkosong");
 }else if(empty($alamat)) {
    header("Location:index.php?include=tambah-penerbit&data=".$alamat."&notif=editkosong");
 }else{
    $sql = "update `penerbit` set `penerbit`='$penerbit', `alamat` = '$alamat' where `id_penerbit`='$id_penerbit'";
    mysqli_query($koneksi,$sql);
    header("Location:index.php?include=penerbit&notif=editberhasil");
 }
}
?>