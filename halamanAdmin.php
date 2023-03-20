<?php
if ($_SESSION['level'] == "admin") {
    $menu = menuAdmin();
    // jika halaman user ambil data Wilayah
    $prov = dataProvinsi($_SESSION['id_prov']);
    $rowProv = mysqli_fetch_array($prov);
    $provinsi = $rowProv['name'];
    $kabupaten = "";
    $kecamatan = "";
    $kelurahan = "";
    $lingkungan = "";
} else {
    $menu = menuUser();
    // jika halaman user ambil data Wilayah
    $prov = dataProvinsi($_SESSION['id_prov']);
    $rowProv = mysqli_fetch_array($prov);
    // kabupaten
    $kabupaten = mysqli_query($conn, "SELECT * FROM tbl_kab WHERE id_kab='$_SESSION[id_kab]' ");
    $rowKab = mysqli_fetch_array($kabupaten);
    // kecamatan
    $kec = mysqli_query($conn, "SELECT * FROM tbl_kecamatan WHERE id_kec='$_SESSION[id_kec]' ");
    $rowKec = mysqli_fetch_array($kec);
    // kelurahan
    $kel = mysqli_query($conn, "SELECT * FROM tbl_kelurahan WHERE id_kel='$_SESSION[id_kel]' ");
    $rowKel = mysqli_fetch_array($kel);
    // lingkungan
    $lingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan WHERE id_lingkungan='$_SESSION[id_lingkungan]' ");
    $rowLingkungan = mysqli_fetch_array($lingkungan);

    // row
    $provinsi = $rowProv['name'];
    $kabupaten = $rowKab['kabupaten'];
    $kecamatan = $rowKec['kecamatan'];
    $kelurahan = $rowKel['kelurahan'];
    $id_lingkungan = $rowLingkungan['id_lingkungan'];
    $lingkungan = $rowLingkungan['no_lingkungan'];

    // session
    $_SESSION['id_kec'] = $rowKec['id_kec'];
    $_SESSION['id_kel'] = $rowKel['id_kel'];
    $_SESSION['id_lingkungan'] = $id_lingkungan;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | SIP</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="assetsAdmin/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="assetsAdmin/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="assetsAdmin/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="assetsAdmin/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="assetsAdmin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="assetsAdmin/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="assetsAdmin/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="assetsAdmin/css/themes/all-themes.css" rel="stylesheet" />

    <!-- iconify -->
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Grafik -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <form action="" method="POST">
            <input type="text" name="noKK" placeholder="Search No KK...">
        </form>
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">ADMINBSB - MATERIAL DESIGN</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->

                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <!-- #END# Tasks -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="assetsAdmin/images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?></div>
                    <div class="email"><?php echo $_SESSION['level']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i> <?php echo $provinsi; ?> </a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">bookmark</i> <?php echo $kabupaten; ?> </a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">bookmark</i> <?php echo $kecamatan; ?> </a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">bookmark</i> <?php echo $kelurahan; ?> </a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">bookmark</i> <?php echo $lingkungan; ?> </a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <?php echo $menu; ?>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php
            if (isset($_GET['wilayah'])) {
                include_once "pagesAdmin/wilayah.php";
            } else
            if (isset($_GET['kecamatan'])) {
                include_once "pagesAdmin/kecamatan.php";
            } else
            if (isset($_GET['kelurahan'])) {
                include_once "pagesAdmin/kelurahan.php";
            } else
            if (isset($_GET['lingkungan'])) {
                include_once "pagesAdmin/lingkungan.php";
            } else
            if (isset($_GET['pendudukAdmin'])) {
                include_once "pagesAdmin/pendudukAdmin.php";
            } else
            if (isset($_GET['agama'])) {
                include_once "pagesAdmin/agama.php";
            } else
            if (isset($_GET['pendidikan'])) {
                include_once "pagesAdmin/pendidikan.php";
            } else
            if (isset($_GET['pekerjaan'])) {
                include_once "pagesAdmin/pekerjaan.php";
            } else
            if (isset($_GET['umur'])) {
                include_once "pagesAdmin/umur.php";
            } else
            if (isset($_GET['kepalaKeluarga'])) {
                include_once "pagesAdmin/kepalaKeluarga.php";
            } else
            if (isset($_GET['pekerjaanPerlingkungan'])) {
                include_once "pagesAdmin/pekerjaanPerlingkungan.php";
            } else
            if (isset($_GET['agamaPerlingkungan'])) {
                include_once "pagesAdmin/agamaPerlingkungan.php";
            } else
            if (isset($_GET['pendidikanPerlingkungan'])) {
                include_once "pagesAdmin/pendidikanPerlingkungan.php";
            } else
            if (isset($_GET['users'])) {
                include_once "pagesAdmin/users.php";
            } else
            if (isset($_GET['pendudukUser'])) {
                include_once "pagesUser/pendudukUser.php";
            } else
            if (isset($_GET['dataKK'])) {
                include_once "pagesUser/dataKK.php";
            } else
            if (isset($_GET['pendudukLahir'])) {
                include_once "pagesUser/pendudukLahir.php";
            } else
            if (isset($_GET['pendudukPindah'])) {
                include_once "pagesUser/pendudukPindah.php";
            } else 
            if (isset($_GET['pendudukPendatang'])) {
                include_once "pagesUser/pendudukPendatang.php";
            } else
            if (isset($_GET['pendudukMeninggal'])) {
                include_once "pagesUser/pendudukMeninggal.php";
            } else
            if (isset($_GET['detaiKK'])) {
                $noKK = $_GET['detaiKK'];
                include_once "pagesUser/detaiKK.php";
            } else
            if (isset($_GET['HapusPenduduk']) && ($_GET['noKK'])) {
                $nik = $_GET['HapusPenduduk'];
                $noKK = $_GET['noKK'];
                deletePenduduk($nik, $noKK);
            } else
            if (isset($_GET['OlahData'])) {
                include_once "pagesUser/OlahData.php";
            } else {
                if ($_SESSION['level'] == "admin") {
                    include_once "pagesAdmin/home.php";
                } else {
                    include_once "pagesUser/home.php";
                }
            }
            ?>

            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">

            </script>
            <script src="assetsAdmin/plugins/jquery/jquery.min.js">
            </script>

            <!-- Bootstrap Core Js -->
            <script src="assetsAdmin/plugins/bootstrap/js/bootstrap.js"></script>

            <!-- Select Plugin Js -->
            <script src="assetsAdmin/plugins/bootstrap-select/js/bootstrap-select.js"></script>

            <!-- Slimscroll Plugin Js -->
            <script src="assetsAdmin/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

            <!-- Waves Effect Plugin Js -->
            <script src="assetsAdmin/plugins/node-waves/waves.js"></script>

            <!-- Jquery CountTo Plugin Js -->
            <script src="assetsAdmin/plugins/jquery-countto/jquery.countTo.js"></script>

            <!-- Morris Plugin Js -->
            <script src="assetsAdmin/plugins/raphael/raphael.min.js"></script>
            <script src="assetsAdmin/plugins/morrisjs/morris.js"></script>

            <!-- ChartJs -->
            <script src="assetsAdmin/plugins/chartjs/Chart.bundle.js"></script>

            <!-- Flot Charts Plugin Js -->
            <script src="assetsAdmin/plugins/flot-charts/jquery.flot.js"></script>
            <script src="assetsAdmin/plugins/flot-charts/jquery.flot.resize.js"></script>
            <script src="assetsAdmin/plugins/flot-charts/jquery.flot.pie.js"></script>
            <script src="assetsAdmin/plugins/flot-charts/jquery.flot.categories.js"></script>
            <script src="assetsAdmin/plugins/flot-charts/jquery.flot.time.js"></script>

            <!-- Sparkline Chart Plugin Js -->
            <script src="assetsAdmin/plugins/jquery-sparkline/jquery.sparkline.js"></script>

            <!-- Jquery DataTable Plugin Js -->
            <script src="assetsAdmin/plugins/jquery-datatable/jquery.dataTables.js"></script>
            <script src="assetsAdmin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
            <script src="assetsAdmin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
            <script src="assetsAdmin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
            <script src="assetsAdmin/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
            <script src="assetsAdmin/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
            <script src="assetsAdmin/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
            <script src="assetsAdmin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
            <script src="assetsAdmin/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

            <!-- Custom Js -->
            <script src="assetsAdmin/js/pages/tables/jquery-datatable.js"></script>

            <!-- Custom Js -->
            <script src="assetsAdmin/js/admin.js"></script>
            <script src="assetsAdmin/js/pages/index.js"></script>
            <script src="assetsAdmin/js/pages/forms/basic-form-elements.js"></script>
            <!-- Select Plugin Js -->
            <script src="assetsAdmin/plugins/bootstrap-select/js/bootstrap-select.js"></script>

            <!-- Demo Js -->
            <script src="assetsAdmin/js/demo.js"></script>

            <script>
                // get kelurahan
                function showCustomer(str) {
                    if (str == "") {
                        document.getElementById("txtHint").innerHTML = "";
                        return;
                    }
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                    xhttp.open("GET", "getKel.php?id_kec=" + str);
                    xhttp.send();
                }
                // end

                // get kelurahan
                function showCustomerKec(str) {
                    if (str == "") {
                        document.getElementById("txtHintKec").innerHTML = "";
                        return;
                    }
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        document.getElementById("txtHintKec").innerHTML = this.responseText;
                    }
                    xhttp.open("GET", "getKelKec.php?id_kec=" + str);
                    xhttp.send();
                }
                // end


                // get lingkungan
                function showLing(str) {
                    if (str == "") {
                        document.getElementById("dataLingkungan").innerHTML = "";
                        return;
                    }
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        document.getElementById("dataLingkungan").innerHTML = this.responseText;
                    }
                    xhttp.open("GET", "getLing.php?id_kel=" + str);
                    xhttp.send();
                }

                // chart penduduk perkecamatan js dan status penduduk
                var ctx = document.getElementById('myChartKec').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    $kec = kecamatanTable();
                                    while ($row = mysqli_fetch_array($kec)) {
                                        echo '"' . $row['kecamatan'] . '",';
                                    }
                                    ?>],
                        datasets: [{
                            label: 'Vote Penduduk Kecamatan',
                            data: [
                                <?php
                                $kec = kecamatanTable();
                                while ($row = mysqli_fetch_array($kec)) {
                                    if (isset($_GET['status'])) {
                                        $status = $_GET['status'];
                                        $jumlah = jumlahPendudukStatusKecamatan($row['id_kec'], $status);
                                    } else {
                                        $jumlah = jumlahPendudukKecamatan($row['id_kec']);
                                    }
                                    echo $jumlah . ', ';
                                }
                                ?>
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // chart usia
                var ctx = document.getElementById('myChartUsia').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php
                                    $data = kelompokUmur();
                                    while ($row = mysqli_fetch_array($data)) {
                                        $strataUsia = $row['dari'] . "-" . $row['sampai'];
                                        echo '"' . $strataUsia . '",';
                                    }
                                    ?>],
                        datasets: [{
                            label: 'Vote Penduduk ',
                            data: [<?php
                                    $data = kelompokUmur();
                                    while ($row = mysqli_fetch_array($data)) {
                                        $dari = $row['dari'];
                                        $sampai = $row['sampai'];
                                        $jumlah = jumlahUsiaRataRata($dari, $sampai);
                                        echo $jumlah . ', ';
                                    }
                                    ?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

</body>

</html>