<?php
	$lowongan = new lowongan();
	$hitung = new HitungSPK();
?>
<!-- intro area -->	  
	  <!-- About -->
	  <section id="about" class="home-section bg-white">

	  <?php
	  	if(isset($_GET['penerimaan'])){
	  		$id_lowongan = $_GET['penerimaan'];

	  		$qr_k = $lowongan->GetData("where id_lowongan='$id_lowongan'");
	  		$ft_k = $qr_k->fetch();
	  		$kuota = $ft_k['kuota'];
	  		?>
	  		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Pengumuman Lulus <?php echo $ft_k['lowongan']; ?></h2>
					</div>
				  </div>
			  </div>
			  <div class="row">

                	<div class="col-md-offset-2 col-md-8">
                		<input type="search" name="search" class="form-control" data-table="order-table" placeholder="Pencarian">
                	</div>
                <?php
                	$get = $hitung->GetData("where id_lowongan='$id_lowongan' order by vektor_v desc limit $kuota");
                ?>
                </div>
				<div class="row">                
                <div class="col-md-offset-2 col-md-8">
                <table class="datatable-1 table table-bordered table-striped display order-table">
                	<tbody>
                <?php
                	$no = 1;
                	while($row = $get->fetch()){
                		$user = new User();
                		$n = $user->GetData("where id_user='$row[id_user]'");
                		$us = $n->fetch();
                		echo "<tr>
                				<td width=60%>$us[nama_lengkap]</td>
                				</tr>";
                		$no++;
                	}
                ?>
                	</tbody>
                </table>
                <h6>Hubungi pihak SDM untuk info lebih lanjut</h6>
                </div>
			  </div>			  
		  </div>
	<?php
	  	}else{
	  ?>

		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Pengumuman</h2>
					</div>
				  </div>
			  </div>
			  <div class="row">
                <div class="col-md-offset-2 col-md-8">
					<?php
						$qrL = $lowongan->GetData("where status='1' and pengumuman='1'");
					?>
		<div class="module-body">
			<form class="form-horizontal row-fluid" action="index.php?menu=pelamar" method="get">
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8">
						<input type="hidden" name="page" value="pengumuman">
						<label>Penerimaan</label>
						<select name="penerimaan" class="form-control">
						<?php
						while ($row = $qrL->fetch()){
							echo "<option value='$row[id_lowongan]'>$row[lowongan]</option>";	
						}
						?>
						</select>
					</div>
				  </div>
				<input class="btn btn-primary" type="submit" value="Pilih">
			</form>
                </div>
			  </div>			  
		  </div>	  
	  </section>
	  <?php
	  }
	  ?>

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