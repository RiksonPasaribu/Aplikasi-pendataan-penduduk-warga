<?php
include_once "modal/inputPenduduk.php";
include_once "modal/editPenduduk.php";
include_once "modal/pindah.php";
include_once "modal/meninggal.php";
include_once "modal/inputPendatang.php";

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
    $status         = $_POST['status'];
    $usia = cekUsia($tanggalLahir);
    // cek nik
    $cekNik = cekNik($nik);
    if (mysqli_num_rows($cekNik) > 0) {
        $pesan = pesanDuplikatNik($nik);
    } else {
        $inputPenduduk = mysqli_query($conn, "INSERT INTO tbl_penduduk (nik,nama,tempatLahir,tanggalLahir,jk,statusKawin,pekerjaan,pendidikan,agama,lingkungan,id_kel,id_kec,id_kab,id_prov,negara,status,usia)
                                                VALUES('$nik','$nama','$tempatLahir','$tanggalLahir','$jk','$statusKawin','$pekerjaan','$pendidikan','$agama','$lingkungan','$id_kel','$id_kec','$id_kab','$id_prov','$negara','$status','$usia')");
        if ($inputPenduduk) {
            header("location: index.php?pendudukUser");
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanGagal();
        }
    }
} else
if (isset($_POST['pindahPenduduk'])) {
    $id_penduduk = $_POST['id_penduduk'];
    $pindahKe    = $_POST['pindahKe'];
    $id_lingkungan  = $_POST['id_lingkungan'];
    $pindahPenduduk = pindahPendudukPost($id_penduduk, $pindahKe, $id_lingkungan);
    if ($pindahKe) {
        $pesan = pesanBerhasilPindah();
    } else {
        $pesan = pesanGagal();
    }
} else
if (isset($_POST['meninggalPenduduk'])) {
    $id_penduduk = $_POST['id_penduduk'];
    $tanggalMeninggal    = $_POST['tanggalMeninggal'];
    $id_lingkungan  = $_POST['id_lingkungan'];
    $meningggalPenduduk = meninggalPendudukPost($id_penduduk, $tanggalMeninggal, $id_lingkungan);
    if ($meningggalPenduduk) {
        $pesan = pesanBerhasil();
    } else {
        $pesan = pesanBerhasilMeninggal();
    }
} else
if (isset($_POST['inputPendudukPendatang'])) {
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
    $asal = $_POST['asal'];
    $tanggalDatang = $_POST['tanggalDatang'];
    $noKK          = $_POST['noKK'];
    // cek nik
    $cekNik = cekNik($nik);
    if (mysqli_num_rows($cekNik) > 0) {
        $pesan = pesanDuplikatNik($nik);
    } else {
        $inputPendudukPendatang = inputPendudukPendatangPost(
            $nik,
            $nama,
            $tempatLahir,
            $tanggalLahir,
            $jk,
            $statusKawin,
            $pekerjaan,
            $pendidikan,
            $agama,
            $lingkungan,
            $id_kel,
            $id_kec,
            $id_kab,
            $id_prov,
            $negara,
            $status,
            $usia,
            $noKK,
            $asal,
            $tanggalDatang
        );
        if ($inputPendudukPendatang) {
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanBerhasil();
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
                    <span class="iconify" data-icon="ph:users-four-light" data-inline="false"></span>
                    Olah Data Penduduk
                </h2>
                <?php
                if (!empty($pesan)) {
                    echo $pesan;
                }
                ?>
            </div>
            <div class="body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">
                            <span class="iconify" data-icon="fluent:number-symbol-16-regular" data-inline="false"></span>
                            Masukkan NIK
                        </label>
                        <input type="number" name="nik" class="form-control" placeholder="Masukkan Nik...">
                    </div>
                </form>
                <?php
                if (isset($_POST['nik'])) {
                    $nik = $_POST['nik'];
                    // cek nik 
                    $cekNik = cekNikIdLingkungan($nik, $_SESSION['id_lingkungan']);
                    if (mysqli_num_rows($cekNik) > 0) {
                        $dataPen = mysqli_fetch_array($cekNik);
                ?>
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);">Hasil Pencarian Nik: </a></li>
                            <li class="active"><?php echo $nik; ?> / <a href="index.php?OlahData" class="btn btn-success btn-sm text-white"> <span class="iconify" data-icon="codicon:refresh" data-inline="false"></span> Refresh</a></li>
                        </ol>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <h3>
                                    <span class="iconify" data-icon="ant-design:user-switch-outlined" data-inline="false"></span>
                                    Data Penduduk
                                </h3>
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" value="<?php echo $dataPen['nik']; ?>" class="form-control" disabled />
                                </div>
                                <div class="form-grou">
                                    <label for="">Nama</label>
                                    <input type="text" value="<?php echo $dataPen['nama']; ?>" class="form-control" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="">Tempat / Tanggal Lahir</label>
                                    <input type="text" class="form-control" value="<?php echo $dataPen['tempatLahir']; ?>" disabled />
                                    <input type="date" value="<?php echo $dataPen['tanggalLahir']; ?>" class="form-control" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="">Usia</label>
                                    <input type="number" value="<?php echo $dataPen['usia']; ?>" class="form-control" disabled />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h3>
                                    <span class="iconify" data-icon="carbon:user-x-ray" data-inline="false"></span>
                                    Menu Lainnya
                                </h3>
                                <div class="btn-group" role="group">
                                    <a href="#pindah" data-toggle='modal' data-id="<?php echo $dataPen['id_penduduk']; ?>" class="btn bg-teal waves-effect">
                                        <span class="iconify" data-icon="akar-icons:sign-out" data-inline="false"></span>
                                        Pindah
                                    </a>
                                    <a href="#meninggal" data-toggle='modal' data-id="<?php echo $dataPen['id_penduduk']; ?>" type="button" class="btn bg-teal waves-effect">
                                        <span class="iconify" data-icon="la:book-dead" data-inline="false"></span>
                                        Meninggal
                                    </a>
                                    <a href="#editPenduduk" data-toggle='modal' data-id="<?php echo $dataPen['id_penduduk']; ?>" class="btn bg-teal waves-effect">
                                        <span class="iconify" data-icon="akar-icons:sign-out" data-inline="false"></span>
                                        Edit Data
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    } else {
                        echo '<div class="row clearfix">
                                    <div class="col-sm-6">
                                    <h4 class="animate__animated animate__bounceInDown">
                                        <span class="iconify" data-icon="healthicons:not-ok-outline" data-inline="false"></span>';
                        echo "Data Nik $nik Tidak Terdaftar";
                        echo '</h4>
                                    </div>
                                    <div class="col-sm-6">';
                        echo "<a href='#inputPendatang' data-toggle='modal' data-id='$nik' class='btn bg-teal waves-effect'>";
                        echo '<span class="iconify" data-icon="icon-park-outline:date-comes-back" data-inline="false"></span>
                                                Input Sebagai Pendatang
                                        </a>
                                    </div>
                            </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="js/pindah.js"></script>
<script src="js/meninggal.js"></script>
<script src="js/inputPendatang.js"></script>
<script src="js/editPenduduk.js"></script>