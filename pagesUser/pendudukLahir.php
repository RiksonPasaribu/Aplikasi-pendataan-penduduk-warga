<!-- #END# Basic Examples -->
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Penduduk Lahiran
                </h2>
                <?php echo menuHeaderPenduduk(); ?>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Nik</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Usia</th>
                                <th>Ayah</th>
                                <th>Ibu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dataLahiran = pendudukLahirPerlingkungan($id_lingkungan);
                            // dataLahiranTableLingkungan($id_lingkungan);
                            while ($rowLahiran = mysqli_fetch_array($dataLahiran)) {
                                $noKK = $rowLahiran['noKK'];
                                echo "<tr>
                                    <td>$rowLahiran[nik]</td>
                                    <td>$rowLahiran[nama]</td>
                                    <td>$rowLahiran[tanggalLahir]</td>" .
                                    "<td>" . cekUsia($rowLahiran['tanggalLahir']) . "</td>" .
                                    "<td>" . cekOrtu($noKK, "Kepala Keluarga") . "</td>" .
                                    "<td>" . cekOrtu($noKK, "Istri") . "</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>