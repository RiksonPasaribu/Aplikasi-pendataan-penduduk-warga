<?php
require_once "../function.php";
if ($_POST['idx']) {
    $id_penduduk = $_POST['idx'];
    $penduduk = mysqli_query($conn, "SELECT * FROM tbl_penduduk WHERE id_penduduk='$id_penduduk' ");
    $rowPenduduk = mysqli_fetch_array($penduduk);
    $id_kel     = $rowPenduduk['id_kel'];
    $id_kec     = $rowPenduduk['id_kec'];
    $id_lingkungan = $rowPenduduk['lingkungan'];
?>
    <input type="hidden" name="id_penduduk" value="<?php echo $id_penduduk; ?>">
    <div class="row clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">NIK</label>
                <input type="number" name="nik" value="<?php echo $rowPenduduk['nik']; ?>" class="form-control" placeholder="Nik.." required />
            </div>
            <div class="form-group">
                <label for="">NAMA</label>
                <input type="text" name="nama" value="<?php echo $rowPenduduk['nama']; ?>" class="form-control" placeholder="Nama.." required />
            </div>
            <div class="form-group">
                <label for="">Tempat Lahir</label>
                <input type="text" name="tempatLahir" value="<?php echo $rowPenduduk['tempatLahir']; ?>" class="form-control" placeholder="tempat Lahir...">
            </div>
            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="date" name="tanggalLahir" value="<?php echo $rowPenduduk['tanggalLahir']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control">
                    <?php
                    echo "<option value='$rowPenduduk[jk]'>$rowPenduduk[jk]</option>";
                    $jk = array('pria', 'wanita');
                    foreach ($jk as $j) {
                        echo "<option value='$j'>$j</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Status Kawin</label>
                <select name="statusKawin" id="statusKawin" class="form-control">
                    <?php
                    echo "<option value='$rowPenduduk[statusKawin]'>$rowPenduduk[statusKawin]</option>";
                    $statusKawin = array('Belum Menikah', 'Menikah');
                    foreach ($statusKawin as $sk) {
                        echo "<option value='$sk'>$sk</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Pekerjaan</label>
                <select name="pekerjaan" id="" class="form-control">
                    <?php
                    dataPekerjaan($rowPenduduk['pekerjaan']);
                    $pekerjaan = mysqli_query($conn, "SELECT * FROM tbl_pekerjaan WHERE id_pekerjaan!='$rowPenduduk[pekerjaan]' ");
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
                    echo "<option value='$rowPenduduk[pendidikan]'>$rowPenduduk[pendidikan]</option>";
                    $pendidikan = array('SD', 'SMP', 'SMA', 'S1', 'S2', 'S3', 'Tidak Sekolah');
                    foreach ($pendidikan as $pen) {
                        echo "<option value='$pen'>$pen</option>";
                    }
                    ?>
                </select>
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
                    <option value="<?php echo $rowPenduduk['statusKeluarga']; ?>"><?php echo $rowPenduduk['statusKeluarga']; ?></option>
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
                <select name="id_kec" id="id_kec" class="form-control">
                    <?php dataKecamatanOption($id_kec); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Kelurahan / Desa</label>
                <select name="id_kel" id="id_kel" class="form-control">
                    <?php dataKelurahanOption($id_kel); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Lingkungan</label>
                <select name="id_lingkungan" id="id_lingkungan" class="form-control">
                    <?php dataLingkungan($id_lingkungan); ?>
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
                    echo "<option value='$rowPenduduk[agama]'>$rowPenduduk[agama]</option>";
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