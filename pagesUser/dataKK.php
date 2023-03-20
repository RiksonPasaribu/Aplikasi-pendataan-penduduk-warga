<?php
include_once "modal/lihatPenduduk.php";
include_once "modal/inputAnggotaKeluarga.php";
if (isset($_POST['inputAnggotaKeluarga'])) {
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
    $status         = $_POST['status'];
    $usia = cekUsia($tanggalLahir);
    $noKK           = $_POST['noKK'];
    $statusKeluarga = $_POST['statusKeluarga'];

    // cek nik
    $cekNik = cekNik($nik);
    // gunakan in_array untuk mengecek 2 string
    if (in_array($statusKeluarga, ["Kepala Keluarga", "Istri"])) {
        $cekStatusKeluarga = cekStatusKeluarga($noKK, $statusKeluarga);
        if (mysqli_num_rows($cekStatusKeluarga) > 0) {
            $pesan = pesanKepalaKeluarga($noKK, $statusKeluarga);
        } else {
            $inputPenduduk = mysqli_query($conn, "INSERT INTO tbl_penduduk (nik,nama,tempatLahir,tanggalLahir,jk,statusKawin,pekerjaan,pendidikan,agama,lingkungan,id_kel,id_kec,id_kab,id_prov,negara,status,usia,noKK,statusKeluarga)
            VALUES('$nik','$nama','$tempatLahir','$tanggalLahir','$jk','$statusKawin','$pekerjaan','$pendidikan','$agama','$lingkungan','$id_kel','$id_kec','$id_kab','$id_prov','$negara','$status','$usia','$noKK','$statusKeluarga')");
            if ($inputPenduduk) {
                $pesan = pesanBerhasil();
            } else {
                $pesan = pesanGagal();
            }
        }
    } else {
        if (mysqli_num_rows($cekNik) > 0) {
            $pesan = pesanDuplikatNik($nik);
        } else {
            $inputPenduduk = mysqli_query($conn, "INSERT INTO tbl_penduduk (nik,nama,tempatLahir,tanggalLahir,jk,statusKawin,pekerjaan,pendidikan,agama,lingkungan,id_kel,id_kec,id_kab,id_prov,negara,status,usia,noKK,statusKeluarga)
                                                VALUES('$nik','$nama','$tempatLahir','$tanggalLahir','$jk','$statusKawin','$pekerjaan','$pendidikan','$agama','$lingkungan','$id_kel','$id_kec','$id_kab','$id_prov','$negara','$status','$usia','$noKK','$statusKeluarga')");
            if ($inputPenduduk) {
                $pesan = pesanBerhasil();
            } else {
                $pesan = pesanGagal();
            }
        }
    }
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
                    Data kartu keluarga
                </h2>
                <a href="index.php?pendudukUser" class="badge badge-danger">
                    <span class="iconify" data-icon="akar-icons:arrow-back" data-inline="false"></span>
                    Kembali
                </a>
                <?php echo menuHeaderPenduduk(); ?>
                <?php
                if (!empty($pesan)) {
                    echo $pesan;
                }
                ?>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="index.php?index.php?pendudukUser">Kembali</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>No KK</th>
                                <th>Kepala Keluarga</th>
                                <th>Istri</th>
                                <th>Anggota Keluarga</th>
                                <th>Anak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dataKK = dataKK($id_lingkungan);
                            while ($rowKK = mysqli_fetch_array($dataKK)) {
                                $noKK = $rowKK['noKK'];
                                echo "<tr>
                                    <td>$rowKK[noKK]</td>" .
                                    "<td>" . cekKepalaKeluarga($rowKK['noKK']) . "</td>" .
                                    "<td>" . cekIstri($rowKK['noKK']) . "</td>" .
                                    "<td>" . cekAnggotaKeluarga($rowKK['noKK']) . "/ Orang" . "</td>" .
                                    "<td>" . cekJumlahAnak($rowKK['noKK']) . "</td>
                                    <td>
                                    <a class='btn btn-warning' title='view' href='#lihatPenduduk' data-toggle='modal' data-id='$noKK'><span class='iconify' data-icon='ant-design:fund-view-outlined' data-inline='false'></span></a>
                                    <a href='#inputAnggotaKeluarga' data-toggle='modal' data-id='$noKK' class='btn btn-primary btn-sm'>Input Anggota Keluarga</a>
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="js/lihatPenduduk.js"></script>
    <script src="js/inputAnggotaKeluarga.js"></script>