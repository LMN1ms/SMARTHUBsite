<?php
$servername = "localhost";


$dbname = "my_managmentalelmn";
$username = "managmentalelmn";
$password = "";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $temperatura = $umidita = $pressione = $umiditaterreno = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $temperatura = test_input($_POST["temperatura"]);
        $umidita = test_input($_POST["umidita"]);
        $pressione = test_input($_POST["pressione"]);
        $umiditaterreno = test_input($_POST["umiditaterreno"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO weather (temperatura, umidita, pressione, umiditaterreno)
        VALUES ('" . $temperatura . "', '" .  $umidita . "', '" . $pressione . "', '" . $umiditaterreno . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "dati inseriti con successo";
        } 
        else {
            echo "errore: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "Nessun dato inviato.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}