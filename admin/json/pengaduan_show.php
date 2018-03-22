<?php
	error_reporting(0);
	include "../include/koneksi.php";

	$cl_pengaduan = new Pengaduan();

	if(isset($_POST['nim'])){
		$nim = $_POST['nim'];

		$get = $cl_pengaduan->GetData("where nim = '$nim' order by tanggal desc");
		$resp = array();

		$resp['pengaduan'] = array();

		if($get->rowCount() > 0){
			while($data = $get->fetch()){
				$pengaduan = array();
				$pengaduan['id_pengaduan'] = $data['id_pengaduan'];
				$pengaduan['topik'] = $data['topik'];
				$pengaduan['isi'] = $data['isi'];
				$pengaduan['tanggal'] = $data['tanggal'];
				$pengaduan['file'] = $data['file'];
				$pengaduan['status_baca'] = $data['status_baca'];
				$pengaduan['status_solusi'] = $data['status_solusi'];	

				array_push($resp['pengaduan'], $pengaduan);
			}
			$resp['success'] = 1;

			echo json_encode($resp);	
		}else{
			$resp['success'] = 0;
			$resp['message'] = "Tidak ada Berita";

			echo json_encode($resp);
		}
	}
?>