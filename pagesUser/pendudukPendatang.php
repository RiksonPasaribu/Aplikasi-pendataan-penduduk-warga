 <!-- #END# Basic Examples -->
 <!-- Exportable Table -->
 <div class="row clearfix">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card">
             <div class="header">
                 <h2>
                     Data Penduduk Pendatang
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
                                     <th>Asal</th>
                                     <th>Tanggal Masuk</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    $pendudukPendatang = pendudukPendatangLing($_SESSION['id_lingkungan']);
                                    while ($rowPend = mysqli_fetch_array($pendudukPendatang)) {
                                        $dataAsal = dataPendatang($rowPend['nik']);
                                        $rowAsal = mysqli_fetch_array($dataAsal);
                                        echo "<tr>
                                            <td>$rowPend[nik]</td>
                                            <td>$rowPend[nama]</td>
                                            <td>$rowPend[tempatLahir]$rowPend[tanggalLahir]</td>
                                            <td>$rowPend[usia]</td>
                                            <td>$rowAsal[asal]</td>
                                            <td>$rowAsal[tanggalDatang]</td>
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