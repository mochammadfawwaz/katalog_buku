<?php 
    $koneksi = mysqli_connect("localhost", "root", "password", "katalog_buku");

    if(!$koneksi) {
        die("Error koneksi: " . mysqli_connect_errno());
    }

?>