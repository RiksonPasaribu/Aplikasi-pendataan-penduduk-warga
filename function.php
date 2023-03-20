<?php
ob_start();
session_start();
include_once "koneksi.php";
// funtion halaman dashboard
// jumlah kecamatan
function jumlahKecamatan()
{
    global $conn;
    $kec = mysqli_query($conn, "SELECT * FROM tbl_kecamatan");
    $jumKec = mysqli_num_rows($kec);
    echo $jumKec;
}

// jumlah kelurahan
function jumlahKelurahan()
{
    global $conn;
    $kelurahan = mysqli_query($conn, "SELECT * FROM tbl_kelurahan ");
    $jumKel = mysqli_num_rows($kelurahan);
    echo $jumKel;
}

// menu admin
function menuAdmin()
{
    $menuAdmin = ' <li>
                        <a href="index.php?wilayah">
                            <i class="material-icons">text_fields</i>
                            <span>Wilayah</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Data Master</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="index.php?pendudukAdmin">Data Penduduk</a>
                            </li>        
                            <li>
                                <a href="index.php?agama">Data Agama</a>
                            </li>
                            <li>
                                <a href="index.php?pendidikan">Data Pendidikan</a>
                            </li>
                            <li>
                                <a href="index.php?pekerjaan">Data Pekerjaan</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php?users">
                            <i class="material-icons">layers</i>
                            <span>Data User</span>
                        </a>
                    </li>
                    <li class="header">Laporan</li>
                    <li>
                        <a href="index.php?umur">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Penduduk (Umur)</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?pekerjaanPerlingkungan">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Penduduk (Pekerjaan)</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?agamaPerlingkungan">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Penduduk (Agama)</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?pendidikanPerlingkungan">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Penduduk (Pendidikan)</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?kepalaKeluarga">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Penduduk (Kepala Keluarga)</span>
                        </a>
                    </li>';
    return $menuAdmin;
}

// menu users
function menuUser()
{

    if (in_array($_SESSION['level'], ["kecamatan", "kelurahan"])) {
        $menuUser = '<li>
                <a href="index.php?pendudukUser">
                    <i class="material-icons">text_fields</i>
                    <span>Data Penduduk</span>
                </a>
            </li>';
    } else {
        $menuUser = '<li>
                <a href="index.php?pendudukUser">
                    <i class="material-icons">text_fields</i>
                    <span>Data Penduduk</span>
                </a>
            </li> 
            <li>
                <a href="index.php?OlahData">
                <i class="material-icons">accessibility</i>
                <span class="icon-name">Olah Data Penduduk</span>
                </a>
                </li>';
    }
    return $menuUser;
}

// menu header penduduk 
function menuHeaderPenduduk()
{
    $menu = '<a href="index.php?dataKK" class="btn btn-warning">
    <span class="iconify" data-icon="bi:list" data-inline="false"></span>
    Data KK
    </a>
    <a href="index.php?pendudukLahir" class="btn btn-info btn-sm">Penduduk Lahir</a>
    <a href="index.php?pendudukPindah" class="btn btn-info btn-sm">Penduduk Pindah</a>
    <a href="index.php?pendudukPendatang" class="btn btn-secondary">Penduduk Pendatang</a>
    <a href="index.php?pendudukMeninggal" class="btn btn-dark">Penduduk Meninggal</a>';
    return $menu;
}

// cek nik 
function cekNik($nik)
{
    global $conn;
    $cekNik = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE nik='$nik' AND status!='pindah' AND status!='meninggal' ");
    return $cekNik;
}

// datatable
function dataTable($table)
{
    global $conn;
    $data = mysqli_query($conn, "SELECT * FROM $table ");
    return $data;
}

// cek nik berdasarkan lingkungan
function cekNikIdLingkungan($nik, $id_lingkungan)
{
    global $conn;
    $cekNik = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE nik='$nik' AND lingkungan='$id_lingkungan' AND status!='pindah' AND status!='meninggal' ");
    return $cekNik;
}

// select data penduduk berdasarkan id_penduduk
function dataPenduduk($id_penduduk)
{
    global $conn;
    $penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE id_penduduk='$id_penduduk' ");
    return $penduduk;
}

// data penduduk list
function dataPendudukList($nik, $field)
{
    global $conn;
    $data = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE nik='$nik' ");
    $row = mysqli_fetch_array($data);
    return $row[$field];
}

// data penduduk pindah berdasarkan lingkungan
function pendudukPidahPerlingkungan($id_lingkungan)
{
    global $conn;
    if ($_SESSION['level'] == "kecamatan") {
        $penPindah = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='pindah' AND id_kec='$_SESSION[id_kec]' ");
    } else 
    if ($_SESSION['level'] == "kelurahan") {
        $penPindah = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='pindah' AND id_kel='$_SESSION[id_kel]'");
    } else {
        $penPindah = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='pindah'");
    }
    return $penPindah;
}

// penduduk datang perlingkungan
function pendudukPendatangLing($id_lingkungan)
{
    global $conn;
    if ($_SESSION['level'] == "kecamatan") {
        $pendatang = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='pendatang' AND id_kec='$_SESSION[id_kec]' ");
    } else 
    if ($_SESSION['level'] == "kelurahan") {
        $pendatang = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='pendatang' AND id_kel='$_SESSION[id_kel]' ");
    } else {
        $pendatang = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='pendatang' AND lingkungan='$id_lingkungan' ");
    }
    return $pendatang;
}

// data pendatang
function dataPendatang($nik)
{
    global $conn;
    $dataPendatang = mysqli_query($conn, "SELECT * FROM tbl_pendatang WHERE nik='$nik' ");
    return $dataPendatang;
}

// penduduk meninggal 
function dataMeninggal($id_lingkungan)
{
    global $conn;
    if ($_SESSION['level'] == "kecamatan") {
        $meninggal = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='meninggal' AND id_kec='$_SESSION[id_kec]' ");
    } else 
    if ($_SESSION['level'] == "kelurahan") {
        $meninggal = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='meninggal' AND id_kel='$_SESSION[id_kel]' ");
    } else {
        $meninggal = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='meninggal' AND lingkungan='$id_lingkungan' ");
    }
    return $meninggal;
}

// tanggal meninggal 
function tanggalMeninggal($nik)
{
    global $conn;
    $data = mysqli_query($conn, "SELECT * FROM tbl_meninggal WHERE nik='$nik' ");
    $row = mysqli_fetch_array($data);
    return $row['tanggalMeninggal'];
}

// cek di table pindah 
function pindahKe($nik)
{
    global $conn;
    $pindah = mysqli_query($conn, "SELECT * FROM tbl_pindah WHERE nik='$nik' ");
    $rowPindah = mysqli_fetch_array($pindah);
    return $rowPindah['pindahKe'];
}

// pindah penduduk select 
function pindahPenduduk($id_penduduk)
{
    global $conn;
    $penduduk = dataPenduduk($id_penduduk);
    $rowPen = mysqli_fetch_array($penduduk);
    echo "<div class='form-group'>
        <label>Pindah Ke</label>
        <input type='hidden' name='id_lingkungan' value='$rowPen[lingkungan]'>
        <input type='hidden' name='id_penduduk' value='$id_penduduk'>
            <input type='text' name='pindahKe' class='form-control' placeholder='Pindah Ke...' required/>
        </div>";
}

// meninggal penduduk Select 
function meninggalPenduduk($id_penduduk)
{
    global $conn;
    $penduduk = dataPenduduk($id_penduduk);
    $rowPen = mysqli_fetch_array($penduduk);
    echo "<div class='form-group'>
        <label>Tanggal Meninggal</label>
        <input type='hidden' name='id_lingkungan' value='$rowPen[lingkungan]'>
        <input type='hidden' name='id_penduduk' value='$id_penduduk'>
            <input type='date' name='tanggalMeninggal' class='form-control' required/>
        </div>";
}

// ubah status penduduk pada table penduduk
function ubahStatusPenduduk($id_penduduk, $status)
{
    global $conn;
    $ubahStatus = mysqli_query($conn, "UPDATE tbl_penduduk SET status='$status' 
    WHERE id_penduduk='$id_penduduk' ");
    return $ubahStatus;
}
// pindah penduduk Post
function pindahPendudukPost($id_penduduk, $pindahKe, $id_lingkungan)
{
    global $conn;
    $dataPenduduk = dataPenduduk($id_penduduk);
    $rowPenduduk = mysqli_fetch_array($dataPenduduk);
    // ubah status penduduk
    $pindahPenduduk = ubahStatusPenduduk($id_penduduk, "pindah");
    // input data pindah
    $inputDataPindah = "INSERT INTO tbl_pindah (nik,pindahKe,id_lingkungan)
                                        VALUES('$rowPenduduk[nik]','$pindahKe','$id_lingkungan')";
    $koneksikan = mysqli_query($conn, $inputDataPindah);
    return $koneksikan;
}

// meninggal penduduk Post 
function  meninggalPendudukPost($id_penduduk, $tanggalMeninggal, $id_lingkungan)
{
    global $conn;
    $dataPenduduk = dataPenduduk($id_penduduk);
    $rowPenduduk = mysqli_fetch_array($dataPenduduk);
    // ubah status penduduk
    $meninggalPenduduk = ubahStatusPenduduk($id_penduduk, "meninggal");
    // input data meninggal 
    $inputDataMeninggal = "INSERT INTO tbl_meninggal (nik,tanggalMeninggal,id_lingkungan)
                            VALUES('$rowPenduduk[nik]','$tanggalMeninggal','$id_lingkungan')";
    $koneksikan = mysqli_query($conn, $inputDataMeninggal);
    return $koneksikan;
}

// pesan duplikat
function pesanDuplikat()
{
    $dataPesan = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <strong>Maaf Data </strong> Sudah Ada.
                    </div>";
    return $dataPesan;
}
// pesan
function pesanBerhasil()
{
    $dataPesan = '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Berhasil </strong> Menambah Kan Data.
    </div>';
    return $dataPesan;
}

function pesanEditBerhasil()
{
    $dataPesan = '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Berhasil </strong> Mengubah Data.
    </div>';
    return $dataPesan;
}

// pesan gagal
function pesanGagal()
{
    $dataPesan = '<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Gagal </strong> Input .
    </div>';
    return $dataPesan;
}

// pesan status keluarga
function pesanKepalaKeluarga($noKK, $statusKeluarga)
{
    $dataPesan = "<div class='alert alert-danger alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Maaf $statusKeluarga </strong> Tidak Boleh dua Orang Dalam satu KK $noKK.
    </div>";
    return $dataPesan;
}

// pesan duplikat nik
function pesanDuplikatNik($nik)
{
    $dataPesan = "<div class='alert alert-danger alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Maaf Data Nik </strong> $nik Sudah Ada.
            </div>";
    return $dataPesan;
}

// pesan pindah penduduk berhasil
function pesanBerhasilPindah()
{
    $dataPesan = '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Berhasil </strong> Memindah Kan Data Penduduk.
    </div>';
    return $dataPesan;
}

// pesan berhasil meninggal
function pesanBerhasilMeninggal()
{
    $dataPesan = '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Berhasil </strong> Menginput Kan Data Penduduk yang Meninggal.
    </div>';
    return $dataPesan;
}

// data umur between
function tampilkanPendudukBerdasarkanUmur($id_umur)
{
    global $conn;
    $dataUmur = mysqli_query($conn, "SELECT * FROM tbl_umur WHERE id_umur='$id_umur' ");
    $rowUmur = mysqli_fetch_array($dataUmur);
    echo "Select Kelompok Umur " . $rowUmur['dari'] . "-" . $rowUmur['sampai'] . "Tahun";
    $dari = $rowUmur['dari'];
    $sampai = $rowUmur['sampai'];
    echo '<table class="table table-bordered table-striped table-hover dataTable js-exportable">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Usia</th>
            </tr>
        </thead>
        <tbody>';
    $penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE usia BETWEEN $dari AND $sampai ");
    while ($rowPen = mysqli_fetch_array($penduduk)) {
        echo "<tr>
            <td>$rowPen[nik]</td>
            <td>$rowPen[nama]</td>
            <td>$rowPen[tanggalLahir]</td>
            <td>$rowPen[usia] / Tahun</td>
        </tr>";
    }
    echo '</tbody>
    </table>';
}

// data agama
function dataAgama()
{
    $agama = array('Islam', 'Kristen Katholik', 'Kristen Protestan', 'Hindu', 'Budha');
    return $agama;
}

// cek jumlah agama
function cekJumlahAgama($ag)
{
    global $conn;
    $dataAgama = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE agama='$ag' ");
    $jumlahAg = mysqli_num_rows($dataAgama);
    return $jumlahAg;
}

// cek jumlah agama perlingkungan
function cekJumlahAgamaPerlingkungan($ag, $id_lingkungan)
{
    global $conn;
    $dataAgama = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE agama='$ag' AND lingkungan='$id_lingkungan' ");
    $jumlahAg = mysqli_num_rows($dataAgama);
    return $jumlahAg;
}

// hitung jumlah agama pada setiap Lingkungan
function hitungJumlahAgama($id_lingkungan, $ag)
{
    global $conn;
    $dataAgama = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahAgama FROM tbl_penduduk WHERE lingkungan='$id_lingkungan' AND agama='$ag' ");
    $jumlahAg = mysqli_fetch_array($dataAgama);
    return $jumlahAg['jumlahAgama'];
}

// data pendidikan
function dataPendidikan()
{
    $pendidikan = array('SD', 'SMP', 'SMA', 'S1', 'S2', 'S3', 'Tidak Sekolah');
    return $pendidikan;
}

// data status penduduk option 
function statusPenduduk()
{
    $statusPenduduk = array('tetap', 'pendatang', 'lahiran');
    return $statusPenduduk;
}

// status pendatang
function statusPendatang()
{
    $statusPendatang = array('pendatang');
    return $statusPendatang;
}

// input pendatang POST
function inputPendudukPendatangPost(
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
) {
    global $conn;
    // input penduduk
    $inputPendatang = mysqli_query($conn, "INSERT INTO tbl_penduduk (nik,nama,tempatLahir,tanggalLahir,jk,statusKawin,pekerjaan,pendidikan,agama,lingkungan,id_kel,id_kec,id_kab,id_prov,negara,status,usia,noKK)
    VALUES('$nik','$nama','$tempatLahir','$tanggalLahir','$jk','$statusKawin','$pekerjaan','$pendidikan','$agama','$lingkungan','$id_kel','$id_kec','$id_kab','$id_prov','$negara','$status','$usia','$noKK')");
    // input ke table pendatang 
    $inputdataPendatang = mysqli_query($conn, "INSERT INTO tbl_pendatang (nik,asal,tanggalDatang)
                                VALUES('$nik','$asal','$tanggalDatang')");
}

// hitung data pendidikan keseluruhan 
function hitungJumlahPendidikan($pen)
{
    global $conn;
    $dataPendidikan = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE pendidikan='$pen' ");
    $jumPendidikan = mysqli_num_rows($dataPendidikan);
    return $jumPendidikan;
}

// hitung data pendidikan perlingkungan
function hitungJumlahPendidikanPerlingkungan($pen, $id_lingkungan)
{
    global $conn;
    $dataPendidikan = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE pendidikan='$pen' AND lingkungan='$id_lingkungan' ");
    $jumPendidikan = mysqli_num_rows($dataPendidikan);
    return $jumPendidikan;
}

// jumlah pendidikan berdasarkan lingkungan
function hitungJumlahPendidikanLingkungan($id_lingkungan, $pen)
{
    global $conn;
    $dataPendidikan = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahPendidikanLing FROM tbl_penduduk WHERE lingkungan='$id_lingkungan' AND pendidikan='$pen' ");
    $jumPendidikan = mysqli_fetch_array($dataPendidikan);
    return $jumPendidikan['jumlahPendidikanLing'];
}

// status keluarga
function statusKeluargaOption()
{
    echo "<option value=''> -- Status Dalam Keluarga -- </option>";
    $statuskeluarga = array('Kepala Keluarga', 'Istri', 'Anak');
    foreach ($statuskeluarga as $sk) {
        echo "<option value='$sk'>$sk</option>";
    }
}

// penduduk pindah
function pendudukPindahKeseluruhan()
{
    global $conn;
    $pendudukPindah = mysqli_query($conn, "SELECT * FROM tbl_pindah ");
    $jumlahPindah = mysqli_num_rows($pendudukPindah);
    echo $jumlahPindah;
}

// penduduk
function pendudukMeninggal()
{
    global $conn;
    $pendudukMeninggal = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='meninggal' ");
    $jumlahMeninggal = mysqli_num_rows($pendudukMeninggal);
    echo $jumlahMeninggal;
}

// penduduk pendatang
function pendudukPendatang()
{
    global $conn;
    $pendudukPendatang = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='pendatang' ");
    $jumlahPendatang = mysqli_num_rows($pendudukPendatang);
    echo $jumlahPendatang;
}

// penduduk lahiran
function pendudukLahir()
{
    global $conn;
    $dataLahiran = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='lahiran' ");
    $jumlahLahir = mysqli_num_rows($dataLahiran);
    echo $jumlahLahir;
}

// penduduk tetap
function pendudukTetap()
{
    global $conn;
    $pendudukTetap = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='tetap' ");
    $jumlahtetap = mysqli_num_rows($pendudukTetap);
    echo $jumlahtetap;
}
// total penduduk
function totalPenduduk()
{
    global $conn;
    $Penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk ");
    $totalPenduduk = mysqli_num_rows($Penduduk);
    echo $totalPenduduk;
}
// total user
function totalUser()
{
    global $conn;
    $users = mysqli_query($conn, "SELECT * FROM tbl_login WHERE level!='admin' ");
    $jumlahUsers = mysqli_num_rows($users);
    echo $jumlahUsers;
}
// total lurah
function totalLurah()
{
    global $conn;
    $kelurahan = mysqli_query($conn, "SELECT * FROM tbl_kelurahan");
    $totalKelurahan = mysqli_num_rows($kelurahan);
    echo $totalKelurahan;
}

// penduduk pindah perlingkungan
function pendudukPindahPerlingkungan($id_lingkungan)
{
    global $conn;
    $pendudukPindah = mysqli_query($conn, "SELECT * FROM tbl_pindah WHERE id_lingkungan='$id_lingkungan' ");
    $jumlahPindah = mysqli_num_rows($pendudukPindah);
    echo $jumlahPindah;
}

// penduduk meninggal perlingkungan
function pendudukMeninggalPerlingkungan($id_lingkungan)
{
    global $conn;
    $pendudukMeninggal = mysqli_query($conn, "SELECT * FROM tbl_meninggal WHERE id_lingkungan='$id_lingkungan' ");
    $jumlahMeninggal = mysqli_num_rows($pendudukMeninggal);
    echo $jumlahMeninggal;
}

// penduduk pendatang perlingkungan
function pendudukPendatangPerlingkungan($id_lingkungan)
{
    global $conn;
    $pendudukPendatang = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='pendatang' AND lingkungan='$id_lingkungan' ");
    $jumlahPendatang = mysqli_num_rows($pendudukPendatang);
    echo $jumlahPendatang;
}

// penduduk lahir perlingkungan 
function pendudukLahirPerlingkungan($id_lingkungan)
{
    global $conn;
    if ($_SESSION['level'] == "kecamatan") {
        $dataLahiran = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='lahiran' AND id_kec='$_SESSION[id_kec]' ");
    } else 
    if ($_SESSION['level'] == "kelurahan") {
        $dataLahiran = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='lahiran' AND id_kel='$_SESSION[id_kel]' ");
    } else {
        $dataLahiran = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='lahiran' AND lingkungan='$id_lingkungan' ");
    }
    $jumlahLahir = mysqli_num_rows($dataLahiran);
    if (isset($_GET['pendudukLahir'])) {
        return $dataLahiran;
    } else {
        echo $jumlahLahir;
    }
}

// penduduk tetap perlingkungan
function pendudukTetapPerlingkungan($id_lingkungan)
{
    global $conn;
    $pendudukTetap = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='tetap' AND lingkungan='$id_lingkungan' ");
    $jumlahtetap = mysqli_num_rows($pendudukTetap);
    echo $jumlahtetap;
}

// total penduduk perlingkungan
function totalPendudukPerlingkungan($id_lingkungan)
{
    global $conn;
    $Penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE lingkungan='$id_lingkungan' AND status!='pindah' AND status!='meninggal' ");
    $totalPenduduk = mysqli_num_rows($Penduduk);
    echo $totalPenduduk;
}

// data lingkungan select 
function dataLingkunganSelect()
{
    global $conn;
    $ling = mysqli_query($conn, "SELECT * FROM tbl_lingkungan ");
    echo "<option value=''> -- Data Lingkungan -- </option>";
    while ($rowLingk = mysqli_fetch_array($ling)) {
        echo "<option value='$rowLingk[id_lingkungan]'>$rowLingk[lingkungan]</option>";
    }
}
// hitung pekerjaan
function hitungPekerjaan($id_pekerjaan)
{
    global $conn;
    // hitung pekerjaan 
    $pekerjaan = mysqli_query($conn, "SELECT COUNT(id_penduduk) as dataPekerjaan FROM tbl_penduduk WHERE pekerjaan='$id_pekerjaan' ");
    $hasilDataPekerjaan = mysqli_fetch_array($pekerjaan);
    return $hasilDataPekerjaan['dataPekerjaan'];
}

// hitung pekerjaan perlingkungan
function hitungPekerjaanPerlingkungan($id_pekerjaan, $id_lingkungan)
{
    global $conn;
    $pekerjaan = mysqli_query($conn, "SELECT COUNT(id_penduduk) as dataPekerjaan FROM tbl_penduduk WHERE pekerjaan='$id_pekerjaan' AND lingkungan='$id_lingkungan' ");
    $hasilDataPekerjaan = mysqli_fetch_array($pekerjaan);
    return $hasilDataPekerjaan['dataPekerjaan'];
}

// cek status keluarga kepala keluarga || istri
function cekStatusKeluarga($noKK, $statusKeluarga)
{
    global $conn;
    $cekKepalaAtauIstri = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE noKK='$noKK' AND statusKeluarga='$statusKeluarga' ");
    return $cekKepalaAtauIstri;
}

// cek usia
function cekUsia($tanggalLahir)
{
    $birthDate = new DateTime($tanggalLahir);
    $today = new DateTime("today");
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->d;
    $td = $y;
    if (isset($_GET['pendudukLahir'])) {
        return $d . "Hari/" . $m . "Bulan";
    } else {
        return $td;
    }
}

// kelompok umur
function kelompokUmur()
{
    global $conn;
    $umur = mysqli_query($conn, "SELECT * FROM tbl_umur ORDER BY id_umur DESC ");
    return $umur;
}

// kecamatan option
function dataKecamatanOption($id_kec)
{
    global $conn;
    $kec = mysqli_query($conn, "SELECT * FROM tbl_kecamatan WHERE id_kec='$id_kec' ");
    $rowKec = mysqli_fetch_array($kec);
    echo "<option value='$rowKec[id_kec]'>$rowKec[kecamatan]</option>";
}

// data kelurahan option
function dataKelurahanOption($id_kel)
{
    global $conn;
    $kelurahan = mysqli_query($conn, "SELECT * FROM tbl_kelurahan WHERE id_kel='$id_kel' ");
    $rowKel = mysqli_fetch_array($kelurahan);
    $id_kelurahan = $rowKel['id_kel'];
    $kelurahan = $rowKel['kelurahan'];
    echo "<option value='$id_kelurahan'>$kelurahan</option>";
}

function kelurahanId($id_kel)
{
    global $conn;
    $kel = mysqli_query($conn, "SELECT * FROM tbl_kelurahan WHERE id_kel='$id_kel' ");
    $rowKel = mysqli_fetch_array($kel);
    return $rowKel['kelurahan'];
}

// data lingkunhgan option
function dataLingkungan($id_lingkungan)
{
    global $conn;
    $lingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan WHERE id_lingkungan='$id_lingkungan' ");
    $rowLingkungan = mysqli_fetch_array($lingkungan);
    echo "<option value='$rowLingkungan[id_lingkungan]'>$rowLingkungan[lingkungan]</option>";
}

// data pekerjaan keseluruhan
function dataPekerjaanKeseluruhan()
{
    global $conn;
    $pekerjaan = mysqli_query($conn, "SELECT * FROM tbl_pekerjaan ");
    return $pekerjaan;
}

// data pekerjaan 
function dataPekerjaan($pekerjaan)
{
    global $conn;
    $pekerjaan = mysqli_query($conn, "SELECT * FROM tbl_pekerjaan WHERE id_pekerjaan='$pekerjaan' ");
    $rowPk = mysqli_fetch_array($pekerjaan);
    echo "<option value='$rowPk[id_pekerjaan]'>$rowPk[pekerjaan]</option>";
}

// data kecamatan 
function kecamatan($id_kec)
{
    global $conn;
    $kec = mysqli_query($conn, "SELECT * FROM tbl_kecamatan WHERE id_kec='$id_kec' ");
    $rowKec = mysqli_fetch_array($kec);
    $kecamatan = $rowKec['kecamatan'];
    return $kecamatan;
}

// cek jumlah usia rata - rata 
function dataUsiaRataRata($dari, $sampai)
{
    global $conn;
    $cekKelompokUsia = mysqli_query($conn, "SELECT COUNT(nik) jumlahUsiaRataRata FROM tbl_penduduk WHERE usia BETWEEN $dari AND $sampai ");
    $rowUsiaRataRata = mysqli_fetch_array($cekKelompokUsia);
    echo "<td>$rowUsiaRataRata[jumlahUsiaRataRata] / Jiwa</td>";
}

// jumlah usia rata2
function jumlahUsiaRataRata($dari, $sampai)
{
    global $conn;
    $cekKelompokUsia = mysqli_query($conn, "SELECT COUNT(nik) jumlahUsiaRataRata FROM tbl_penduduk WHERE usia BETWEEN $dari AND $sampai ");
    $rowUsiaRataRata = mysqli_fetch_array($cekKelompokUsia);
    return $rowUsiaRataRata['jumlahUsiaRataRata'];
}

// data usia rata rata perlingkungan
function dataUsiaRataRataPerlingkungan($dari, $sampai, $id_lingkungan)
{
    global $conn;
    $cekKelompokUsia = mysqli_query($conn, "SELECT COUNT(nik) jumlahUsiaRataRata FROM tbl_penduduk WHERE lingkungan='$id_lingkungan' AND usia BETWEEN $dari AND $sampai ");
    $rowUsiaRataRata = mysqli_fetch_array($cekKelompokUsia);
    echo "<td>$rowUsiaRataRata[jumlahUsiaRataRata] / Jiwa</td>";
}

// penduduk keseluruhan
function pendudukKeseluruhanTable()
{
    global $conn;
    $penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk");
    return $penduduk;
}

// penduduk perlingkungan
function pendudukKeseluruhanTableIdLing($id_lingkungan)
{
    global $conn;
    $penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE lingkungan='$id_lingkungan' ");
    return $penduduk;
}

// cari no kk
function cariNoKK($noKK)
{
    global $conn;
    $cariKK = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE noKK='$noKK' ");
    if (mysqli_num_rows($cariKK) > 0) {
        echo "<div class='card'>
        <div class='body'>
        <h3>Result : $noKK</h3>";
        echo '<table class="table table-bordered table-striped table-hover dataTable js-exportable">
            <thead>
                <tr>
                    <th>No KK</th>
                    <th>Nik</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Status Dalam Keluarga</th>
                </tr>
            </thead>
            <tbody>';
        while ($rowKK = mysqli_fetch_array($cariKK)) {
            echo "<tr>
            <td>$rowKK[noKK]</td>
            <td>$rowKK[nik]</td>
            <td>$rowKK[nama]</td>
            <td>$rowKK[tanggalLahir]</td>
            <td>$rowKK[statusKeluarga]</td>
        </tr>";
        }
        echo "</tbody>
        </table>
        </div>
        </div>";
    } else {
        $data = '<h3 class="animate__animated animate__tada">' . "No KK $noKK Belum Terdaftar" . '</h3>';
        echo $data;
    }
}

// data kk
function dataKK($id_lingkungan)
{
    global $conn;
    $kk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE lingkungan='$id_lingkungan' GROUP BY noKK ");
    return $kk;
}

// cek kepala keluarga 
function cekKepalaKeluarga($noKK)
{
    global $conn;
    $kepalaKeluarga = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE statusKeluarga='kepala keluarga' AND noKK='$noKK' ");
    $namaKepala = mysqli_fetch_array($kepalaKeluarga);
    return $namaKepala['nama'];
}

// cek nama istri pada kk
function cekIstri($noKK)
{
    global $conn;
    $istri = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE noKK='$noKK' AND statusKeluarga='Istri' ");
    if (mysqli_num_rows($istri) > 0) {
        $rowIstri = mysqli_fetch_array($istri);
        $namaIstri = $rowIstri['nama'];
    } else {
        $namaIstri = "-";
    }
    return $namaIstri;
}

// cek jumlah anggota keluarga
function cekAnggotaKeluarga($noKK)
{
    global $conn;
    $dataAnggota = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahAnggota FROM tbl_penduduk WHERE noKK='$noKK' AND status='tetap' ");
    $jumlahAg = mysqli_fetch_array($dataAnggota);
    return $jumlahAg['jumlahAnggota'];
}

// cek jumlah anak
function cekJumlahAnak($noKK)
{
    global $conn;
    $dataAnak = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahAnak FROM tbl_penduduk WHERE noKK='$noKK' AND statusKeluarga='Anak' ");
    $jumlahAnak = mysqli_fetch_array($dataAnak);
    return $jumlahAnak['jumlahAnak'];
}

//cek ortu 
function cekOrtu($noKK, $ortu)
{
    global $conn;
    $ortu = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE noKK='$noKK' AND statusKeluarga='$ortu' ");
    $namaOrtu = mysqli_fetch_array($ortu);
    return $namaOrtu['nama'];
}


// datatable penduduk kk
function datatablePendudukKK($noKK)
{
    global $conn;
    // get link and th
    if (isset($_GET['detaiKK'])) {
        echo "<a href='index.php?dataKK' class='btn btn-warning btn-sm'>Data KK</a>";
        $th = "<th>Menu</th>";
    } else {
        echo "<a href='index.php?detaiKK=$noKK' class='btn btn-info btn-sm'>
        <span class='iconify' data-icon='mdi:account-arrow-right-outline'></span>
            Detail
        </a>";
        $th = "";
    }
    echo "<br><br>";
    echo '<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
        <thead>
        <tr>
            <th>Nik</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Status Dalam Keluarga</th>';
    echo $th;
    echo '</tr>
        </thead>
        <tbody>';
    $penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE noKK='$noKK' AND status!='pindah' AND status!='meninggal' ");
    while ($rowPen = mysqli_fetch_array($penduduk)) {
        // get td menu delete
        if (isset($_GET['detaiKK'])) {
            $td = "<td><a onClick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='index.php?HapusPenduduk=$rowPen[nik]&&noKK=$rowPen[noKK]' class='btn btn-danger btn-sm'><span class='iconify' data-icon='akar-icons:trash-can'></span></a></td>";
        } else {
            $td = "";
        }
        echo "<tr>
            <td>$rowPen[nik]</td>
            <td>$rowPen[nama]</td>
            <td>$rowPen[tanggalLahir]</td>
            <td>$rowPen[statusKeluarga]</td>" .
            $td . "
        </tr>";
    }
    echo '</tbody>
    </table>
    </div>';
}

// 
function dataLahiranTableLingkungan($id_lingkungan)
{
    global $conn;
}

// delete penduduk
function deletePenduduk($nik, $noKK)
{
    global $conn;
    $delete = mysqli_query($conn, "DELETE FROM tbl_penduduk WHERE nik='$nik' ");
    if ($delete) {
        $data = header("location:index.php?detaiKK=$noKK");
    } else {
        $data = header("location:index.php?location:detaiKK=$noKK");
    }
    return $data;
}

// data provinsi
function dataProvinsi($id)
{
    global $conn;
    $provinsi = mysqli_query($conn, "SELECT * FROM reg_provinces WHERE id='$id' ");
    return $provinsi;
}

// data kabupaten Table
function kabupatenTable($id)
{
    global $conn;
    $kab = mysqli_query($conn, "SELECT * FROM tbl_kab WHERE id_kab='7173' ");
    return $kab;
}

// kabupaten id
function kabupatenId($id_kab)
{
    global $conn;
    $kabupaten = mysqli_query($conn, "SELECT * FROM tbl_kab WHERE id_kab='$id_kab' ");
    $rowKab = mysqli_fetch_array($kabupaten);
    return $rowKab['kabupaten'];
}

// kabupaten edit
function dataKabEdit($id_kab)
{
    global $conn;
    $kabupaten = mysqli_query($conn, "SELECT * FROM tbl_kab WHERE id_kab='$id_kab' ");
    $rowKab = mysqli_fetch_array($kabupaten);
    echo "
    <div class='form-group'>
        <label>Kabupaten</label>
        <input type='hidden' name='id_kab' value='$id_kab'>
        <input type='text' name='kabupaten' value='$rowKab[kabupaten]' class='form-control' placeholder='Kabupaten...' required/>
    </div>";
}

// edit kab Post
function editKabPost($id_kab, $kabupaten)
{
    global $conn;
    $editKab = mysqli_query($conn, "UPDATE tbl_kab SET kabupaten='$kabupaten'
                        WHERE id_kab='$id_kab' ");
    return $editKab;
}

// edit kec Post
function editKecPost($id_kec, $kecamatan)
{
    global $conn;
    $editKec = mysqli_query($conn, "UPDATE tbl_kecamatan SET kecamatan='$kecamatan'
                                    WHERE id_kec='$id_kec' ");
    return $editKec;
}

// data kecamatan Table
function kecamatanTable()
{
    global $conn;
    $kec = mysqli_query($conn, "SELECT  * FROM tbl_kecamatan ");
    return $kec;
}

// kecamatan edit 
function dataKecEdit($id_kec)
{
    global $conn;
    $kec = mysqli_query($conn, "SELECT * FROM tbl_kecamatan WHERE id_kec='$id_kec' ");
    $rowKec = mysqli_fetch_array($kec);
    echo "<div class='form-group'>
        <label>Kecamatan</label>
        <input type='hidden' name='id_kec' value='$id_kec'>
        <input type='text' name='kecamatan' class='form-control' value='$rowKec[kecamatan]' placeholder='Kecamatan...' required/>
        </div>";
}

// data kelurahan table
function kelurahanTable()
{
    global $conn;
    $kel = mysqli_query($conn, "SELECT * FROM tbl_kelurahan ");
    return $kel;
}

// data lingkungan
function dataLingkunganTable()
{
    global $conn;
    $lingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan ");
    return $lingkungan;
}

// data lingkungan id
function dataLingkunganId($id_lingkungan)
{
    global $conn;
    $lingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan WHERE id_lingkungan='$id_lingkungan' ");
    return $lingkungan;
}

// lingkungan name 
function lingkungan($id_lingkungan)
{
    global $conn;
    $lingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan WHERE id_lingkungan='$id_lingkungan' ");
    $row = mysqli_fetch_array($lingkungan);
    return $row['lingkungan'];
}

// cek lingkungan
function cekLingkunganIdKel($id_kel, $lingkungan)
{
    global $conn;
    $cekLingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan WHERE id_kel='$id_kel' AND lingkungan='$lingkungan' ");
    return $cekLingkungan;
}

// edit ligkungan POST
function editLingkunganPost($id_lingkungan, $no_lingkungan, $lingkungan)
{
    global $conn;
    $editLing = mysqli_query($conn, "UPDATE tbl_lingkungan SET no_lingkungan='$no_lingkungan', lingkungan='$lingkungan'
                                WHERE id_lingkungan='$id_lingkungan' ");
    return $editLing;
}

// data users id
function datausersId($id_login)
{
    global $conn;
    $usersid = mysqli_query($conn, "SELECT * FROM tbl_login WHERE id_login='$id_login' ");
    return $usersid;
}

// cek user idKec idKel lingkungan
function cekUserLingkungan($id_kec, $id_kel, $id_lingkungan)
{
    global $conn;
    $cekUsersLingkungan = mysqli_query($conn, "SELECT * FROM tbl_login WHERE id_kec='$id_kec' AND id_kel='$id_kel' AND id_lingkungan='$id_lingkungan' ");
    return $cekUsersLingkungan;
}

// cek user kec
function cekUserKec($level, $id_kec)
{
    global $conn;
    $data = mysqli_query($conn, "SELECT * FROM `tbl_login` WHERE level='$level' AND id_kec='$id_kec' ");
    return $data;
}

// cek user kel 
function cekUserKel($level, $id_kel)
{
    global $conn;
    $data = mysqli_query($conn, "SELECT * FROM `tbl_login` WHERE level='$level' AND id_kel='$id_kel' ");
    return $data;
}

// edit users Post
function editUsersPost($id_login, $username, $noHp)
{
    global $conn;
    $editUsers = mysqli_query($conn, "UPDATE tbl_login SET username='$username' , noHp='$noHp'
                                WHERE id_login='$id_login' ");
    return $editUsers;
}

// data pekerjaaan 
function  dataPekerjaanTable()
{
    global $conn;
    $pek = mysqli_query($conn, "SELECT id_pekerjaan,pekerjaan FROM tbl_pekerjaan ");
    return $pek;
}

//jumlah data pekerjaan berdasarkan kategori
function jumlahDataPekerja($id_pekerjaan)
{
    global $conn;
    $data = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahPekerja FROM tbl_penduduk WHERE pekerjaan='$id_pekerjaan' ");
    $jumPekerja = mysqli_fetch_array($data);
    return $jumPekerja['jumlahPekerja'];
}

// cek jumlah pekerja berdasarkan lingkungan 
function cekJumlahPekerja($id_lingkungan, $id_pekerjaan)
{
    global $conn;
    $dataPekerja = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahPekerja FROM tbl_penduduk WHERE lingkungan='$id_lingkungan' AND pekerjaan='$id_pekerjaan' ");
    $jumPekerja = mysqli_fetch_array($dataPekerja);
    return $jumPekerja['jumlahPekerja'];
}

// jumlah penduduk berdasarkan kecamatan
function jumlahPendudukKecamatan($id_kec)
{
    global $conn;
    $dataPenKec = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahPendudukKec FROM tbl_penduduk WHERE id_kec='$id_kec' ");
    $rowPenKec = mysqli_fetch_array($dataPenKec);
    return $rowPenKec['jumlahPendudukKec'];
}

// jumlah penduduk perkecamatan
function jumlahPendudukStatusKecamatan($id_kec, $status)
{
    global $conn;
    $dataPenKec = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahPendudukKec FROM tbl_penduduk WHERE id_kec='$id_kec' AND status='$status' ");
    $rowPenKec = mysqli_fetch_array($dataPenKec);
    return $rowPenKec['jumlahPendudukKec'];
}

// jumlah penduduk pindah perkecamatan


//jumlah penduduk berdasarkan kecamatan dan jenis kelamin
function jumlahPendudukKecamatanJeniskelamin($id_kec, $jk)
{
    global $conn;
    $dataJKKec = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahJkKec FROM tbl_penduduk WHERE id_kec='$id_kec' AND jk='$jk' ");
    $jumlahJKKec = mysqli_fetch_array($dataJKKec);
    return $jumlahJKKec['jumlahJkKec'] . "/Jiwa";
}

// jumlah penduduk kelurahan
function jumlahPendudukKelurahan($id_kel)
{
    global $conn;
    $dataPendKel = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahPenKel FROM tbl_penduduk WHERE id_kel='$id_kel' ");
    $jumlahPenKel = mysqli_fetch_array($dataPendKel);
    return $jumlahPenKel['jumlahPenKel'] . "/Jiwa";
}

// jumlah penduduk kelurahan berdasarkan jenis kelamin
function jumlahPendudukKelurahanJenisKelamin($id_kel, $jk)
{
    global $conn;
    $dataJkKel = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahJkKel FROM tbl_penduduk WHERE id_kel='$id_kel' AND jk='$jk' ");
    $rowJkKel = mysqli_fetch_array($dataJkKel);
    return $rowJkKel['jumlahJkKel'] . "/Jiwa";
}

// jumlah penduduk berdasarkan lingkungan 
function jumlahPendudukLingkungan($id_lingkungan)
{
    global $conn;
    $dataPendLingkungan = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahPenduduk FROM tbl_penduduk WHERE lingkungan='$id_lingkungan' ");
    $jumlahPendLing = mysqli_fetch_array($dataPendLingkungan);
    return $jumlahPendLing['jumlahPenduduk'];
}

// jumlah jenis kelamin pada lingkungan
function jumlahJenisKelaminPadaLingkungan($id_lingkungan, $jk)
{
    global $conn;
    $priaLing = mysqli_query($conn, "SELECT COUNT(nik) AS jumlahPria FROM tbl_penduduk WHERE jk='$jk' AND lingkungan='$id_lingkungan' ");
    $jumlahPria = mysqli_fetch_array($priaLing);
    return $jumlahPria['jumlahPria'] . "/Orang";
}

// plugin css data 
function pluginCsData()
{
    $data = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">';
    echo $data;
}

// plugin js data
function pluginJsData()
{
    $data = '<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>';
    echo $data;
}
