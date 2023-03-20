<?php
require_once "function.php";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cekLogin = mysqli_query($conn, "SELECT * FROM tbl_login WHERE username='$username' AND password='$password' ");
    if (mysqli_num_rows($cekLogin) > 0) {
        $dataLogin = mysqli_fetch_array($cekLogin);
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $dataLogin['level'];
        $_SESSION['id_prov'] = $dataLogin['id_prov'];
        $_SESSION['id_kab']     = $dataLogin['id_kab'];
        $_SESSION['id_kec']     = $dataLogin['id_kec'];
        $_SESSION['id_kel']    = $dataLogin['id_kel'];
        $_SESSION['id_lingkungan'] = $dataLogin['id_lingkungan'];
    } else {
        echo "Maaf Username dan Password anda Salah ";
    }
}
// end isset login
if (!empty($_SESSION['username'])) {
    include_once "halamanAdmin.php";
} else {
    include_once "dashboard.php";
}
