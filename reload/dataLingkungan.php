<?php
require_once "../function.php";
if ($_POST['idx']) {
    $id_lingkungan = $_POST['idx'];
    $dataLingkunganid = dataLingkunganId($id_lingkungan);
    $row = mysqli_fetch_array($dataLingkunganid);
?>
    <input type="hidden" name="id_lingkungan" value="<?php echo $id_lingkungan; ?>">
    <div class="form-group">
        <label for="">No Lingkungan </label>
        <input type="text" name="no_lingkungan" value="<?php echo $row['no_lingkungan']; ?>" class="form-control" placeholder="No Lingkungan.." />
    </div>
    <div class="form-group">
        <label for="">Lingkungan</label>
        <input type="text" name="lingkungan" value="<?php echo $row['lingkungan']; ?>" class="form-control" placeholder="Lingkungan.." required />
    </div>
<?php
}
?>