<!-- Modal -->
<div class="modal fade" id="exampleModalKec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Kecamatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <select name="id_kab" id="kabupaten" class="form-control show-tick" required />
                    <option value=""></option>
                    <?php
                    $prov = mysqli_query($conn, "SELECT * FROM reg_provinces WHERE id='71' ");
                    $rowProv = mysqli_fetch_array($prov);
                    $kabupaten = mysqli_query($conn, "SELECT * FROM tbl_kab WHERE id_prov='$rowProv[id]' ");
                    while ($rowKab = mysqli_fetch_array($kabupaten)) {
                        echo "<option value='$rowKab[id_kab]'>$rowKab[kabupaten]</option>";
                    }
                    ?>
                    </select>
                    <div class="form-group">
                        <label for="">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan...." required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="inputKecamatan" class="btn btn-primary">Simpan Kecamatan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>