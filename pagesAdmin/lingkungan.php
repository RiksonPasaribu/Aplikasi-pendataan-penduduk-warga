<?php
include_once "modal/inputLingkungan.php";
include_once "modal/editLingkungan.php";
if (isset($_POST['inputLingkungan'])) {
    $id_kel = $_POST['id_kel'];
    $no_lingkungan = $_POST['no_lingkungan'];
    $lingkungan = $_POST['lingkungan'];
    // cek lingkungan 
    $cekLingkungan = cekLingkunganIdKel($id_kel, $lingkungan);
    if (mysqli_num_rows($cekLingkungan) > 0) {
        $pesan = pesanDuplikat();
    } else {
        $inputLingkungan = mysqli_query($conn, "INSERT INTO tbl_lingkungan (id_kel,no_lingkungan,lingkungan)
                    VALUES('$id_kel','$no_lingkungan','$lingkungan')");
        if ($inputLingkungan) {
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanGagal();
        }
    }
} else
if (isset($_POST['editLingkungan'])) {
    $id_lingkungan  = $_POST['id_lingkungan'];
    $no_lingkungan = $_POST['no_lingkungan'];
    $lingkungan = $_POST['lingkungan'];
    $editLingkungan = editLingkunganPost($id_lingkungan, $no_lingkungan, $lingkungan);
    if ($editLingkungan) {
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
                    Data Lingkungan
                </h2>
                <?php
                if (!empty($pesan)) {
                    echo $pesan;
                }
                ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLing">
                    Input Lingkungan
                </button>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelurahan</th>
                                    <th>No Lingkungan</th>
                                    <th>Lingkungan</th>
                                    <th>Jumlah Penduduk</th>
                                    <th>Pria</th>
                                    <th>Wanita</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $lingkungan = dataLingkunganTable();
                                $no = 1;
                                while ($rowLingkungan = mysqli_fetch_array($lingkungan)) {
                                    echo "<tr>
                                        <td>$no</td>" .
                                        "<td>" . kelurahanId($rowLingkungan['id_kel']) . "</td>" .
                                        "<td>$rowLingkungan[no_lingkungan]</td>
                                        <td>$rowLingkungan[lingkungan]</td>" .
                                        "<td>" . jumlahPendudukLingkungan($rowLingkungan['id_lingkungan']) . "/ Jiwa" . "</td>" .
                                        "<td>" . jumlahJenisKelaminPadaLingkungan($rowLingkungan['id_lingkungan'], 'pria') . "</td>" .
                                        "<td>" . jumlahJenisKelaminPadaLingkungan($rowLingkungan['id_lingkungan'], 'wanita') . "</td>
                                        <td><a href='#editLingkungan' data-toggle='modal' data-id='$rowLingkungan[id_lingkungan]' class='btn btn-success btn-sm'><span class='iconify' data-icon='carbon:zoom-in' data-inline='false'></span></a></td>
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
<script src="js/editLingkungan.js"></script>