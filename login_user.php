<?php
	session_start();
	include "include/koneksi.php";
	
	if(isset($_POST['username']) && isset($_POST['password'])){

		$user = new User();

		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$qry = $user->LoginUser($username, $password);

		if($qry->rowCount() > 0){
			$row = $qry->fetch();
			$_SESSION['user'] = $row['id_user'];
			echo "<script language='javascript'>alert('Login Berhasil');document.location='index.php'</script>";
		}else{
			echo "<script language='javascript'>alert('Login Gagal');document.location='index.php'</script>";
		}

	}

?>