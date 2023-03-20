<?php
require_once "../function.php";
?>

<?php pluginCsData(); ?>

<center>
    <h3>Data Penduduk Pindah Keseluruhan</h3>
</center>

<div class="container-fluid">
    <a href="../export/pindah.php" target="_blank" class="btn btn-success btn-sm">Export</a>
    <br><br>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tempat / Tanggak Lahir</th>
                    <th>Usia</th>
                    <th>Pindah Ke</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pendudukPindah = mysqli_query($conn, "SELECT * FROM `tbl_pindah` ");
                while ($rowPen = mysqli_fetch_array($pendudukPindah)) {
                    //  pindah ke
                    $pindahKe = pindahKe($rowPen['nik']);
                    echo "<tr>
                        <td>$rowPen[nik]</td>
                        <td>" . dataPendudukList($rowPen['nik'], "nama") . "</td>
                        <td>" . dataPendudukList($rowPen['nik'], "tempatLahir") . "." . dataPendudukList($rowPen['nik'], "tanggalLahir") . "</td>
                        <td>" . dataPendudukList($rowPen['nik'], "usia") . "</td>
                        <td>$pindahKe</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php pluginJsData(); ?>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>