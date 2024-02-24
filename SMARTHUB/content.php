<section class="fade-in">
    <h2>ULTIMI DATI RICEVUTI</h2>

    <?php
    // Accesso al database
    $servername = "localhost";
    $dbname = "my_managmentalelmn";
    $username = "managmentalelmn";
    $password = "";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT IDmisurazione, temperatura, umidita, pressione, umiditaterreno, datainvio FROM weather ORDER BY IDmisurazione DESC LIMIT 1";

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

    ?>
    </table>
	<br/>
    <br/>
    <h3>
    <?php
        $query = "SELECT MAX(temperatura) AS max_temperatura, MIN(temperatura) AS min_temperatura FROM weather WHERE DATE(datainvio) = CURDATE()";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Estrai i risultati della query
            $row = $result->fetch_assoc();
            $maxTemperatura = $row["max_temperatura"];
            $minTemperatura = $row["min_temperatura"];

            // Stampa i risultati
            echo "Temperatura massima odierna: " . $maxTemperatura . "°C<br>";
            echo "Temperatura minima odierna: " . $minTemperatura . "°C";
        } else {
            echo "Nessun dato temperatura trovato per la data odierna.";
        }
    ?>
	<br/>
	</h3>
    
        <h3>
    <?php
        $query = "SELECT MAX(umidita) AS max_umidita, MIN(umidita) AS min_umidita FROM weather WHERE DATE(datainvio) = CURDATE()";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Estrai i risultati della query
            $row = $result->fetch_assoc();
            $maxUmidita = $row["max_umidita"];
            $minUmidita = $row["min_umidita"];

            // Stampa i risultati
            echo "Umidita massima odierna: " . $maxUmidita . "%<br>";
            echo "Umidita minima odierna: " . $minUmidita . "%";
        } else {
            echo "Nessun dato umidita trovato per la data odierna.";
        }
        $conn->close();
    ?>
	<br/>
	</h3>
    
    <!--
    <h2>Stazione meteo e controllo terreno situata a Barletta, zona 167. <br>
        Mostra Temperatura, Umidita, Pressione e il livello Umidita del Terreno di un vaso. <br><br>
        SENSORI UTILIZZATI: DHT22, BMP180 e SoulCapacitive Sensor v1.2. </h2>
	-->
</section>
