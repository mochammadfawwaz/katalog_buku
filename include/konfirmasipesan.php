<?php
$nama = $_POST['nama'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];
if (empty($nama)) {
    header("Location:index.php?include=contact&notif=gagalterkirim");
} else if (empty($email)) {
    header("Location:index.php?include=contact&notif=gagalterkirim");
} else if (empty($pesan)) {
    header("Location:index.php?include=contact&notif=gagalterkirim");
} else {
    $sql = "insert into `pesan` (`nama`, `email`, `pesan`) VALUES ( '$nama', '$email', '$pesan')";
    mysqli_query($koneksi, $sql);
    header("Location:index.php?include=contact&notif=pesantelahterkirim");
}