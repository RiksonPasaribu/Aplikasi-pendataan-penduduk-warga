<?php
require_once "../function.php";
if ($_POST['idx']) {
    $id_login = $_POST['idx'];
    $dataUser = datausersId($id_login);
    $rowUser = mysqli_fetch_array($dataUser);
?>
    <input type="hidden" name="id_login" value="<?php echo $id_login; ?>">
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" name="username" value="<?php echo $rowUser['username']; ?>" class="form-control" placeholder="Username...." required />
    </div>
    <div class="form-group">
        <label for="">No Telp</label>
        <input type="number" name="noHp" value="<?php echo $rowUser['noHp']; ?>" class="form-control" placeholder="No telp...." required />
    </div>
<?php
}
?>