<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Agama Per Lingkungan
                </h2>
                <a href="#" onClick="window.open('http://localhost/penduduk/grafik/agama.php', 'Penduduk', 'width=900,height=800,status=1,scrollbars=yes'); return false;" class="btn btn-warning">
                    Grafik
                </a>

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
                                    <th>Lingkungan</th>
                                    <?php
                                    $agama = dataAgama();
                                    foreach ($agama as $ag) {
                                        echo "<th>" . $ag . "</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataLingkungan = dataLingkunganTable();
                                while ($rowLingkungan = mysqli_fetch_array($dataLingkungan)) {
                                    echo "<tr>
                                        <td>$rowLingkungan[lingkungan]</td>";
                                    foreach ($agama as $ag) {
                                        echo "<td>" . hitungJumlahAgama($rowLingkungan['id_lingkungan'], $ag) . "</td>";
                                    }
                                    echo "</tr>";
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