<?php 
    if(isset($_SESSION['id_blog'])){
        $id_blog = $_SESSION['id_blog'];
        $id_kategori_blog = $_POST['kategori_blog'];
        $judul = $_POST['judul'];
        $tanggal = $_POST['tanggal'];
        $isi = addslashes($_POST['isi']);
        $lokasi_file = $_FILES['cover']['tmp_name'];
        $nama_file = $_FILES['cover']['name'];
        $direktori = 'cover/'.$nama_file;
        // get cover
        $sql_f = "SELECT `cover`
                  FROM `blog`
                  WHERE `id_blog` = '$id_blog'";
        $query_f = mysqli_query($koneksi, $sql_f);
        while($data_f = mysqli_fetch_row($query_f)) {
            $cover = $data_f[0];
        }
        if(empty($id_kategori_blog)) {
            header("Location:index.php?include=edit-blog&data=$id_kategori_blog&notif=editkosong&jenis=kategoriblog");
        }else if(empty($judul)) {
            header("Location:index.php?include=edit-blog&data=$judul&notif =editkosong&jenis=judul");
        }else if(empty($tanggal)) {
            header("Location:index.php?include=edit-blog&data=$tanggal&notif =editkosong&jenis=tanggal");
        }else if(empty($isi)) {
            header("Location:index.php?include=edit-blog&data=$isi&notif =editkosong&jenis=isi");
        }else {
            $lokasi_file = $_FILES['cover']['tmp_name'];
            $nama_file = $_FILES['cover']['name'];
            $direktori = 'cover/'.$nama_file;
            if(move_uploaded_file($lokasi_file,$direktori)){
            if(!empty($cover)){
            unlink("cover/$cover");
            }
           $sql = "UPDATE `blog` set
            `id_kategori_blog`='$id_kategori_blog',`judul`='$judul',
           `isi`='$isi', `tanggal`=`$tanggal`, `cover`='$nama_file'
           WHERE `id_blog`='$id_blog'";
           mysqli_query($koneksi,$sql);
           }else {
           $sql = "UPDATE `blog` set
            `id_kategori_blog`='$id_kategori_blog',`judul`='$judul', `tanggal`='$tanggal', `isi`='$isi'
           WHERE `id_blog`='$id_blog'";
           mysqli_query($koneksi,$sql);
           }
           header("Location:index.php?include=blog&notif=editberhasil");
        }
    }
?>