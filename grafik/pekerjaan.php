 <?php
    require_once "../function.php";
    ?>
 <!-- Grafik -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

 <canvas id="myChartPek" width="300" height="150"></canvas>

 <script>
     // chart usia
     var ctx = document.getElementById('myChartPek').getContext('2d');
     var myChart = new Chart(ctx, {
         type: 'bar',
         data: {
             labels: [<?php
                        $data = dataPekerjaanTable();
                        while ($row = mysqli_fetch_array($data)) {
                            echo '"' . $row['pekerjaan'] . '",';
                        }
                        ?>],
             datasets: [{
                 label: 'Vote Penduduk ',
                 data: [<?php
                        $data = dataPekerjaanTable();
                        while ($row = mysqli_fetch_array($data)) {
                            $jumlah = jumlahDataPekerja($row['id_pekerjaan']);
                            echo $jumlah . ', ';
                        }
                        ?>],
                 backgroundColor: [
                     'rgba(255, 99, 132, 0.2)',
                     'rgba(54, 162, 235, 0.2)',
                     'rgba(255, 206, 86, 0.2)',
                     'rgba(75, 192, 192, 0.2)',
                     'rgba(153, 102, 255, 0.2)',
                     'rgba(255, 159, 64, 0.2)'
                 ],
                 borderColor: [
                     'rgba(255, 99, 132, 1)',
                     'rgba(54, 162, 235, 1)',
                     'rgba(255, 206, 86, 1)',
                     'rgba(75, 192, 192, 1)',
                     'rgba(153, 102, 255, 1)',
                     'rgba(255, 159, 64, 1)'
                 ],
                 borderWidth: 1
             }]
         },
         options: {
             scales: {
                 y: {
                     beginAtZero: true
                 }
             }
         }
     });
 </script>