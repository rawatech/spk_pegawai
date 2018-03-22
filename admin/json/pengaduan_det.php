<?php
	error_reporting(0);
	include "../include/koneksi.php";


	if (isset($_POST['id_pengaduan'])){
		$id_pengaduan = $_POST['id_pengaduan'];

		$cl_solusi = new Solusi();
		$get = $cl_solusi->GetData("where id_pengaduan = '$id_pengaduan'");
		$cl_pengaduan = new pengaduan();
		$getP = $cl_pengaduan->GetData("where id_pengaduan = '$id_pengaduan'");

		$resp = array();
		$resp['solusi'] = array();
		$resp['pengaduan'] = array();

		if($getP->rowCount() > 0){
			while ($dataP = $getP->fetch()){
				$pengaduan['pengaduantopik'] = $dataP['topik'];
				$pengaduan['pengaduanisi'] = $dataP['isi'];
				$pengaduan['file'] = $dataP['file'];
				$pengaduan['pengaduantanggal'] = $dataP['tanggal'];
				array_push($resp['pengaduan'], $pengaduan);
			}
		}

		if($get->rowCount() > 0){
			while ($data = $get->fetch()){
				$solusi['solusi'] = "Ada";
				$solusi['solusitopik'] = $data['topik'];
				$solusi['solusiisi'] = $data['solusi'];
				$solusi['solusitanggal'] = $data['tanggal'];

				array_push($resp['solusi'], $solusi);
			}
			$resp['success'] = 1;
			$resp['message'] = "Success";
		}else{
			$solusi['solusi'] = "Tidak";
			array_push($resp['solusi'], $solusi);

			$resp['success'] = 0;
			$resp['message'] = "Tidak ada data";
			
		}

		echo json_encode($resp);
	}

?>