<?php
	error_reporting(0);
	include "../include/koneksi.php";

	if(isset($_POST['nim']) && isset($_POST['topik']) && isset($_POST['isi'])){
		$nim = $_POST['nim'];
		$topik = $_POST['topik'];
		$isi = $_POST['isi'];

		if(isset($_POST['file'])){
			$file = $_POST['file'];
		}else{
			$file = "";
		}

		$cl_pengaduan = new Pengaduan();

		$qry = $cl_pengaduan->InsertData($nim, $topik, $isi, $file);

		if($qry){
			$resp['success'] = 1;
			$resp['message'] = "Data pengaduan berhasil disimpan";
		}else{
			$resp['success'] = 0;
			$resp['message'] = "Gagal";
		}

		echo json_encode($resp);
	}

?>