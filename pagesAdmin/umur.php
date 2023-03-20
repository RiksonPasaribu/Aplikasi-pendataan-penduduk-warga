<?php
include_once "modal/inputUmur.php";
include_once "modal/lihatUmur.php";
if (isset($_POST['simpanUmur'])) {
    $dari = $_POST['dari'];
    $sampai = $_POST['sampai'];
    // cek input
    $cekUmur = mysqli_query($conn, "SELECT * FROM tbl_umur WHERE dari='$dari' AND sampai='$sampai' ");
    if (mysqli_num_rows($cekUmur) > 0) {
        $pesan = pesanDuplikat();
    } else {
        $inputUmur = mysqli_query($conn, "INSERT INTO tbl_umur (dari,sampai)
                                VALUES('$dari','$sampai')");
        if ($inputUmur) {
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanGagal();
        }
    }
} else {
    $pesan = "";
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                   <b> Data Umur  </b>
                </h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalUmur">
                    Input Kelompok Umur
                </button>
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
                                    <th>Usia</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $kelompokUmur = kelompokUmur();
                                while ($rowKelUmur = mysqli_fetch_array($kelompokUmur)) {
                                    $id_umur = $rowKelUmur['id_umur'];
                                    $dari = $rowKelUmur['dari'];
                                    $sampai = $rowKelUmur['sampai'];
                                    echo "<tr>
                                    <td>$rowKelUmur[dari] - $rowKelUmur[sampai] / Tahun</td>";
                                    if (isset($_POST['id_lingkungan'])) {
                                        $id_lingkungan  = $_POST['id_lingkungan'];
                                        dataUsiaRataRataPerlingkungan($dari, $sampai, $id_lingkungan);
                                    } else {
                                        dataUsiaRataRata($dari, $sampai);
                                    }
                                    echo "<td>
                                    <a class='btn btn-warning' title='View' href='#lihatUmur' data-toggle='modal' data-id='$id_umur'><span class='iconify' data-icon='ant-design:fund-view-outlined' data-inline='false'></span></a>
                                    </td>
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="js/lihatUmur.js"></script>