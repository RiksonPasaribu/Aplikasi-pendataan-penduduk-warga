<?php
require_once "../function.php";
if ($_POST['idx']) {
    $id_umur = $_POST['idx'];
    tampilkanPendudukBerdasarkanUmur($id_umur);
}
