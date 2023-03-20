 <!-- #END# Basic Examples -->
 <!-- Exportable Table -->
 <div class="row clearfix">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card">
             <div class="header">
                 <h2>
                     Data Penduduk Pindah
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
                                     <th>Pindah Ke</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    $pendudukPindah = pendudukPidahPerlingkungan($_SESSION['id_lingkungan']);
                                    while ($rowPen = mysqli_fetch_array($pendudukPindah)) {
                                        //  pindah ke
                                        $pindahKe = pindahKe($rowPen['nik']);
                                        echo "<tr>
                                            <td>$rowPen[nik]</td>
                                            <td>$rowPen[nama]</td>
                                            <td>$rowPen[tempatLahir]$rowPen[tanggalLahir]</td>
                                            <td>$rowPen[usia]</td>
                                            <td>$pindahKe</td>
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