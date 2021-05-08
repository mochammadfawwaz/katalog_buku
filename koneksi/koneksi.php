<?php 
    $koneksi = mysqli_connect("localhost", "root", "", "katalog_buku");

    if(!$koneksi) {
        die("Error koneksi: " . mysqli_connect_errno());
    }

?>

<!-- ubah foto profil tak bisa, edit kategori buku tak bisa, tambah edit dan hapus tag tidak bisa, eror tambah edit dan hapus penerbit, tambah kategori blog tidak bisa, edit konten ndak bisa, tambah edit dan pagination buku ndak bisa, tambah blog tak bisa, tambah edit user ndak bisa dan mana profil mahasiswa? konten selamat datang? paginasti list -->