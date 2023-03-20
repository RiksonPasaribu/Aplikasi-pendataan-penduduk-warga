<?php
require_once "../function.php";
?>

<?php pluginCsData(); ?>
<center>
    <h3>Data Penduduk meninggal Keseluruhan</h3>
</center>
<div class="container-fluid">
    <a href="../export/meninggal.php" target="_blank" class="btn btn-success btn-sm">Export</a>
    <br><br>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tempat / Tanggak Lahir</th>
                    <th>Usia</th>
                    <th>Tanggal Meninggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = dataTable("tbl_meninggal");
                while ($row = mysqli_fetch_array($data)) {
                    echo '<tr>
                    <td>' . $row['nik'] . '</td>
                    <td>' . dataPendudukList($row['nik'], "nama") . '</td>
                    <td>' . dataPendudukList($row['nik'], "tempatLahir") . '.' . dataPendudukList($row['nik'], "tanggalLahir") . '</td>
                    <td>' . dataPendudukList($row['nik'], "usia") . '</td>
                    <td>' . $row['tanggalMeninggal'] . '</td>
                </tr>';
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