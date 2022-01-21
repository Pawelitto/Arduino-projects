<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="style.css">

	<title> Dane z czujników </title>

</head>

<body>

    

<div class="container">

    <div class="navbar">

        <div class="tempi"> <a href="index.php">Główna</a> </div>

        <div class="tempi"> <a href="temppokoj.php">Pokój</a> </div>

        <div class="tempi"> <a href="temppiw.php">Piec</a> </div>

    </div>

    <h1>Dane z czujników</h1>

    <table>

        <?php
            $servername = "localhost";
            $username = "";
            $password = "";
            $dbname = "";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sqlpiw = "SELECT id, sensor, location, value1, reading_time FROM sensordatapiwnica ORDER BY id DESC"; /*select items to display from the sensordata table in the data base*/
        $sqlpok = "SELECT id, sensor, location, value1, reading_time FROM sensordatapokoj ORDER BY id DESC";

        echo '

        <table cellspacing="5" cellpadding="5" id="tabela1">
            <tr> 
                <th>ID</th> 
                <th>Data</th> 
                <th>Temp (Pokój) &deg;C</thh>
            </tr>';
        
        if ($result = $conn->query($sqlpok)) {
            while ($row = $result->fetch_assoc()) {
                $row_id = $row["id"];
                $row_reading_time = $row["reading_time"];
                $row_sensor = $row["sensor"];
                $row_location = $row["location"];
                $row_value1 = $row["value1"];
            
            
                echo '<tr> 
                        <td>' . $row_id . '</td> 
                        <td>' . $row_reading_time . '</td> 
                        <td>' . $row_value1 . '</td>
                    </tr>';
            }
            $result->free();
        }

        echo '

        <table cellspacing="5" cellpadding="5">
            <tr> 
                <th>ID</th> 
                <th>Data</th> 
                <th>Temp (Piec) &deg;C</thh>
            </tr>';
        
        if ($result = $conn->query($sqlpiw)) {
            while ($row = $result->fetch_assoc()) {
                $row_id = $row["id"];
                $row_reading_time = $row["reading_time"];
                $row_sensor = $row["sensor"];
                $row_location = $row["location"];
                $row_value1 = $row["value1"];
            
            
                echo '<tr> 
                        <td>' . $row_id . '</td> 
                        <td>' . $row_reading_time . '</td> 
                        <td>' . $row_value1 . '</td>
                    </tr>';
            }
            $result->free();
        }



        $conn->close();
        ?> 

    </table>

</div>

</body>
</html>
