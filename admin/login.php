<?php
	session_start();
	require "../include/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Administrator -- SPK Penerimaan Pegawai</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>

</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.html">
			  		Login Administrator -- SPK Penerimaan Pegawai
			  	</a>
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" method="POST" id="login" action="">
						<div class="module-head">
							<h3>Sign In</h3>
						</div>
						<?php
							if(isset($_POST['submit'])){
								$db = new DB();
								$username = $_POST['inputUsername'];
								$password = md5($_POST['inputPassword']);

								$cek = $db->LoginAdmin($username, $password);

								if($cek->rowCount() > 0){
									$row = $cek->fetch();
									$_SESSION['admin'] = $row['nama_admin'];
									echo "<script language='javascript'>alert('Login Success'); document.location='index.php'</script>";
								}else{
									echo "<script language='javascript'>alert('Username or Password Invalid'); document.location='index.php'</script>";
								}
							}
						?>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="inputUsername" placeholder="Username" name="inputUsername">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="password" id="inputPassword" placeholder="Password" name="inputPassword">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" name="submit" class="btn btn-primary pull-right">Login</button>
									<label class="checkbox">
										<input type="checkbox"> Remember me
									</label>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2017 </b>All rights reserved.
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>