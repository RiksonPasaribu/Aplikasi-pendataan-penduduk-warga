<?php
include_once "modal/inputKec.php";
include_once "modal/editKec.php";
if (isset($_POST['inputKecamatan'])) {
    $id_kab = $_POST['id_kab'];
    $kecamatan   = $_POST['kecamatan'];
    // cek kecamatan
    $cekKec = mysqli_query($conn, "SELECT * FROM tbl_kecamatan WHERE id_kab='$id_kab' AND kecamatan='$kecamatan' ");
    if (mysqli_num_rows($cekKec) > 0) {
        $pesan = "<div class='alert alert-danger'>
        <strong>Data Kecamatan </strong> $kecamatan Sudah Ada.
        </div>";
    } else {
        $inputKec = mysqli_query($conn, "INSERT INTO tbl_kecamatan (id_kab,kecamatan) 
                VALUES('$id_kab','$kecamatan')");
        if ($inputKec) {
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanGagal();
        }
    }
} else
if (isset($_POST['editKec'])) {
    $id_kec     = $_POST['id_kec'];
    $kecamatan  = $_POST['kecamatan'];
    $editKec = editKecPost($id_kec, $kecamatan);
    if ($editKec) {
        $pesan = pesanEditBerhasil();
    } else {
        $pesan = pesanGagal();
    }
} else {
    $pesan = "";
}
include_once "header/headerMenu.php";
?>
<br><br>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Kecamatan
                </h2>
                <?php
                if (!empty($pesan)) {
                    echo $pesan;
                }
                ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalKec">
                    Input Kecamatan
                </button>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kabupaten</th>
                                    <th>Kecamatan</th>
                                    <th>Jumlah Penduduk</th>
                                    <th>Pria</th>
                                    <th>Wanita</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $kec = kecamatanTable();
                                $no = 1;
                                while ($rowKec = mysqli_fetch_array($kec)) {
                                    $id_kec = $rowKec['id_kec'];
                                    echo "<tr>
                                        <td>$no</td>" .
                                        "<td>" . kabupatenId($rowKec['id_kab']) . "</td>" .
                                        "<td>$rowKec[kecamatan]</td>" .
                                        "<td>" . jumlahPendudukKecamatan($id_kec) . "</td>" .
                                        "<td>" . jumlahPendudukKecamatanJeniskelamin($id_kec, 'pria') . "</td>" .
                                        "<td>" . jumlahPendudukKecamatanJeniskelamin($id_kec, 'wanita') . "</td>
                                        <td>
                                        <a class='btn btn-success' title='Edit' href='#editKec' data-toggle='modal' data-id='$rowKec[id_kec]'><span class='iconify' data-icon='cil:zoom-in' data-inline='false'></span></a>
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
<script src="js/editKec.js"></script>