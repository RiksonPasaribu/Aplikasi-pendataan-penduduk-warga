<?php
include_once "modal/inputUsers.php";
include_once "modal/inputUsersKec.php";
include_once "modal/inputUsersKel.php";
include_once "modal/editUsers.php";
if (isset($_POST['inputUser'])) {
    $username   = $_POST['username'];
    $password = md5($_POST['username']);
    $id_prov    = $_POST['id_prov'];
    $id_kab         = $_POST['id_kab'];
    $id_kec         = $_POST['id_kec'];
    $id_kel         = $_POST['id_kel'];
    $id_lingkungan = $_POST['id_lingkungan'];
    $nohp           = $_POST['noHp'];
    // cek users 
    $cekUsers = cekUserLingkungan($id_kec, $id_kel, $id_lingkungan);
    if (mysqli_num_rows($cekUsers) > 0) {
        $pesan = pesanDuplikat();
    } else {
        $inputUsers = mysqli_query($conn, "INSERT INTO tbl_login (username,password,level,id_prov,id_kab,id_kec,id_kel,id_lingkungan,noHp) 
                            VALUES('$username','$password','user','$id_prov','$id_kab','$id_kec','$id_kel','$id_lingkungan','$nohp')");
        if ($inputUsers) {
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanGagal();
        }
    }
} else
if (isset($_POST['inputUserKec'])) {
    $username   = $_POST['username'];
    $password = md5($_POST['password']);
    $nohp           = $_POST['noHp'];
    $level     = "kecamatan";
    $id_prov    = $_POST['id_prov'];
    $id_kab         = $_POST['id_kab'];
    $id_kec         = $_POST['id_kec'];

    // cek akun kecamatan 
    $cekUserKec = cekUserKec($level, $id_kec);
    if (mysqli_num_rows($cekUserKec) > 0) {
        $pesan = pesanDuplikat();
    } else {
        $input = mysqli_query($conn, "INSERT INTO `tbl_login`(`username`, `password`, `level`, `id_prov`, `id_kab`, `id_kec`, `id_kel`, `id_lingkungan`, `noHp`)
                                            VALUES ('$username','$password','$level','$id_prov','$id_kab','$id_kec','','','$nohp')");
        if ($input) {
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanGagal();
        }
    }
} else
if (isset($_POST['inputUserKel'])) {
    $username   = $_POST['username'];
    $password = md5($_POST['password']);
    $nohp           = $_POST['noHp'];
    $level     = "kelurahan";
    $id_prov    = $_POST['id_prov'];
    $id_kab         = $_POST['id_kab'];
    $id_kec         = $_POST['id_kec'];
    $id_kel         = $_POST['id_kel'];
    // cek akun kelurahan
    $cek = cekUserKel($level, $id_kel);
    if (mysqli_num_rows($cek) > 0) {
        $pesan = pesanDuplikat();
    } else {
        $input = mysqli_query($conn, "INSERT INTO `tbl_login`(`username`, `password`, `level`, `id_prov`, `id_kab`, `id_kec`, `id_kel`, `id_lingkungan`, `noHp`)
                        VALUES ('$username','$password','$level','$id_prov','$id_kab','$id_kec','$id_kel','','$nohp')");
        if ($input) {
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanGagal();
        }
    }
} else
if (isset($_POST['editUsers'])) {
    $id_login = $_POST['id_login'];
    $username   = $_POST['username'];
    $noHp           = $_POST['noHp'];
    $editUsers = editUsersPost($id_login, $username, $noHp);
    if ($editUsers) {
        $pesan = pesanEditBerhasil();
    } else {
        $pesan = pesanGagal();
    }
} else {
}
?>
<!-- #END# Basic Examples -->
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data User
                </h2>
                <?php
                if (!empty($pesan)) {
                    echo $pesan;
                }
                ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalUsers">
                    Input Data Users Kepala Lingkungan 
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalUsersKec">
                    Input Data Users Kecamatan
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalUsersKel">
                    Input Data Users Kelurahan
                </button>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Level Akses</th>
                                <th>Provinsi</th>
                                <th>Kabupaten</th>
                                <th>Kecamatan</th>
                                <th>kelurahan</th>
                                <th>Lingkungan</th>
                                <th>No Hp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users = mysqli_query($conn, "SELECT * FROM tbl_login WHERE level!='admin' ");
                            $no = 1;
                            while ($rowUsers = mysqli_fetch_array($users)) {
                                // provinsi
                                $prov = mysqli_query($conn, "SELECT * FROM reg_provinces WHERE id='$rowUsers[id_prov]' ");
                                $rowProv = mysqli_fetch_array($prov);
                                // kabupaten
                                $kabupaten = mysqli_query($conn, "SELECT * FROM tbl_kab WHERE id_kab='$rowUsers[id_kab]' ");
                                $rowKab = mysqli_fetch_array($kabupaten);
                                // kecamtan
                                $kec = mysqli_query($conn, "SELECT  * FROM tbl_kecamatan WHERE id_kec='$rowUsers[id_kec]' ");
                                $rowKec = mysqli_fetch_array($kec);
                                $kel = mysqli_query($conn, "SELECT * FROM tbl_kelurahan WHERE id_kel='$rowUsers[id_kel]' ");
                                $rowKel = mysqli_fetch_array($kel);
                                $lingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan WHERE id_lingkungan='$rowUsers[id_lingkungan]' ");
                                $rowLingkungan = mysqli_fetch_array($lingkungan);
                                echo "<tr>
                                    <td>$no</td>
                                    <td>$rowUsers[username]</td>
                                    <td>$rowUsers[level]</td>
                                    <td>$rowProv[name]</td>
                                    <td>$rowKab[kabupaten]</td>
                                    <td>$rowKec[kecamatan]</td>
                                    <td>$rowKel[kelurahan]</td>
                                    <td>$rowLingkungan[lingkungan]</td>
                                    <td>$rowUsers[noHp]</td>
                                    <td>
                                    <a class='btn btn-success' title='Edit' href='#editUsers' data-toggle='modal' data-id='$rowUsers[id_login]'><span class='iconify' data-icon='cil:zoom-in' data-inline='false'></span></a>
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
<!-- #END# Exportable Table -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="js/editUsers.js"></script>