<section class="fade-in">
	<h2> VISUALIZZAZIONE DI TUTTO IL DATABASE </h2>
    
	<?php
    //accesso database
    $servername = "localhost";
    $dbname = "my_managmentalelmn";
    $username = "managmentalelmn";
    $password = "";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT IDmisurazione, temperatura, umidita, pressione, umiditaterreno, datainvio FROM weather ORDER BY IDmisurazione DESC";

    echo '<table cellspacing="5" cellpadding="5">
          <tr> 
            <td>ID</td> 
            <td>TEMPERATURA</td> 
            <td>UMIDITA</td> 
            <td>PRESSIONE</td> 
            <td>UMIDITA TERRENO</td> 
            <td>DATA</td> 
          </tr>';

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $row_IDmisurazione = $row["IDmisurazione"];
            $row_temperatura = $row["temperatura"];
            $row_umidita = $row["umidita"];
            $row_pressione = $row["pressione"];
            $row_umiditaterreno = $row["umiditaterreno"];
            $row_datainvio = $row["datainvio"];

            echo '<tr> 
                    <td>' . $row_IDmisurazione . '</td> 
                    <td>' . $row_temperatura . " C°" . '</td> 
                    <td>' . $row_umidita . " %" . '</td> 
                    <td>' . $row_pressione . " hPa" . '</td> 
                    <td>' . $row_umiditaterreno . " %" . '</td>
                    <td>' . $row_datainvio . '</td> 
                  </tr>';
        }
        $result->free();
    }

    $conn->close();
    ?>
    </table>
</section>
