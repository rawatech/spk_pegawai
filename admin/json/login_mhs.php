<?php
	error_reporting(0);
	require_once "../include/koneksi.php";

	if (isset($_POST['username']) && isset($_POST['password'])){
		$mahasiswa = new Mahasiswa();
		$resp = array();

		$username = $_POST['username'];
		$password = $_POST['password'];

		$qryLogin = $mahasiswa->LoginMhs($username, $password);

		if($qryLogin->rowCount() > 0){
			$row = $qryLogin->fetch();

			$resp['login'] = array();

			$login['nim'] = $row['nim'];
			$login['nama_lengkap'] = $row['nama_lengkap'];
			$login['id_jurusan'] = $row['id_jurusan'];
			array_push($resp['login'], $login);

			$resp['success'] = 1;
			$resp['message'] = "Login Success";
			echo json_encode($resp);
		}else{
			$resp['success'] = 0;
			$resp['message'] = "Invalid Username or Password";
			echo json_encode($resp);
		}

	}

?>