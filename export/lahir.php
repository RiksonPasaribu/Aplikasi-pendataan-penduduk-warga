<?php
require_once "../function.php";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=excell.xls");
?>
<center>
    <h3>Data Penduduk Lahiran Keseluruhan</h3>
</center>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Nik</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Usia</th>
            <th>Ayah</th>
            <th>Ibu</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE status='lahiran' ");
        while ($rowLahiran = mysqli_fetch_array($data)) {
            $noKK = $rowLahiran['noKK'];
            echo "<tr>
                        <td>$rowLahiran[nik]</td>
                                    <td>$rowLahiran[nama]</td>
                                    <td>$rowLahiran[tanggalLahir]</td>" .
                "<td>" . cekUsia($rowLahiran['tanggalLahir']) . "</td>" .
                "<td>" . cekOrtu($noKK, "Kepala Keluarga") . "</td>" .
                "<td>" . cekOrtu($noKK, "Istri") . "</td>
                                </tr>";
        }
        ?>
    </tbody>
</table>