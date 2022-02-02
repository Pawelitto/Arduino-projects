<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

/*$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);*/
/* http://esp8266test.usite.pl/post-esp-data.php?&api_key= *tutaj api key ustawiony w pliku do ardunio* &sensor=dht211&location=fajnemiejsce&value1=14&value2=51&value3=91 */


$api_key_value = "kluczapibezpiecznypok";
$api_key_value2 = "kluczapibezpiecznypiw";

$api_key = $sensor = $location = $value1 = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $api_key = test_input($_GET["api_key"]);
    
    if($api_key == $api_key_value) {
        $sensor = test_input($_GET["sensor"]);
        $location = test_input($_GET["location"]);
        $value1 = test_input($_GET["value1"]);
        

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection


        if ($conn->connect_error) {
            die("Blad polaczenia: " . $conn->connect_error);
        } 
        
        if ($api_key == $api_key_value){
            $sql1 = "INSERT INTO sensordatapokoj (sensor, location, value1) 
            VALUES ('" . $sensor . "', '" . $location . "', '" . $value1 . "')";
        }
        

        if ($conn->query($sql1) === TRUE) {
            echo "Nowy rekord danych zostal dodany pomyslnie";

        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
    
        $conn->close();


    } else {
        echo "Zly klucz API (Pokoj).";
    }


    if($api_key == $api_key_value2) {
        $id = test_input($_GET["id"]);
        $sensor = test_input($_GET["sensor"]);
        $location = test_input($_GET["location"]);
        $value1 = test_input($_GET["value1"]);
        

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection


        if ($conn->connect_error) {
            die("Blad polaczenia: " . $conn->connect_error);
        } 
        
        if ($api_key == $api_key_value2){
            $sql2 = "INSERT INTO sensordatapiwnica (id, sensor, location, value1) 
            VALUES ('" . $id . "', '" . $sensor . "', '" . $location . "', '" . $value1 . "')";
        }
        

        if ($conn->query($sql2) === TRUE) {
            echo "Nowy rekord danych zostal dodany pomyslnie";

        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    
        $conn->close();


    } else {
        echo "Zly klucz API (Piwnica).";
    }


} else {
    echo "Nie wyslano danych.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
