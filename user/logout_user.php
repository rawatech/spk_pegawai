<?php
	session_start();
	unset($_SESSION['user']);	
	echo "<script>alert('Logout Success ');document.location='index.php' </script> ";	
?>