<!-- Modal -->
<div class="modal fade" id="exampleModalLing" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Lingkungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kelurahan</label>
                        <select name="id_kel" id="id_kel" class="form-control show-tick" required />
                        <option value=""> -- Pilih Kelurahan -- </option>
                        <?php
                        $kel = mysqli_query($conn, "SELECT * FROM tbl_kelurahan ");
                        while ($rowKel = mysqli_fetch_array($kel)) {
                            echo "<option value='$rowKel[id_kel]'>$rowKel[kelurahan]</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">No Lingkungan </label>
                        <input type="text" name="no_lingkungan" class="form-control" placeholder="No Lingkungan.." />
                    </div>
                    <div class="form-group">
                        <label for="">Lingkungan</label>
                        <input type="text" name="lingkungan" class="form-control" placeholder="Lingkungan.." required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="inputLingkungan" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>