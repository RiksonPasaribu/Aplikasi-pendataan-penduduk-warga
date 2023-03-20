<div class="block-header">
    <h2 class="animate__animated animate__rubberBand">DASHBOARD Kepala Lingkungan : <?php echo $_SESSION['level']; ?> /
        <?php
        if ($_SESSION['level'] == "kecamatan") {
            echo kecamatan($_SESSION['id_kec']);
        } else 
        if ($_SESSION['level'] == "kelurahan") {
            echo kelurahanId($_SESSION['id_kel']);
        } else {
            echo lingkungan($_SESSION['id_lingkungan']);
        }
        ?>
    </h2>
</div>

<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Penduduk Pindah</div>
                <div class="number count-to" data-from="0" data-to="<?php pendudukPindahPerlingkungan($id_lingkungan); ?>" data-speed="15" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">help</i>
            </div>
            <div class="content">
                <div class="text">Penduduk Meninggal</div>
                <div class="number count-to" data-from="0" data-to="<?php pendudukMeninggalPerlingkungan($id_lingkungan); ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">forum</i>
            </div>
            <div class="content">
                <div class="text">Penduduk Pendatang</div>
                <div class="number count-to" data-from="0" data-to="<?php echo pendudukPendatangPerlingkungan($id_lingkungan); ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person_add</i>
            </div>
            <div class="content">
                <div class="text">Penduduk Lahir</div>
                <div class="number count-to" data-from="0" data-to="<?php pendudukLahirPerlingkungan($id_lingkungan); ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person_add</i>
            </div>
            <div class="content">
                <div class="text">Penduduk Tetap</div>
                <div class="number count-to" data-from="0" data-to="<?php pendudukTetapPerlingkungan($id_lingkungan); ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person_add</i>
            </div>
            <div class="content">
                <div class="text">Total Penduduk</div>
                <div class="number count-to" data-from="0" data-to="<?php totalPendudukPerlingkungan($id_lingkungan); ?>" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->