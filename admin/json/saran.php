<?php
	error_reporting(0);
	include "../include/koneksi.php";

	if(isset($_POST['topik']) && isset($_POST['saran']) && isset($_POST['rating'])){
		$topik = $_POST['topik'];
		$saran = $_POST['saran'];
		$rating = $_POST['rating'];

		$cl_saran = new Saran();

		$qry = $cl_saran->InsertData($topik, $saran, $rating);

		if($qry){
			$resp['success'] = 1;
			$resp['message'] = "Data berhasil disimpan";
		}else{
			$resp['success'] = 0;
			$resp['message'] = "Gagal";
		}

		echo json_encode($resp);
	}

?>