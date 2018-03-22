<?php
    error_reporting(0);
    $lowongan = new lowongan();
    $user= new User();
    $pelamar = new HitungSPK();

    $qr_p = $lowongan->GetData("");
    $qr_u = $user->GetData("");
    $qr_pl = $pelamar->GetData("");
?>
<div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="#" class="btn-box big span4"><i class="icon-envelope"></i><b><?php echo $qr_p->rowCount(); ?></b>
                                        <p class="text-muted">
                                            Penerimaan</p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-key"></i><b><?php echo $qr_pl->rowCount(); ?></b>
                                        <p class="text-muted">
                                            Pelamar</p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-inbox"></i><b><?php echo $qr_u->rowCount(); ?></b>
                                        <p class="text-muted">
                                            User</p>
                                    </a>
                                </div>
                                <?php
                                    //menghitung persentase lowongan yang telah diberi solusi
                                    $qr_persen = $lowongan->GetData("where status_solusi = '1'");
                                    $jml = $qr_persen->rowCount();
                                    $total = $qr_p->rowCount();
                                    $persen = round(($jml/$total) * 100,2);
                                ?>
                            </div>
                            <!--/#btn-controls-->
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->

