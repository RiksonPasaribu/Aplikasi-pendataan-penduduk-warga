<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Cari No Kartu Keluarga (KK)
                </h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">No KK</label>
                        <input type="text" name="noKK" class="form-control" placeholder="Masukkan No kk...">
                    </div>
                </form>
                <?php
                if (isset($_POST['noKK'])) {
                    $noKK = $_POST['noKK'];
                    cariNoKK($noKK);
                }
                ?>
            </div>
        </div>
    </div>
</div>