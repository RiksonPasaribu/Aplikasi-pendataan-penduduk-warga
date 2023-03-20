<?php
include_once "modal/modalPekerjaan.php";
if (isset($_POST['inputPekerjaan'])) {
    $pekerjaan = $_POST['pekerjaan'];
    // cek
    $cekPekerjaan = mysqli_query($conn, "SELECT * FROM tbl_pekerjaan WHERE pekerjaan='$pekerjaan' ");
    if (mysqli_num_rows($cekPekerjaan) > 0) {
        $pesan = "<div class='alert alert-danger alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Maaf Data Pekerjaan </strong> Sudah Ada.
        </div>";
    } else {
        $inputPek = mysqli_query($conn, "INSERT INTO tbl_pekerjaan (pekerjaan)
                            VALUES('$pekerjaan') ");
        if ($inputPek) {
            $pesan = '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Berhasil </strong> Menambah Kan Data.
        </div>';
        } else {
            $pesan = '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Gagal </strong> Input Data.
        </div>';
        }
    }
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                   <b> Data Pekerjaan </b>
                </h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalPekerjaan">
                    Tambah Pekerjaan
                </button>

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
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pekerjaan = dataPekerjaanTable();
                                while ($rowPk = mysqli_fetch_array($pekerjaan)) {
                                    $id_pekerjaan = $rowPk['id_pekerjaan'];
                                    if (isset($_POST['id_lingkungan'])) {
                                        $id_lingkungan  = $_POST['id_lingkungan'];
                                        $dataPekerjaan = hitungPekerjaanPerlingkungan($id_pekerjaan, $id_lingkungan);
                                    } else {
                                        $dataPekerjaan = hitungPekerjaan($id_pekerjaan);
                                    }
                                    echo "<tr>
                                    <td>$rowPk[pekerjaan]</td>
                                    <td>$dataPekerjaan</td>
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