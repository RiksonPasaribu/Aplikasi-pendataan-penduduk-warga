<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
               <b>     Data Pendidikan Kelurahan </b>
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
                                    <th>Pendidikan</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pendidikan = dataPendidikan();
                                foreach ($pendidikan as $pen) {
                                    if (isset($_POST['id_lingkungan'])) {
                                        $id_lingkungan  = $_POST['id_lingkungan'];
                                        $dataPendidikan = hitungJumlahPendidikanPerlingkungan($pen, $id_lingkungan) . "/Jiwa";
                                    } else {
                                        $dataPendidikan = hitungJumlahPendidikan($pen) . "/Jiwa";
                                    }
                                    echo "<tr>
                                        <td>$pen</td>
                                        <td>$dataPendidikan</td> 
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