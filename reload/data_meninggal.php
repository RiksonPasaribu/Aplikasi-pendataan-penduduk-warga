<?php
require_once "../function.php";
if ($_POST['idx']) {
    $id_penduduk = $_POST['idx'];
    meninggalPenduduk($id_penduduk);
}
