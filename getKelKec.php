<div class="form-group">
    <label for="">Kelurahan / Desa</label>
    <select name="id_kel" id="id_kel" class="form-control show-tick" required />
    <option value=""> -- Pilih Lingkungan -- </option>
    <?php
    $id_kec = $_GET['id_kec'];
    include_once "koneksi.php";
    $kel = mysqli_query($conn, "SELECT * FROM tbl_kelurahan WHERE id_kec='$id_kec' ");
    while ($rowKel = mysqli_fetch_array($kel)) {
        echo "<option value='$rowKel[id_kel]'>$rowKel[kelurahan]</option>";
    }
    ?>
    </select>
</div>