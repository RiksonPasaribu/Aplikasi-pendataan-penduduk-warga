<?php
require_once "../function.php";
if ($_POST['idx']) {
    $id_kec = $_POST['idx'];
    dataKecEdit($id_kec);
}
