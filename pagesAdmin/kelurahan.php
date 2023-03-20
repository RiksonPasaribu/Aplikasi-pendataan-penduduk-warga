<?php
include_once "modal/inputKel.php";
if (isset($_POST['inputKel'])) {
    $id_kec = $_POST['id_kec'];
    $kelurahan  = $_POST['kelurahan'];
    // cek kelurahan 
    $cekKel = mysqli_query($conn, "SELECT * FROM tbl_kelurahan WHERE id_kec='$id_kec' AND kelurahan='$kelurahan' ");
    if (mysqli_num_rows($cekKel) > 0) {
        $pesan = "<div class='alert alert-danger alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <strong>Maaf Data Kelurahan </strong> $kelurahan Sudah Ada.
                </div>";
    } else {
        $inputKel = mysqli_query($conn, "INSERT INTO tbl_kelurahan (id_kec,kelurahan) 
                    VALUES('$id_kec','$kelurahan')");

        if ($inputKel) {
            $pesan = pesanBerhasil();
        } else {
            $pesan = pesanGagal();
        }
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
                    Data Kelurahan
                </h2>
                <?php
                if (!empty($pesan)) {
                    echo $pesan;
                }
                ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalKel">
                    Input Kelurahan / Desa
                </button>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan / Desa</th>
                                    <th>Jumlah Penduduk</th>
                                    <th>Pria</th>
                                    <th>Wanita</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $kel = kelurahanTable();
                                $no = 1;
                                while ($rowKel = mysqli_fetch_array($kel)) {
                                    echo "<tr>
                                        <td>$no</td>" .
                                        "<td>" . kecamatan($rowKel['id_kec']) . "</td>" .
                                        "<td>$rowKel[kelurahan]</td>" .
                                        "<td>" . jumlahPendudukKelurahan($rowKel['id_kel']) . "</td>" .
                                        "<td>" . jumlahPendudukKelurahanJenisKelamin($rowKel['id_kel'], 'pria') . "</td>" .
                                        "<td>" . jumlahPendudukKelurahanJenisKelamin($rowKel['id_kel'], 'wanita') . "</td>
                                        <td>
                                        <a class='btn btn-success' title='Edit' href='#editKel' data-toggle='modal' data-id='$rowKel[id_kel]'><span class='iconify' data-icon='cil:zoom-in' data-inline='false'></span></a>
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