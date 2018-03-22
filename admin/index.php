<?php
    require "../include/koneksi.php";
    session_start();

    if (!isset($_SESSION['admin'])){    
        echo "<script language='javascript'> window.location.href='login.php'</script>";
    }else{
        $lowongan = new Lowongan();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SPK Penerimaan Pegawai</title>

        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">Penerimaan Pegawai (<?php echo $_SESSION['admin']; ?>) </a>
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="index.php"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                                <?php
                                ?>
                                <li><a href="?menu=pelamar"><i class="menu-icon icon-envelope"></i>Data Pelamar </a>
                                </li>
                                <li><a href="?menu=penerimaan"><i class="menu-icon icon-inbox"></i>Penerimaan </a></li>
                                <li><a href="?menu=users"><i class="menu-icon icon-key"></i>Users </a></li>
                                <li><a href="?menu=file"><i class="menu-icon icon-key"></i>File </a></li>
                                <li><a href="?menu=perhitungan"><i class="menu-icon icon-group"></i>Perhitungan </a></li>
                                <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                            <!--/.widget-nav-->
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <?php
                        include "menu.php";
                    ?>
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2017 </b>All rights reserved.
            </div>
        </div>
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>
      </div>
      </div>
    </body>
</html>
<?php 
}
?>