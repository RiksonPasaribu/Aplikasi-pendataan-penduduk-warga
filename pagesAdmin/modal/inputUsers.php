<!-- Modal -->
<div class="modal fade" id="exampleModalUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username...." required />
                            </div>
                            <div class="form-group">
                                <label for="">No Telp</label>
                                <input type="number" name="noHp" class="form-control" placeholder="No telp...." required />
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                                <select name="id_kec" id="id_kec" class="form-control show-tick" onchange="showCustomer(this.value)" required />
                                <option value=""> -- Pilih Kecamatan -- </option>
                                <?php
                                $kec = mysqli_query($conn, "SELECT * FROM tbl_kecamatan ");
                                while ($rowKec = mysqli_fetch_array($kec)) {
                                    echo "<option value='$rowKec[id_kec]'>$rowKec[kecamatan]</option>";
                                }
                                ?>
                                </select>
                            </div>
                            <div id="txtHint"></div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="inputUser" class="btn btn-primary">Simpan User</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>