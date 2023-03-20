<!-- #END# Basic Examples -->
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <span class="iconify" data-icon="ph:users-four-light" data-inline="false"></span>
                    Olah Data Penduduk
                </h2>
                <?php
                if (!empty($pesan)) {
                    echo $pesan;
                }
                ?>
            </div>
            <div class="body">
                <?php
                $noKK = $_GET['detaiKK'];
                $dataTablePendudukKK = datatablePendudukKK($noKK);
                ?>
            </div>
        </div>
    </div>
</div>