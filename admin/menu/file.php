<div class="span9">
	<div class="content">
<?php
	$file = new File();
	

	/*----------------------------------
	------------------------------------
	------------------------------------
	------------------------------------
	Ketika user melakuakn input data
	------------------------------------
	------------------------------------
	------------------------------------
	----------------------------------*/

	if(isset($_GET['aksi'])){
		if($_GET['aksi'] == "tambah"){
?>
			<div class="module">
				<div class="module-head">
					<h3>Tambah File</h3>
				</div>
				<?php
					if(isset($_POST['submit'])){
						$nama_file = $_POST['nama_file'];
						$file_u = "";

						require_once "../include/fungsi_seo.php";

						if(!empty($_FILES['file_up']['tmp_name'])){
							$explode = explode(".", $_FILES['file_up']['name']);
							$seo = seo_title($nama_file);
							$file_u = $seo . "." . end($explode);
							move_uploaded_file($_FILES['file_up']['tmp_name'], "../file/" . $file_u);
						}

						$qry = $file->InsertData($nama_file, $file_u);

	  					if($qry){
	  						echo "<script language='javascript'>alert('File berhasil disimpan');document.location='?menu=file&aksi=tambah'</script>";
	  					}else{
	  						echo "<script language='javascript'>alert('Gagal');document.location='?menu=file'</script>";
	  					}
					}
				?>

				<div class="module-body">
					<form class="form-horizontal row-fluid" action="" method="post" enctype="multipart/form-data">

						<div class="control-group">
							<label class="control-label" for="basicinput">Nama File</label>
							<div class="controls">
								<input type="text" id="basicinput" name="nama_file" placeholder="Input nama file" class="span8">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="basicinput">File</label>
							<div class="controls">
								<input type="file" name="file_up">
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button type="submit" name="submit" class="btn">Simpan</button> <a class='btn' href='?menu=file'>Selesai</a> 
							</div>
						</div>
					</form>
				</div>
			</div>

			<?php

		}elseif ($_GET['aksi'] == "edit"){

			/*----------------------------------
			------------------------------------
			------------------------------------
			------------------------------------
			Ketika user melakukan edit data
			------------------------------------
			------------------------------------
			------------------------------------
			----------------------------------*/

			if(isset($_GET['id_file'])){
				$id_file = $_GET['id_file'];
				$get = $file->GetData("where id_file='$id_file'");
				$row = $get->fetch();
				?>
			
			<div class="module">
				<div class="module-head">
					<h3>Edit Data File</h3>
				</div>

				<?php
					if(isset($_POST['submit'])){
						//$id_file = $_POST['id_file'];
						$nama_file = $_POST['nama_file'];
						
						require_once "../include/fungsi_seo.php";

						if(!empty($_FILES['file_up']['tmp_name'])){
							$explode = explode(".", $_FILES['file_up']['name']);
							$seo = seo_title($nama_file);
							$file_u = $seo . "." . end($explode);
							move_uploaded_file($_FILES['file_up']['tmp_name'], "../file/" . $file_u);
						}else{
							$file_u = $row['file'];
						}

						$qry = $file->EditData($nama_file, $file_u, $id_file);

	  					if($qry){
	  						echo "<script language='javascript'>alert('File berhasil diedit');document.location='?menu=file'</script>";
	  					}else{
	  						echo "<script language='javascript'>alert('Gagal');document.location='?menu=file'</script>";
	  					}
					}
				?>

				<div class="module-body">
					<form class="form-horizontal row-fluid" action="" method="post" enctype="multipart/form-data">

						<div class="control-group">
							<label class="control-label" for="basicinput">Nama File</label>
							<div class="controls">
								<input type="hidden" name="id_file" <?php echo $row['id_file']; ?>>
								<input type="text" id="basicinput" name="nama_file" placeholder="Input nama file" class="span8" <?php echo "value='$row[nama_file]'"; ?>>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="basicinput">File</label>
							<div class="controls">
								<?php
									if($row['file']!=""){
										echo "<a href='../file/$row[file]'>$row[file]</a><br>";
									}
								?>
								<input type="file" name="file_up">
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button type="submit" name="submit" class="btn">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
			}

			/*----------------------------------
			------------------------------------
			------------------------------------
			------------------------------------
			Ketika user melakukan hapus data
			------------------------------------
			------------------------------------
			------------------------------------
			----------------------------------*/

		}else if($_GET['aksi']=="hapus"){
					$id_file = $_GET['id_file'];

					$qry = $file->HapusData($id_file);

	  				if($qry){
	  					echo "<script language='javascript'>alert('File berhasil dihapus');document.location='?menu=file'</script>";
	  				}else{
	  						echo "<script language='javascript'>alert('Gagal');document.location='?menu=file'</script>";
	  				}
				}
	}else{

		/*----------------------------------
		------------------------------------
		------------------------------------
		------------------------------------
		Ketika user hanya menampilkan data
		------------------------------------
		------------------------------------
		------------------------------------
		----------------------------------*/

		?>
		<div class="module">
		<div class="module-head">
			<h3>Kelola File <a class="btn btn-primary" href="?menu=file&aksi=tambah">Tambah</a> </h3>
		</div>
		<div class="module-body table">
			<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	display" 
			width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama File</th>
						<th>File</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					$getData = $file->GetData("");

					while($data = $getData->fetch()){
						echo "<tr>
							<td width = 7%>$no</td>
							<td width = 48%>$data[nama_file]</td>
							<td width = 30%><a href='../file/$data[file]'>$data[file]</a></td>";

							echo "<td width = 15%>
								<a class='btn btn-small btn-warning' href='?menu=file&aksi=edit&id_file=$data[id_file]'>Edit</a>
								<a class='btn btn-small btn-danger' href='?menu=file&aksi=hapus&id_file=$data[id_file]'>Hapus</a>
							</tr>";
						$no++;
					}
					//$up = mysql_query("update gtp_file set approve = '1' where approve = '0'");
				?>
				</tbody>
			</table>
		</div>
		</div>
	<?php
	}
?>
	</div>
</div>