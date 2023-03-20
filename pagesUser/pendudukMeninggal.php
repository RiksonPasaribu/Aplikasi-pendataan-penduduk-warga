 <!-- #END# Basic Examples -->
 <!-- Exportable Table -->
 <div class="row clearfix">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card">
             <div class="header">
                 <h2>
                     Data Penduduk Meninggal
                 </h2>
                 <?php echo menuHeaderPenduduk(); ?>
                 <div class="body">
                     <div class="table-responsive">
                         <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                             <thead>
                                 <tr>
                                     <th>NIK</th>
                                     <th>Nama</th>
                                     <th>Tempat / Tanggak Lahir</th>
                                     <th>Usia</th>
                                     <th>Tanggal Meninggal</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    $pendudukMeninggal = dataMeninggal($_SESSION['id_lingkungan']);
                                    while ($roM = mysqli_fetch_array($pendudukMeninggal)) {
                                        $tanggalMeninggal = tanggalMeninggal($roM['nik']);
                                        echo "<tr>
                                            <td>$roM[nik]</td>
                                            <td>$roM[nama]</td>
                                            <td>$roM[tempatLahir] $roM[tanggalLahir]</td>
                                            <td>$roM[usia]</td>
                                            <td>$tanggalMeninggal</td>
                                        </tr>";
                                    }
                                    ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>