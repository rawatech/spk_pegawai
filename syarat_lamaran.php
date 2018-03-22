<?php
	include "include/koneksi.php";
	$lowongan_rinci = new LowonganRinci();
	$id_lowongan = $_POST['id'];
	$qry = $lowongan_rinci->GetData("where id_lowongan = '$id_lowongan'");
	
	while ($row = $qry->fetch()){
		echo $row['kriteria'] . "<br>";	
	}
	
?>