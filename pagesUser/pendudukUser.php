       <?php
        include_once "modal/inputPenduduk.php";
        include_once "modal/editPenduduk.php";
        if (isset($_POST['inputPenduduk'])) {
            $nik    = $_POST['nik'];
            $nama   = $_POST['nama'];
            $tempatLahir    = $_POST['tempatLahir'];
            $tanggalLahir   = $_POST['tanggalLahir'];
            $jk             = $_POST['jk'];
            $statusKawin    = $_POST['statusKawin'];
            $pekerjaan      = $_POST['pekerjaan'];
            $pendidikan     = $_POST['pendidikan'];
            $agama          = $_POST['agama'];
            $lingkungan     = $_POST['id_lingkungan'];
            $id_kel         = $_POST['id_kel'];
            $id_kec         = $_POST['id_kec'];
            $id_kab         = $_POST['id_kab'];
            $id_prov        = $_POST['id_prov'];
            $negara         = $_POST['negara'];
            $status         = $_POST['status'];
            $usia = cekUsia($tanggalLahir);
            $noKK           = $_POST['noKK'];
            $statusKeluarga = $_POST['statusKeluarga'];
            // cek nik
            $cekNik = cekNik($nik);
            // gunakan in_array untuk mengecek 2 string
            if (in_array($statusKeluarga, ["Kepala Keluarga", "Istri"])) {
                $cekStatusKeluarga = cekStatusKeluarga($noKK, $statusKeluarga);
                if (mysqli_num_rows($cekStatusKeluarga) > 0) {
                    $pesan = pesanKepalaKeluarga($noKK, $statusKeluarga);
                } else {
                    $inputPenduduk = mysqli_query($conn, "INSERT INTO tbl_penduduk (nik,nama,tempatLahir,tanggalLahir,jk,statusKawin,pekerjaan,pendidikan,agama,lingkungan,id_kel,id_kec,id_kab,id_prov,negara,status,usia,noKK,statusKeluarga)
                                        VALUES('$nik','$nama','$tempatLahir','$tanggalLahir','$jk','$statusKawin','$pekerjaan','$pendidikan','$agama','$lingkungan','$id_kel','$id_kec','$id_kab','$id_prov','$negara','$status','$usia','$noKK','$statusKeluarga')");
                    if ($inputPenduduk) {
                        $pesan = pesanBerhasil();
                    } else {
                        $pesan = pesanGagal();
                    }
                }
            } else {
                if (mysqli_num_rows($cekNik) > 0) {
                    $pesan = pesanDuplikatNik($nik);
                } else {
                    $inputPenduduk = mysqli_query($conn, "INSERT INTO tbl_penduduk (nik,nama,tempatLahir,tanggalLahir,jk,statusKawin,pekerjaan,pendidikan,agama,lingkungan,id_kel,id_kec,id_kab,id_prov,negara,status,usia,noKK,statusKeluarga)
                                                VALUES('$nik','$nama','$tempatLahir','$tanggalLahir','$jk','$statusKawin','$pekerjaan','$pendidikan','$agama','$lingkungan','$id_kel','$id_kec','$id_kab','$id_prov','$negara','$status','$usia','$noKK','$statusKeluarga')");
                    if ($inputPenduduk) {
                        $pesan = pesanBerhasil();
                    } else {
                        $pesan = pesanGagal();
                    }
                }
            }
        } else
        if (isset($_POST['editPenduduk'])) {
            $id_penduduk = $_POST['id_penduduk'];
            $nik    = $_POST['nik'];
            $nama   = $_POST['nama'];
            $tempatLahir    = $_POST['tempatLahir'];
            $tanggalLahir   = $_POST['tanggalLahir'];
            $jk             = $_POST['jk'];
            $statusKawin    = $_POST['statusKawin'];
            $pekerjaan      = $_POST['pekerjaan'];
            $pendidikan     = $_POST['pendidikan'];
            $agama          = $_POST['agama'];
            $lingkungan     = $_POST['id_lingkungan'];
            $id_kel         = $_POST['id_kel'];
            $id_kec         = $_POST['id_kec'];
            $id_kab         = $_POST['id_kab'];
            $id_prov        = $_POST['id_prov'];
            $negara         = $_POST['negara'];
            $status         = "tetap";
            $usia = cekUsia($tanggalLahir);
            $noKK           = $_POST['noKK'];
            $statusKeluarga = $_POST['statusKeluarga'];
            $editPen = mysqli_query($conn, "UPDATE tbl_penduduk SET nik='$nik', nama='$nama', tanggalLahir='$tanggalLahir', tempatLahir='$tempatLahir', agama='$agama', usia='$usia', noKK='$noKK', statusKeluarga='$statusKeluarga'
                                    WHERE id_penduduk='$id_penduduk'");
            if ($editPen) {
                $pesan = pesanEditBerhasil();
            } else {
                $pesan = pesanGagal();
            }
        } else {
            $pesan = "";
        }
        ?>
       <!-- #END# Basic Examples -->
       <!-- Exportable Table -->
       <div class="row clearfix">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="card">
                   <div class="header">
                       <h2>
                           Data Penduduk
                       </h2>
                       <?php
                        if (!empty($pesan)) {
                            echo $pesan;
                        }
                        if (in_array($_SESSION['level'], ["kecamatan", "kelurahan"])) {
                            $button = '';
                        } else {
                            $button = ' <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalPenduduk">
                                Input Data Penduduk
                            </button>';
                        }
                        echo $button;
                        ?>

                       <?php echo menuHeaderPenduduk(); ?>
                   </div>
                   <div class="body">
                       <div class="table-responsive">
                           <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                               <thead>
                                   <tr>
                                       <th>NIK</th>
                                       <th>Nama</th>
                                       <th>Tempat/T. Lahir</th>
                                       <th>Usia</th>
                                       <th>Pekerjaan</th>
                                       <th>Lingkungan</th>
                                       <th>Kelurahan</th>
                                       <th>Status Keluarga</th>
                                       <th>No KK</th>
                                       <th>Status</th>
                                       <th>Aksi</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php
                                    if ($_SESSION['level'] == "kecamatan") {
                                        $penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE id_kec='$_SESSION[id_kec]' AND status!='pindah' AND status!='meninggal' ");
                                    } else 
                                    if ($_SESSION['level'] == "kelurahan") {
                                        $penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE id_kel='$_SESSION[id_kel]' AND status!='pindah' AND status!='meninggal' ");
                                    } else {
                                        $penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE lingkungan='$id_lingkungan' AND status!='pindah' AND status!='meninggal' ");
                                    }
                                    while ($rowPenduduk = mysqli_fetch_array($penduduk)) {
                                        $id_penduduk = $rowPenduduk['id_penduduk'];
                                        // pekerjaan 
                                        $pekerjaan = mysqli_query($conn, "SELECT * FROM tbl_pekerjaan WHERE id_pekerjaan ='$rowPenduduk[pekerjaan]' ");
                                        $rowPekerjaan = mysqli_fetch_array($pekerjaan);
                                        // lingkungan
                                        $lingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan WHERE id_lingkungan='$rowPenduduk[lingkungan]' ");
                                        $rowLingkungan = mysqli_fetch_array($lingkungan);
                                        // kelurahan
                                        $kel = mysqli_query($conn, "SELECT * FROM tbl_kelurahan WHERE id_kel='$rowPenduduk[id_kel]' ");
                                        $rowKel = mysqli_fetch_array($kel);
                                        $tanggalLahir = $rowPenduduk['tanggalLahir'];
                                        echo "<tr>
                                            <td>$rowPenduduk[nik]</td>
                                            <td>$rowPenduduk[nama]</td>
                                            <td>$rowPenduduk[tempatLahir] / $rowPenduduk[tanggalLahir]</td>" .
                                            "<td>" . cekUsia($tanggalLahir) . "/Tahun" . "</td>" .
                                            "<td>$rowPekerjaan[pekerjaan]</td>
                                            <td>$rowLingkungan[lingkungan]</td>
                                            <td>$rowKel[kelurahan]</td>
                                            <td>$rowPenduduk[statusKeluarga]</td>
                                            <td>$rowPenduduk[noKK]</td>
                                            <td>$rowPenduduk[status]</td>
                                            <td>
                                            <a class='btn btn-success' title='Edit' href='#editPenduduk' data-toggle='modal' data-id='$id_penduduk'><span class='iconify' data-icon='carbon:zoom-in' data-inline='false'></span></a>
                                            </td>
                                        </tr>";
                                    }
                                    ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- #END# Exportable Table -->

       <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
       <script src="js/editPenduduk.js"></script>