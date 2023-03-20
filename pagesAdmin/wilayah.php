<?php
$provinsi = dataProvinsi("71");
$rowProv = mysqli_fetch_array($provinsi);
include_once "header/headerMenu.php";
include_once "modal/editKab.php";
if (isset($_POST['editKab'])) {
    $id_kab = $_POST['id_kab'];
    $kabupaten      = $_POST['kabupaten'];
    $editKabupaten = editKabPost($id_kab, $kabupaten);
    if ($editKabupaten) {
        $pesan = pesanEditBerhasil();
    } else {
        $pesan = pesanGagal();
    }
} else {
    $pesan = "";
}
?>
<br><br>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Kota Tomohon
                </h2>
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
                                    <th>No</th>
                                    <th>Kabupaten</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $kabupaten = kabupatenTable($rowProv['id']);
                                $no = 1;
                                while ($rowKab = mysqli_fetch_array($kabupaten)) {
                                    $id_kab = $rowKab['id_kab'];
                                    echo "<tr>
                                        <td>$no</td>
                                        <td>$rowKab[kabupaten]</td>
                                        <td>
                                        <a class='btn btn-success' title='Edit' href='#editKab' data-toggle='modal' data-id='$id_kab'><span class='iconify' data-icon='carbon:zoom-in' data-inline='false'></span></a>
                                        </td>
                                    </tr>";
                                    $no++;
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
<script src="js/editKab.js"></script>