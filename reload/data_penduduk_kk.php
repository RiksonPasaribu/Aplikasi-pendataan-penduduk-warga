<?php
require_once "../function.php";
if ($_POST['idx']) {
    $noKK = $_POST['idx'];
    $dataTablePendudukKK = datatablePendudukKK($noKK);
}
