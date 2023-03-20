<?php
require_once "../function.php";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=excell.xls");
?>
<center>
    <h3>Data Penduduk Pindah Keseluruhan</h3>
</center>

<table border="1" cellpadding="5">
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