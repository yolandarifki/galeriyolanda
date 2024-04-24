<?php 
require 'koneksi.php';

$username = $_POST['username'];
$password = ($_POST['password']);
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

$sql = mysqli_query($koneksi, "INSERT INTO user VALUES('','$username','$password','$email','$namalengkap','$alamat')");

if ($sql) {
	echo "<script> 
	alert('Ajay Berhasil');
	location.href='../login.php';


	</script>";
}


 ?>