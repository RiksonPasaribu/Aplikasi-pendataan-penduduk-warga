<?php
include_once "modal/inputPenduduk.php";
include_once "modal/editPenduduk.php";
if (isset($_POST['inputPenduduk'])) {
    $nik    = $_POST['nik'];
    $nama   = $_POST['nama'];
    $tempatLahir    = $_POST['tempatLahir'];
    $tanggalLahir   = $_POST['tanggalLahir'];
    $jk             = $_POST['jk'];
    $statusKawin    = $_POST['statusKawin'];
    $pekerjaan      = $_POST['pekerjaan'];
    $pendidikan     = $_POST['pendidikan'];
    $agama          = $_POST['agama'];
    $lingkungan     = $_POST['id_lingkungan'];
    $id_kel         = $_POST['id_kel'];
    $id_kec         = $_POST['id_kec'];
    $id_kab         = $_POST['id_kab'];
    $id_prov        = $_POST['id_prov'];
    $negara         = $_POST['negara'];
    $status         = "tetap";
    $usia = cekUsia($tanggalLahir);
    // cek nik
    $cekNik = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE nik='$_POST[nik]' ");
    if (mysqli_num_rows($cekNik) > 0) {
        $pesan = "<div class='alert alert-danger alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <strong>Maaf Data Nik </strong> $nik Sudah Ada.
                </div>";
    } else {
        $inputPenduduk = mysqli_query($conn, "INSERT INTO tbl_penduduk (nik,nama,tempatLahir,tanggalLahir,jk,statusKawin,pekerjaan,pendidikan,agama,lingkungan,id_kel,id_kec,id_kab,id_prov,negara,status,usia)
                                                        VALUES('$nik','$nama','$tempatLahir','$tanggalLahir','$jk','$statusKawin','$pekerjaan','$pendidikan','$agama','$lingkungan','$id_kel','$id_kec','$id_kab','$id_prov','$negara','$status','$usia')");
        if ($inputPenduduk) {
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanGagal();
        }
    }
} else
        if (isset($_POST['editPenduduk'])) {
    $id_penduduk = $_POST['id_penduduk'];
    $nik    = $_POST['nik'];
    $nama   = $_POST['nama'];
    $tempatLahir    = $_POST['tempatLahir'];
    $tanggalLahir   = $_POST['tanggalLahir'];
    $jk             = $_POST['jk'];
    $statusKawin    = $_POST['statusKawin'];
    $pekerjaan      = $_POST['pekerjaan'];
    $pendidikan     = $_POST['pendidikan'];
    $agama          = $_POST['agama'];
    $lingkungan     = $_POST['id_lingkungan'];
    $id_kel         = $_POST['id_kel'];
    $id_kec         = $_POST['id_kec'];
    $id_kab         = $_POST['id_kab'];
    $id_prov        = $_POST['id_prov'];
    $negara         = $_POST['negara'];
    $status         = "tetap";
    $usia = cekUsia($tanggalLahir);
    $editPen = mysqli_query($conn, "UPDATE tbl_penduduk SET nik='$nik', nama='$nama', tanggalLahir='$tanggalLahir', tempatLahir='$tempatLahir', agama='$agama', usia='$usia' 
                                    WHERE id_penduduk='$id_penduduk'");
} else {
    $pesan = "";
}
?>
<!-- #END# Basic Examples -->
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Penduduk
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
                <!-- Button trigger modal -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalPenduduk">
                    Input Data Penduduk
                </button> -->
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tempat / Tanggak Lahir</th>
                                <th>Usia</th>
                                <th>Pekerjaan</th>
                                <th>Lingkungan</th>
                                <th>Kelurahan</th>
                                <th>kecamatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['id_lingkungan'])) {
                                $id_lingkungan  = $_POST['id_lingkungan'];
                                $penduduk = pendudukKeseluruhanTableIdLing($id_lingkungan);
                            } else {
                                $penduduk = pendudukKeseluruhanTable();
                            }
                            while ($rowPenduduk = mysqli_fetch_array($penduduk)) {
                                $id_penduduk = $rowPenduduk['id_penduduk'];
                                $id_kec     = $rowPenduduk['id_kec'];
                                // pekerjaan 
                                $pekerjaan = mysqli_query($conn, "SELECT * FROM tbl_pekerjaan WHERE id_pekerjaan ='$rowPenduduk[pekerjaan]' ");
                                $rowPekerjaan = mysqli_fetch_array($pekerjaan);
                                // lingkungan
                                $lingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan WHERE id_lingkungan='$rowPenduduk[lingkungan]' ");
                                $rowLingkungan = mysqli_fetch_array($lingkungan);
                                // kelurahan
                                $kel = mysqli_query($conn, "SELECT * FROM tbl_kelurahan WHERE id_kel='$rowPenduduk[id_kel]' ");
                                $rowKel = mysqli_fetch_array($kel);
                                $tanggalLahir = $rowPenduduk['tanggalLahir'];
                                echo "<tr>
                                            <td>$rowPenduduk[nik]</td>
                                            <td>$rowPenduduk[nama]</td>
                                            <td>$rowPenduduk[tempatLahir] / $rowPenduduk[tanggalLahir]</td>" .
                                    "<td>" . cekUsia($tanggalLahir) . "</td>" .
                                    "<td>$rowPekerjaan[pekerjaan]</td>
                                            <td>$rowLingkungan[lingkungan]</td>
                                            <td>$rowKel[kelurahan]</td>" .
                                    "<td>" . kecamatan($id_kec) . "</td>" .
                                    "<td>
                                        <a class='btn btn-success' title='Edit' href='#editPenduduk' data-toggle='modal' data-id='$id_penduduk'><span class='iconify' data-icon='carbon:zoom-in' data-inline='false'></span></a>
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
<!-- #END# Exportable Table -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="js/editPenduduk.js"></script>