<?php
require_once "../function.php";
if ($_POST['idx']) {
    $id_kab = $_POST['idx'];
    dataKabEdit($id_kab);
}
