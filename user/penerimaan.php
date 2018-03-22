<?php
	$lowongan = new Lowongan();
	$lowongan_rinci = new LowonganRinci();

	$pelamar = new Pelamar();
?>
<!-- intro area -->	  
	  <!-- About -->
	  <section id="about" class="home-section bg-white">
		<div class="container">
				<?php
				if(isset($_GET['lamar'])){
				  		$id_lowongan = $_GET['lamar'];
				  		$id_user = $_SESSION['user'];

				  		$qry_cek = $pelamar->CekLamaran($id_user, $id_lowongan);
				  		$cek = $qry_cek->rowCount();

				  		$qRin = $lowongan_rinci->GetDataLowongan($id_lowongan);
				  		$jml_rinci = $qRin->rowCount();

				  		if($cek > 0){
				  			if($cek != $jml_rinci){
				  				while($rinci = $qRin->fetch()){
				  					$missing_krit = "0";
				  					while($lamaran = $qry_cek->fetch()){
				  						if($lamaran['kriteria'] == $rinci['kriteria']){
				  							$missing_krit="1";
				  							break;
				  						}
				  					}
				  					if($missing_krit=="0") 
				  						$qry = $pelamar->InsertAwal($id_user, $id_lowongan, $rinci['kriteria']);
				  				}
				  			}
				  		}else{
				  			while($rinci = $qRin->fetch()){
				  				$qry = $pelamar->InsertAwal($id_user, $id_lowongan, $rinci['kriteria']);
				  			}
				  			$qrHitung = $pelamar->InsertAwalHitung($id_user, $id_lowongan);
				  		}

				  		$getP = $lowongan->GetData("where id_lowongan='$id_lowongan'");
				  		$pen = $getP->fetch();
				  	?>
				  	<div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Lamar <?php echo $pen['lowongan']; ?> </h2> 
					</div>
					<h4>Upload Berkas</h4>
					<table class="table" border="0">
                	<tbody>
                	<?php

                		if(isset($_POST['submit'])){
                			$ar_kr = 1;
                			$rin = $lowongan_rinci->GetData("where id_lowongan = '$id_lowongan' and status_upload = '1' order by kriteria asc");
                			while($berkas = $rin->fetch()){
                				if(!empty($_FILES['fileberkas_' . $ar_kr]['tmp_name'])){
									$explode = explode(".", $_FILES['fileberkas_' . $ar_kr]['name']);
									$file = $id_user . "_" . $id_lowongan . "_" . $berkas['kriteria'] . "." . end($explode);
									move_uploaded_file($_FILES['fileberkas_' . $ar_kr]['tmp_name'], "../upload/" . $file);
								}else{
									$get = $pelamar->GetData("where id_user='$id_user' and id_lowongan='$id_lowongan' and kriteria='$berkas[kriteria]'");
									$data = $get->fetch();

									$file = $data['file'];
								}

								$qry = $pelamar->UploadBerkas($file, $id_user, $id_lowongan, $berkas['kriteria']);

	  							if($qry){
	  								echo "<script language='javascript'>alert('Berkas berhasil diupload'); document.location='?page=penerimaan&lamar=$id_lowongan'</script>";
	  							}else{
	  								echo "<script language='javascript'>alert('Gagal');document.location='?page=penerimaan&lamar=$id_lowongan'</script>";
	  							}
								$ar_kr++;
                			}
                		}

                	?>
                	<form action="" method="post" enctype="multipart/form-data">
                	<div class="form-group">
                <?php
                	$rin = $lowongan_rinci->GetData("where id_lowongan = '$id_lowongan' and status_upload = '1' order by kriteria asc");
                	$ar=1;
                	while($row = $rin->fetch()){
                		$qryBerkas = $pelamar->GetData("where id_user='$id_user' and id_lowongan='$id_lowongan' and kriteria='$row[kriteria]'");
                		$cekBerkas = $qryBerkas->fetch();
                		echo "<tr>
                				<td width=60%>$row[kriteria]</td>";
                		if($cekBerkas['file']==""){
                			echo "<td></td><td width=40%><input type='file' name='fileberkas_$ar'></td>";
                		}else{
                			echo "<td><a href='../upload/$cekBerkas[file]'>$cekBerkas[file]</a></td><td width=40%><input type='file' name='fileberkas_$ar'></td>";
                		}

                		echo "</tr>";
                		$ar++;
                	}
                ?>
                </div>
                	</tbody>
                </table>
                	<div class="form-group">
                		<input type='submit' name='submit' value='Simpan' class="btn btn-primary">
                	</div>
                </form>

				  </div>
			  </div>
				  	<?php

				  	}else if(isset($_GET['detail'])){
				  		$id_lowongan = $_GET['detail'];
				  		$getP = $lowongan->GetData("where id_lowongan='$id_lowongan'");
				  		$pen = $getP->fetch();
				  	?>
				  	<div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Detail <?php echo $pen['lowongan']; ?> </h2> 
					</div>

					<?php
					echo "<a href='?page=penerimaan&lamar=$id_lowongan' class='btn btn-primary'>Lamar</a>";
					?>

					<hr>
					<p>
						<h4>Syarat</h4>
						<?php
							$lowongan_rinci = new LowonganRinci();
							$rin = $lowongan_rinci->GetDataLowongan($id_lowongan);

							while($data = $rin->fetch()){
								echo "$data[kriteria]<br>";
							}
						?>
					</p>

				  </div>
			  </div>
				  	<?php
				  	}else{

				  ?>
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Daftar Penerimaan</h2>
					</div>
				  </div>
			  </div>
			  <div class="row">

                	<div class="col-md-offset-2 col-md-8">
                		<input type="search" name="search" class="form-control" data-table="order-table" placeholder="Pencarian">
                	</div>
                </div>
				<div class="row">                
                <div class="col-md-offset-2 col-md-8">
                <table class="datatable-1 table table-bordered table-striped display order-table">
                	<thead>
                		<tr>
                		<th>No.</th>
                		<th>Penerimaan</th>
                		<th>Kuota</th>
                		<th></th>
                		</tr>
                	</thead>
                	<tbody>
                <?php
                	$no = 1;
                	$get = $lowongan->GetData("where status='1'");
                	while($row = $get->fetch()){
                		echo "<tr>
                				<td width=10%>$no</td>
                				<td width=60%>$row[lowongan]</td>
                				<td width=30%>$row[kuota]</td>
                				<td width=10%><a href='?page=penerimaan&detail=$row[id_lowongan]'>Detail</a></td>
                				</tr>";
                		$no++;
                	}
                ?>
                	</tbody>
                </table>
                <?php } ?>
                </div>
			  </div>			  
		  </div>	  
	  </section>

	  <script type="text/javascript">
	  	(function(document) {
 'use strict';

 var LightTableFilter = (function(Arr) {

  var _input;

  function _onInputEvent(e) {
   _input = e.target;
   var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
   Arr.forEach.call(tables, function(table) {
    Arr.forEach.call(table.tBodies, function(tbody) {
     Arr.forEach.call(tbody.rows, _filter);
    });
   });
  }

  function _filter(row) {
   var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
   row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
  }

  return {
   init: function() {
    var inputs = document.getElementsByClassName('form-control');
    Arr.forEach.call(inputs, function(input) {
     input.oninput = _onInputEvent;
    });
   }
  };
 })(Array.prototype);

 document.addEventListener('readystatechange', function() {
  if (document.readyState === 'complete') {
   LightTableFilter.init();
  }
 });

})(document);

	  </script>