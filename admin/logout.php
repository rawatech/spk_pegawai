<?php
	session_start();
	unset($_SESSION['admin']);	
	echo "<script>alert('Logout Success ');document.location='index.php' </script> ";	
?>