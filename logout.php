<?php
session_start();
session_destroy();
include_once"koneksi.php";
header('location: index.php');
?>