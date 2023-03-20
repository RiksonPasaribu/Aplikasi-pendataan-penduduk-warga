<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Agama Kelurahan / Desa
                </h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">List Data Lingkungan</label>
                        <select name="id_lingkungan" id="id_lingkungan" class="form-control show-tick" onchange="this.form.submit();">
                            <?php dataLingkunganSelect(); ?>
                        </select>
                    </div>
                </form>
                <?php
                if (!empty($pesan)) {
                    echo $pesan;
                }
                ?>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Agama</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $agama = dataAgama();
                                foreach ($agama as $ag) {
                                    if (isset($_POST['id_lingkungan'])) {
                                        $id_lingkungan  = $_POST['id_lingkungan'];
                                        $jumlahAgama = cekJumlahAgamaPerlingkungan($ag, $id_lingkungan);
                                    } else {
                                        $jumlahAgama = cekJumlahAgama($ag);
                                    }
                                    // jumlah agama
                                    echo "<tr>
                                        <td>$ag</td>
                                        <td>$jumlahAgama</td>
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
</div>