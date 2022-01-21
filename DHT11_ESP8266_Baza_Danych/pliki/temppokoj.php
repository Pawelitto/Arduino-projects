<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "www1965_baza";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $result = mysqli_query($conn, "SELECT * FROM sensordatapokoj");

?>

<!DOCTYPE HTML>
<html>

  <head>

    <link rel="stylesheet" href="style.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Czas', 'Temperatura'],

            <?php

                if(mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_array($result)) {

                        echo "['".$row['reading_time']."', ".$row['value1']."],";

                    }
                }

            ?>

        ]);

        var options = {
          title: 'Temperatura pokoju',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('wykres'));

        chart.draw(data, options);
      }
    </script>

  </head>

<body>
      
    <div class="container">

        <div class="navbar">

            <div class="tempi"> <a href="index.php">Główna</a> </div>

            <div class="tempi"> <a href="temppokoj.php">Pokój</a> </div>

            <div class="tempi"> <a href="temppiw.php">Piec</a> </div>

        </div>

        <h1>Dane z czujników (Pokój)</h1>

        <div id="wykres" style="width: 900px; height: 500px"></div>

</div>

</body>
</html>
