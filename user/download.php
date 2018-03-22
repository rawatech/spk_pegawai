<!-- intro area -->	  
	  <!-- About -->
	  <section id="about" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Download</h2>
					</div>
				  </div>
			  </div>
			  <div class="row">

                	<div class="col-md-offset-2 col-md-8">
                		<input type="search" name="search" class="form-control" data-table="order-table" placeholder="Pencarian">
                	</div>
                <?php
                	$file = new File();
                	$get = $file->GetData("");
                ?>
                </div>
				<div class="row">                
                <div class="col-md-offset-2 col-md-8">
                <table class="datatable-1 table table-bordered table-striped display order-table">
                	<tbody>
                <?php
                	$no = 1;
                	while($row = $get->fetch()){
                		echo "<tr>
                				<td width=10%>$no</td>
                				<td width=60%>$row[nama_file]</td>
                				<td width=30%><a href='../file/$row[file]'>$row[file]</a>
                				</tr>";
                		$no++;
                	}
                ?>
                	</tbody>
                </table>

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