<?php

	if(isset($_GET['page'])){

		$page = $_GET['page'];

		if($page=="download"){
			include "download.php";
		}

		if($page=="penerimaan"){
			include "penerimaan.php";
		}

		if($page=="pengumuman"){
			include "pengumuman.php";
		}

	}else{
		include "profil.php";
	}

?>