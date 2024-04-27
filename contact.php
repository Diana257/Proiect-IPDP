<?php
session_start();

// Verifică dacă formularul a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date_introduse'])) {

    // Conectare la baza de date
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'terapeut';
    $connection = mysqli_connect($host, $user, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Preluare și escapare datele din formular
    $nume = mysqli_real_escape_string($connection, $_POST['nume']);
    $prenume = mysqli_real_escape_string($connection, $_POST['prenume']);
    $email = mysqli_real_escape_string($connection, $_POST['e-mail']);
    $numarTelefon = mysqli_real_escape_string($connection, $_POST['numar_Telefon']);
    $data = mysqli_real_escape_string($connection, $_POST['data']);
    $ora = mysqli_real_escape_string($connection, $_POST['ora']);
    $detalii = mysqli_real_escape_string($connection, $_POST['detalii']);

    // Formatarea datei în formatul dorit (YYYY-MM-DD)
    $data_formatata = date('Y-m-d', strtotime($data));

    // Verificare dacă există deja o programare la aceeași dată și oră
    $check_query = "SELECT * FROM clienti WHERE Data='$data_formatata' AND Ora='$ora'";
    $result = mysqli_query($connection, $check_query);
    if (mysqli_num_rows($result) > 0) {
        // Afișează mesaj de eroare și oprește scriptul
        echo '<script>alert("Această oră este deja ocupată. Te rugăm să alegi alta oră.")</script>';
    } else {
        // Interogare SQL pentru inserare
        $insert_query = "INSERT INTO clienti (Nume, Prenume, Email, NumarTelefon, Data, Detalii, Ora) 
                         VALUES ('$nume', '$prenume', '$email', '$numarTelefon', '$data_formatata', '$detalii', '$ora')";

        // Execută interogarea
        if ($connection->query($insert_query) === TRUE) {
            echo "Programarea a fost înregistrată cu succes!";
        } else {
            echo "Error: " . $insert_query . "<br>" . $connection->error;
        }
    }

    // Închide conexiunea la baza de date
    mysqli_close($connection);
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/contact.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        /* Adaugă această secțiune în CSS pentru a fixa dimensiunile câmpurilor de introducere */
        .input-field {
            width: 100%;
            padding: 8px;
            box-sizing: border-box; /* pentru a include padding-ul în lățimea totală */
        }
    </style>
</head>
<body>
    <header>
        <img src="photos/contact.jpg" style="width: 100%; height:300px; margin-top: 0px;">
        <nav>
            <ul>
                <li><a href="index.html">Acasă</a></li>
                <li><a href="despre_mine.html">Despre mine</a></li>
                <li><a href="intrebari_frecvente.html">Întrebări frecvente</a></li>
                <li><a href="contact.php">Programări online</a></li>
                
            </ul>
        </nav>
    </header>
    <div class="body4">
        </br></br></br></br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
                <h1><center>Programează-te online!</center></h1>
            </div>
            <div class="col-xs-4">
            </div>
        </div>
        <div class="body4.5">
            </br></br>
        </div>
        <div class="row">
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
                <form method="post" action="contact.php">
                    <table>
                            <tr>
                                <td>Nume:</td>
                                <td><input type="text" name="nume" class="input-field"></td>
                            </tr>
                            <tr>
                                <td>Prenume:</td>
                                <td><input type="text" name="prenume" class="input-field"></td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td><input type="text" name="e-mail" class="input-field"></td>
                            </tr>
                            <tr>
                                <td>Număr de telefon:</td>
                                <td><input type="text" name="numar_Telefon" class="input-field"></td>
                            </tr>
                            <tr>
                                <td>Dată programare:</td>
                                <td><input type="text" id="data" name="data" class="input-field"></td>
                            </tr>
                            <tr>
                                <td>Ora programare:</td>
                                <td>
                                    <select name="ora" id="ora" class="input-field">
                                        <!-- Opțiuni inițiale (de aici începe actualizarea cu JavaScript) -->
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Detalii:</td>
                                <td><input type="text" name="detalii" class="input-field"></td>
                            </tr>
                            <tr>
                                <td></br><input style="width: 100%; height: 30px;" type="Submit" name="date_introduse" value="Ok" ></td>
                            </tr>
                    </table>
                </form>
            </div>
            <div class="col-xs-4">
            </div>
        </div>  
    </div>
    <div class="body5">
        </br></br></br></br></br>
    </div>

    <footer>
        <div class="footer_p">
            <?php
            if(isset($_SESSION['usr_id'])) {
                echo '<p><a href="logout.php">Log out</a><img src="photos/login.png"></p>';
            } else {
                echo '<p><a href="login.php">Log in</a><img src="photos/login.png"></p>';
            }
            ?>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inițializează Datepicker-ul pentru câmpul de introducere a datei
            $('#data').datepicker({
                minDate: 0, // Permite doar datele viitoare
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    // Excludem sâmbăta (ziua 6) și duminica (ziua 0)
                    return [(day != 0 && day != 6), ''];
                },
                onSelect: function(date) {
                    var day = new Date(date).getDay();
                    var oraSelect = $('#ora');
                    oraSelect.empty(); // Curăță opțiunile anterioare

                    if (day == 1 || day == 2) { // Luni și Marți
                        for (var i = 8; i <= 16; i++) {
                            oraSelect.append($('<option>', {
                                value: i + ':00',
                                text: i + ':00'
                            }));
                        }
                    } else { // Miercuri - Vineri
                        for (var i = 10; i <= 18; i++) {
                            oraSelect.append($('<option>', {
                                value: i + ':00',
                                text: i + ':00'
                            }));
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
