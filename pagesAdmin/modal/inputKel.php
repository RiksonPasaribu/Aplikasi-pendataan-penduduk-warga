<!-- Modal -->
<div class="modal fade" id="exampleModalKel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Kelurahan / Desa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kecamatan</label>
                        <select name="id_kec" id="kid_kec" class="form-control show-tick">
                            <?php
                            $kec = mysqli_query($conn, "SELECT  * FROM tbl_kecamatan ");
                            while ($rowKec = mysqli_fetch_array($kec)) {
                                echo "<option value='$rowKec[id_kec]'>$rowKec[kecamatan]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kelurahan / Desa</label>
                        <input type="text" name="kelurahan" class="form-control" placeholder="Kelurahan / Desa ..." required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="inputKel" class="btn btn-primary">Simpan Data</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>