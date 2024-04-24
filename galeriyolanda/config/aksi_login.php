<?php 	
session_start();
require 'koneksi.php';

$username = $_POST['username'];
$password = ($_POST['password']);

$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");

$cek =mysqli_num_rows($sql);

if ($cek > 0) {
	$data =mysqli_fetch_array($sql);

	$_SESSION['username'] = $data['username'];
	$_SESSION['userid'] = $data['userid'];
	$_SESSION['status'] = 'login';
	echo "<script>
	alert('Login Berhasil');
	location.href='../admin/index.php';

	</script>";
}else{
	echo "<script>
	alert('Username atau password salah!');
	location.href='../login.php';
	</script>";

}
	


 ?>