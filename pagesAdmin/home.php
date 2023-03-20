<div class="block-header">
    <h2>DASHBOARD <?php echo $_SESSION['level']; ?> </h2>
</div>

<div class="btn-group" role="group" aria-label="Basic example">
    <a href="index.php?status=tetap" class="btn btn-secondary">Penduduk Tetap</a>
    <a href="index.php?status=pindah" class="btn btn-secondary">Penduduk Pindah</a>
    <a href="index.php?status=meninggal" class="btn btn-secondary">Penduduk Meninggal</a>
    <a href="index.php?status=pendatang" class="btn btn-secondary">Penduduk Pendatang</a>
    <a href="index.php?status=lahiran" class="btn btn-secondary">Penduduk Lahir</a>
    <a onClick="window.open('http://localhost/penduduk/grafik/grafikKeadaan.php', 'Penduduk', 'width=900,height=800,status=1,scrollbars=yes'); return false;" href="#" class="btn btn-secondary">Grafik Keadaan Penduduk</a>
</div>
<br><br>
<div class="row clearfix">
    <!-- Task Info -->
    <div class="card">
        <div class="header">
            <?php
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
            } else {
                $status = "";
            }
            ?>
            Grafik Penduduk Berdasarkan Kecamatan <b><?php echo $status; ?></b>
        </div>
        <div class="body">
            <canvas id="myChartKec" width="300" height="150"></canvas>
        </div>
    </div>
</div>

<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a onClick="window.open('http://localhost/penduduk/data/pendudukPindah.php', 'Penduduk', 'width=900,height=800,status=1,scrollbars=yes'); return false;">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">Penduduk Pindah</div>
                    <div class="number count-to" data-from="0" data-to="<?php pendudukPindahKeseluruhan(); ?>" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a onClick="window.open('http://localhost/penduduk/data/meninggalPenduduk.php', 'Penduduk', 'width=900,height=800,status=1,scrollbars=yes'); return false;">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">Penduduk Meninggal</div>
                    <div class="number count-to" data-from="0" data-to="<?php pendudukMeninggal(); ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a onClick="window.open('http://localhost/penduduk/data/pendatangPenduduk.php', 'Penduduk', 'width=900,height=800,status=1,scrollbars=yes'); return false;">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">Penduduk Pendatang</div>
                    <div class="number count-to" data-from="0" data-to="<?php echo pendudukPendatang(); ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a onClick="window.open('http://localhost/penduduk/data/lahirPenduduk.php', 'Penduduk', 'width=900,height=800,status=1,scrollbars=yes'); return false;">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">Penduduk Lahir</div>
                    <div class="number count-to" data-from="0" data-to="<?php pendudukLahir(); ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="index.php?pendudukAdmin">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">Penduduk Tetap</div>
                    <div class="number count-to" data-from="0" data-to="<?php pendudukTetap(); ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="index.php?pendudukAdmin">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">Total Penduduk</div>
                    <div class="number count-to" data-from="0" data-to="<?php totalPenduduk(); ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="index.php?users">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">Total Users</div>
                    <div class="number count-to" data-from="0" data-to="<?php totalUser(); ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="index.php?kelurahan">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">Total Lurah / Desa</div>
                    <div class="number count-to" data-from="0" data-to="<?php totalLurah(); ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </a>
    </div>
</div>
<!-- #END# Widgets -->


<div class="row clearfix">
    <!-- Task Info -->
    <div class="card">
        <div class="header">
            <h2>Data Berdasarkan Umur</h2>
            <a href="#" onClick="window.open('http://localhost/penduduk/grafik/pekerjaan.php', 'Penduduk', 'width=900,height=800,status=1,scrollbars=yes'); return false;" class="btn btn-warning">
                Grafik Pekerjaan
            </a>
            <a href="#" onClick="window.open('http://localhost/penduduk/grafik/agama.php', 'Penduduk', 'width=900,height=800,status=1,scrollbars=yes'); return false;" class="btn btn-warning">
                Grafik Agama
            </a>
            <a href="#" onClick="window.open('http://localhost/penduduk/grafik/pendidikan.php', 'Penduduk', 'width=900,height=800,status=1,scrollbars=yes'); return false;" class="btn btn-warning">
                Grafik Pendidikan
            </a>
        </div>
        <div class="body">
            <?php
            if (isset($_GET['grafik'])) {
                $grafik     = $_GET['grafik'];
                include_once "grafik/" . $grafik . ".php";
            } else {
                include_once "grafik/umur.php";
            }
            ?>
        </div>
    </div>
</div>
</div>
</div>
</section>