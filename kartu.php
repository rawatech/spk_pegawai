<html>
 <!-- M.OCTAVIANO PRATAMA -->
 <head>
 <style type="text/css">
 .head
 {
 margin-left:30em;
 margin-top:4em;
 margin-right:30em;
 padding-left:10pt;
 padding-top:10pt;
 background:#529abb;
 height:4em;
 border-radius:10px 10px 0px 0px;
 }
 #body
 {
 padding-left:18pt;
 padding-top:18pt;
 margin-left:30em;
 margin-right:30em;
 padding-left:18pt;
 background:#D3E9F0;
 height:12em;
 border: 1px;
 border-radius:0px 0px 10px 10px;
 }

 .print{
 	align-self: center;
 	padding-top: 30pt;
 }
 </style>
 </head>
 <body>
 
 
 <div class="head">
 <?php
 include "include/koneksi.php";
 $user = new User();
 $id_user = $_GET['id_user'];
 $qry = $user->GetData("where id_user = '$id_user'");
 $row = $qry->fetch();
 echo "
 <table border='0'align='center'>
 <tr><td><h3>KARTU PESERTA</h3></td><td><img style='padding-left:8em'src='img/uui.png'width='70'height='70'/></td></tr>
 </table>"
 ?>
 </div>
 <div id="body">
 <?php
 echo "<form name='octav'>
 <table border='0' align='center'>
 <tr><td rowspan='10'><img src='upload/$row[foto]' width='125'height='150'></td></tr>
 <tr><td><b>Nama</td><td><b>:</td><td><b>$row[nama_lengkap]</td></tr>
 <tr><td><b>Alamat</td><td><b>:</td><td><b>$row[alamat]</td></tr>
 <tr><td>Tempat Lahir</td><td>:</td><td>$row[tempat_lahir]</td></tr>
 <tr><td>Tanggal Lahir</td><td>:</td><td>$row[tanggal_lahir]</td></tr>
 <tr><td>Pendidikan</td><td>:</td><td>$row[pendidikan]</td></tr>
 </form>
 "
 ?>

 </div>


 </body>



 <script>
window.load = print_d();
  function print_d(){  
   window.print();  
  }  
</script>
</html>