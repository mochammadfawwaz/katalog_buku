<?php
if(isset($_SESSION['id_user'])){
  $id_user = $_SESSION['id_user'];
  $nama = $_POST['jeneng'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $level = $_POST['level'];

  //get foto
 $sql_f = "SELECT `foto` FROM `user` WHERE `id_user`='$id_user'";
 $query_f = mysqli_query($koneksi,$sql_f);
 while($data_f = mysqli_fetch_row($query_f)){
 $foto = $data_f[0];
 //echo $foto;
 }
if(empty($nama)){
  header("Location:edituser.php?notif=editkosong&jenis=nama");
}else if(empty($email)){
  header("Location:index.php?include=edit-user&notif=editkosong&jenis=email");
}else if(empty($username)){
  header("Location:index.php?include=edit-user&notif=editkosong&jenis=username");
}else if(empty($password)){
  header("Location:index.php?include=edit-user&notif=editkosong&jenis=password");
}else if(empty($level)){
  header("Location:index.php?include=edit-user&notif=editkosong&jenis=level");
}else{
  $lokasi_file = $_FILES['foto']['tmp_name'];
 $nama_file = $_FILES['foto']['name'];
 // echo $nama_file;
$direktori = 'foto/'.$nama_file;
if(move_uploaded_file($lokasi_file,$direktori)){
 if(!empty($foto)){
 unlink("foto/$foto");
 }
 $sql = "update `user` set `nama`='$nama',
 `email`='$email', `username`='$username', `password`='$password',`level`='$level', `foto`='$nama_file' where `id_user`='$id_user'";
 // echo $sql;
   mysqli_query($koneksi,$sql);
}else{
   $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `password`='$password', 'level'='$level'
    where `id_user`='$id_user'";
 // echo $sql;
   mysqli_query($koneksi,$sql);
}
    header("Location:index.php?include=user&notif=editberhasil");
  }
}
?>
