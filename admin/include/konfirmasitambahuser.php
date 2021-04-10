<?php
    $jeneng = $_POST['jeneng'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];
    $lokasi_file = $_FILES['cover']['tmp_name'];
    $nama_file = $_FILES['cover']['name'];
    $direktori = 'cover/'.$nama_file;

    if(empty($jeneng)) {
        //header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=nama");
    }else if(empty($email)) {
        //header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=email");
    }else if(empty($username)) {
        //header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=username");
    }else if(empty($password)) {
        //header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=password");
    }else if(empty($level)) {
        //header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=level");
    }else if(!move_uploaded_file($lokasi_file, $direktori)) {
        //header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=cover");
    }else {
        $sql = "INSERT INTO `user`(`nama`, `email`, `username`, `password`, `level`, `foto`) VALUES ('$jeneng', '$email', '$username', '$password', '$level', '$nama_file')";
        mysqli_query($koneksi, $sql);
        $id_user = mysqli_insert_id($koneksi);
        echo $sql;
        //header("Location:index.php?include=user&notif=tambahberhasil");
    }
?>