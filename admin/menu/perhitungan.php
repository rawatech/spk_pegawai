<div class="span9">
	<div class="content">
<?php
	$pelamar = new Pelamar();
	$lowongan = new Lowongan();
	$lowongan_rinci = new LowonganRinci();
	$user = new User();
	$hitung = new HitungSPK();
	include "../include/fungsi_tanggal.php";

	/*----------------------------------
	------------------------------------
	------------------------------------
	------------------------------------
	Ketika pelamar melakuakn input data
	------------------------------------
	------------------------------------
	------------------------------------
	----------------------------------*/

if(!isset($_GET['penerimaan'])){
?>
	<div class="module">
		<div class="module-head">
			<h3>Pilih Penerimaan</h3> 
		</div>
		<?php
			$qrL = $lowongan->GetData("where status = '1'");
		?>
		<div class="module-body">
			<form class="form-horizontal row-fluid" action="index.php?menu=pelamar" method="get">
				<input type="hidden" name="menu" value="perhitungan">
				<div class="control-group">
					<label class="control-label" for="basicinput">Penerimaan</label>
						<div class="controls">
							<select name="penerimaan">
								<?php
								while ($row = $qrL->fetch()){
									echo "<option value='$row[id_lowongan]'>$row[lowongan]</option>";	
								}
								?>
							</select>
							<input class="btn btn-primary" type="submit" value="Pilih">
						</div>
				</div>
				
			</form>
			
		</div>
	</div>

<?php
}else{
	$id_lowongan = $_GET['penerimaan'];
	$qrLw = $lowongan->GetData("where id_lowongan='$id_lowongan'");
	$nama_lw = $qrLw->fetch();

	if(isset($_GET['nilai_user'])){

			$id_user = $_GET['nilai_user'];
			$qrN = $user->GetData("where id_user='$id_user'");
			$rowN = $qrN->fetch();
			?>
			<div class="module">
		<div class="module-head">
			<h3>Rincian Nilai -- <?php echo $rowN['nama_lengkap'] . " -- " . $nama_lw['lowongan']; ?></h3> 
		</div>
		<div class="module-body table">
		<?php
			if(isset($_POST['submit'])){
				$ar=1;
				$qryRincian = $lowongan_rinci->GetData("where id_lowongan='$id_lowongan' and status_nilai='1' order by kriteria asc");

				while($exec = $qryRincian->fetch()){
					$nilai = $_POST['input_' . $ar];
					$qry = $pelamar->SetNilai($nilai, $id_user, $id_lowongan, $exec['kriteria']);

	  				if($qry){
	  					echo "<script language='javascript'>alert('Nilai berhasil diberikan'); document.location='?menu=pelamar&penerimaan=$id_lowongan&nilai_user=$id_user'</script>";
	  				}else{
	  					echo "<script language='javascript'>alert('Gagal');document.location='menu=pelamar&penerimaan=$id_lowongan'</script>";
	  				}
					$ar++;
				}
			}

			$qryRincian = $pelamar->GetData("where id_user='$id_user' and id_lowongan='$id_lowongan' order by kriteria asc");
		?>
			<form class="form-horizontal row-fluid" action="" method="post">
				<?php
				$ar=1;
				while($krit = $qryRincian->fetch()){
					$nu = $lowongan_rinci->GetData("where id_lowongan = '$id_lowongan' and kriteria = '$krit[kriteria]'");
					$cekKrit = $nu->fetch();
					echo "<div class='control-group'>
						<label class='control-label' for='basicinput'>$krit[kriteria]</label>
						<div class='controls'>";
					if($cekKrit['status_nilai'] == "1"){
						echo "<input type='text' id='basicinput' name='input_$ar' placeholder='Input Nilai $krit[kriteria]' class='span8' value='$krit[nilai]'>";
						if($cekKrit['status_upload'] == "1")
							echo "<div class='control'><a target='blank' href='../upload/$krit[file]' class='span8'>Berkas Pelamar</a></div>";
						$ar++;
					}else if($cekKrit['status_upload'] == "1"){
						echo "<a target='blank' href='../upload/$krit[file]' class='span8'>Berkas Pelamar</a>";
					}
					
					echo "</div>
						</div>";
				}
				?>
				<div class='control-group'>
					<div class="controls">
						<input type="submit" name="submit" value="Simpan" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
		</div>
		<?php

	}else{

		/*----------------------------------
		------------------------------------
		------------------------------------
		------------------------------------
		Ketika pelamar hanya menampilkan data
		------------------------------------
		------------------------------------
		------------------------------------
		----------------------------------*/
		
		?>
		<div class="module">
		<div class="module-head">
			<h3>Data Pelamar -- <?php echo $nama_lw['lowongan']; ?></h3>
		</div>
		<div class="module-body table">
			<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" 
			width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Lengkap</th>
						<!-- <th>Pendidikan</th>
						<th>No HP</th>
						<th>Email</th> -->
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					$getData = $pelamar->GetData("where id_lowongan='$id_lowongan'");
					$cek_user = "";
					while($data = $getData->fetch()){
						$qrU = $user->GetData("where id_user='$data[id_user]'");
						$rowU = $qrU->fetch();
						if ($data['id_user']==$cek_user)
							continue;
						echo "<tr>
							<td width = 10%>$no</td>
							<td width = 75%><a target='blank' href='index.php?menu=users&detail=$data[id_user]'>$rowU[nama_lengkap]</a></td>";
						echo "<td width = 15%> <a class='btn btn-small btn-success' href='?menu=pelamar&penerimaan=$id_lowongan&nilai_user=$data[id_user]'>Rincian Nilai</a></td>";
							// echo "<td width = 22%> <a class='btn btn-small btn-success' href='?ap=peserta&aksi=detail&id_peserta=$data[id_peserta]'>Detail</a> <a class='btn btn-small btn-danger' href='application/peserta/peserta_hapus.php?id_peserta=$data[id_peserta]&nama_peserta=$data[nama_lengkap]&lomba=$data[nama_lomba]'>Hapus</a> 
							// <a class='btn btn-small btn-info' href='?ap=peserta&aksi=edit&id_peserta=$data[id_peserta]'>Edit</a>
						echo "</tr>";
						$cek_user = $data['id_user'];

						$no++;
					}
					//$up = mysql_query("update gtp_peserta set approve = '1' where approve = '0'");
				?>
				</tbody>
			</table>
		</div>
		<div class="module-footer"><center><?php echo "<a href='?menu=perhitungan&penerimaan=$id_lowongan&hitung=1' class= 'btn btn-primary'>Hitung</a>"; ?> </center></div>
		<br>
		</div>

		<?php

		if(isset($_GET['umumkan'])){
				$umumkan = $_GET['umumkan'];

				$setUmum = $lowongan->SetPengumuman($umumkan, $id_lowongan);
				if($setUmum){
					echo "<script language='javascript'>alert('Berhasil');document.location='?menu=perhitungan&penerimaan=$id_lowongan&hitung=1'</script>";
	  			}else{
	  				echo "<script language='javascript'>alert('Gagal');document.location='?menu=perhitungan&penerimaan=$id_lowongan&hitung=1'</script>";
	  			}
		}

		if(isset($_GET['hitung'])){

		?>

		<!-- Data perhitungan bobot dan normalisasi bobot -->


		<div class="module">
		<div class="module-head">
			<h3>Normalisasi Bobot -- <?php echo $nama_lw['lowongan']; ?></h3>
		</div>
		<div class="module-body table">
			<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" 
			width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kriteria</th>
						<th>Bobot Awal</th>
						<th>Bobot Baru</th>
						<!-- <th></th> -->
					</tr>
				</thead>
				<tbody>
				<?php
					$jmlBobot = $hitung->NormalisasiBobot($id_lowongan);

					$no = 1;
					$getData = $lowongan_rinci->GetData("where id_lowongan='$id_lowongan' and bobot > 0 order by kriteria asc");
					$cek_user = "";
					$arBB = array();
					$i=0;
					while($data = $getData->fetch()){
						$bobotBaru = round($data['bobot']/$jmlBobot, 4);
						$arBB[$i] = $bobotBaru;
						echo "<tr>
							<td width = 10%>$no</td>
							<td width = 66%>$data[kriteria]</td>
							<td width = 12%><center>$data[bobot]</center></td>
							<td width = 12%><center>$bobotBaru</center></td>";
							// echo "<td width = 22%> <a class='btn btn-small btn-success' href='?ap=peserta&aksi=detail&id_peserta=$data[id_peserta]'>Detail</a> <a class='btn btn-small btn-danger' href='application/peserta/peserta_hapus.php?id_peserta=$data[id_peserta]&nama_peserta=$data[nama_lengkap]&lomba=$data[nama_lomba]'>Hapus</a> 
							// <a class='btn btn-small btn-info' href='?ap=peserta&aksi=edit&id_peserta=$data[id_peserta]'>Edit</a>
						echo "</tr>";
						$i++;
						$no++;
					}
					//$up = mysql_query("update gtp_peserta set approve = '1' where approve = '0'");
				?>
				</tbody>
			</table>
		</div>
		</div>

		<?php

			$loopP = $pelamar->GetData("where id_lowongan='$id_lowongan' and nilai > 0");
			$ar_pelamar = array();
			
			$in = -1;
			$us = "";
			while($data = $loopP->fetch()){
				if($us != $data['id_user'])
					$in++;
				$ar_pelamar[$in] = $data['id_user'];
				
				$us = $data['id_user'];
			}

			$jml_pelamar = count($ar_pelamar);

			$ar_nilai = array();
			for($i=0;$i<$jml_pelamar;$i++){
				$loop2 = $pelamar->GetData("where id_lowongan='$id_lowongan' and id_user='$ar_pelamar[$i]' and nilai > 0 order by kriteria asc");
				echo "Pelamar dengan id " . $ar_pelamar[$i] . "<br>";
				$ib=0;
				$vkt_s = 1;
				while($k = $loop2->fetch()){
					$pgkt = pow($k['nilai'], $arBB[$ib]);
					echo $k['kriteria'] . " dengan nilai " . $k['nilai'] . " dipangkat dengan bobot " . $arBB[$ib] . "<br>";
					$vkt_s = $vkt_s * $pgkt;
					$ib++;
				}
				echo "Vektor s pelamar " . $ar_pelamar[$i] . " = " . $vkt_s . "<br>";
				$qryVS = $hitung->SetVektor_S($vkt_s, $ar_pelamar[$i], $id_lowongan);
				$qryVV = $hitung->SetVektor_V($ar_pelamar[$i], $id_lowongan);
			}

		?>


		<div class="module">
		<div class="module-head">
			<h3>Hasil Seleksi -- <?php echo $nama_lw['lowongan']; ?></h3>
		</div>
		<div class="module-body table">
			<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" 
			width="100%">
				<thead>
					<tr>
						<th>Ranking</th>
						<th>Pelamar</th>
						<th>Vektor S</th>
						<th>Vektor V</th>
						<!-- <th></th> -->
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					$getData = $hitung->GetData("where id_lowongan='$id_lowongan' order by vektor_v desc");

					while($data = $getData->fetch()){
						$qr_Plm = $user->GetData("where id_user = '$data[id_user]'");
						$plm = $qr_Plm->fetch();
						echo "<tr>
							<td width = 10%>$no</td>
							<td width = 66%>$plm[nama_lengkap]</td>
							<td width = 12%>$data[vektor_s]</td>
							<td width = 12%><center>$data[vektor_v]</center></td>";
							// echo "<td width = 22%> <a class='btn btn-small btn-success' href='?ap=peserta&aksi=detail&id_peserta=$data[id_peserta]'>Detail</a> <a class='btn btn-small btn-danger' href='application/peserta/peserta_hapus.php?id_peserta=$data[id_peserta]&nama_peserta=$data[nama_lengkap]&lomba=$data[nama_lomba]'>Hapus</a> 
							// <a class='btn btn-small btn-info' href='?ap=peserta&aksi=edit&id_peserta=$data[id_peserta]'>Edit</a>
						echo "</tr>";

						$no++;
					}
					//$up = mysql_query("update gtp_peserta set approve = '1' where approve = '0'");
				?>
				</tbody>
			</table>
			<div class="module-footer">
				<center>
				<?php
					$qrUm = $lowongan->GetData("where id_lowongan='$id_lowongan'");
					$cekUmum = $qrUm->fetch();
					if($cekUmum['pengumuman']=="1"){
						echo "<a href='?menu=perhitungan&penerimaan=$id_lowongan&umumkan=0' class= 'btn btn-danger'>Batalkan Pengumuman</a>";
					}else{
						echo "<a href='?menu=perhitungan&penerimaan=$id_lowongan&umumkan=1' class= 'btn btn-success'>Umumkan</a>";
					}
				?> 
				</center>
			</div>
		<br>
		</div>
		</div>


	<?php
	}
}
}
?>
	</div>
</div>
