<div class="form-group">
    <label for="">Lingkungan</label>
    <select name="id_lingkungan" id="id_lingkungan" class="form-control show-tick">
        <?php
        include_once "koneksi.php";
        $id_kel = $_GET['id_kel'];
        $lingkungan = mysqli_query($conn, "SELECT * FROM tbl_lingkungan WHERE id_kel='$id_kel' ");
        while ($rowLingkungan = mysqli_fetch_array($lingkungan)) {
            echo "<option value='$rowLingkungan[id_lingkungan]'>$rowLingkungan[lingkungan]</option>";
        }
        ?>
    </select>
</div>