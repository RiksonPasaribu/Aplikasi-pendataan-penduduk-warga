<?php
require_once "../function.php";
if ($_POST['idx']) {
    $nik = $_POST['idx'];
?>
    <div class="row clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">NIK</label>
                <input type="number" name="nik" value="<?php echo $nik; ?>" class="form-control" placeholder="Nik.." required />
            </div>
            <div class="form-group">
                <label for="">NAMA</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama.." required />
            </div>
            <div class="form-group">
                <label for="">Tempat Lahir</label>
                <input type="text" name="tempatLahir" class="form-control" placeholder="tempat Lahir...">
            </div>
            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="date" name="tanggalLahir" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control show-tick">
                    <?php
                    $jk = array('pria', 'wanita');
                    foreach ($jk as $j) {
                        echo "<option value='$j'>$j</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Status Kawin</label>
                <select name="statusKawin" id="statusKawin" class="form-control show-tick">
                    <?php
                    $statusKawin = array('Belum Menikah', 'Menikah');
                    foreach ($statusKawin as $sk) {
                        echo "<option value='$sk'>$sk</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Pekerjaan</label>
                <select name="pekerjaan" id="" class="form-control show-tick">
                    <?php
                    $pekerjaan = dataPekerjaanKeseluruhan();
                    while ($rowPk = mysqli_fetch_array($pekerjaan)) {
                        echo "<option value='$rowPk[id_pekerjaan]'>$rowPk[pekerjaan]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Pendidikan</label>
                <select name="pendidikan" id="pendidikan" class="form-control show-tick">
                    <?php
                    $pendidikan = dataPendidikan();
                    foreach ($pendidikan as $pen) {
                        echo "<option value='$pen'>$pen</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Status Penduduk </label>
                <select name="status" id="status" class="form-control">
                    <?php
                    $statusPenduduk = statusPendatang();
                    foreach ($statusPenduduk as $sp) {
                        echo "<option value='$sp'>$sp</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Asal</label>
                <textarea name="asal" id="" cols="" rows="" class="form-control" placeholder="Asal Tinggal...."></textarea>
            </div>
            <div class="form-group">
                <label for="">Tanggal Datang</label>
                <input type="date" name="tanggalDatang" class="form-control" required />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">No KK</label>
                <input type="number" name="noKK" value="<?php echo $rowPenduduk['noKK']; ?>" class="form-control" placeholder="No KK..." required />
            </div>
            <div class="form-group">
                <label for="">Status Dalam Keluarga</label>
                <select name="statusKeluarga" id="statusKeluarga" class="form-control" required>
                    <?php statusKeluargaOption(); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Provinsi</label>
                <select name="id_prov" id="provinsi" class="form-control show-tick">
                    <?php
                    $prov = mysqli_query($conn, "SELECT * FROM reg_provinces WHERE id='71' ");
                    $rowProv = mysqli_fetch_array($prov);
                    echo "<option value='$rowProv[id]'>$rowProv[name]</option>";
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Kabupaten</label>
                <select name="id_kab" id="kabupaten" class="form-control show-tick">
                    <?php
                    $kabupaten = mysqli_query($conn, "SELECT * FROM tbl_kab WHERE id_prov='$rowProv[id]' AND id_kab='7173' ");
                    while ($rowKab = mysqli_fetch_array($kabupaten)) {
                        echo "<option value='$rowKab[id_kab]'>$rowKab[kabupaten]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Kecamatan</label>
                <select name="id_kec" id="id_kec" class="form-control show-tick">
                    <?php
                    dataKecamatanOption($_SESSION['id_kec']);
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">kelurahan</label>
                <select name="id_kel" id="id_kel" class="form-control show-stick">
                    <?php
                    dataKelurahanOption($_SESSION['id_kel']);
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Lingkungan</label>
                <select name="id_lingkungan" id="id_lingkungan" class="form-control show-stick">
                    <?php
                    dataLingkungan($_SESSION['id_lingkungan']);
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Negara</label>
                <input type="text" name="negara" value="indonesia" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Agama</label>
                <select name="agama" id="agama">
                    <?php
                    $agama = array('Islam', 'Kristen', 'Hindu', 'Budha');
                    foreach ($agama as $ag) {
                        echo "<option value='$ag'>$ag</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Negara</label>
                <select name="negara" id="negara" class="form-control show-tick">
                    <?php
                    $negara = array('WNI', 'WNA');
                    foreach ($negara as $neg) {
                        echo "<option value='$neg'>$neg</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
<?php
}
?>