<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'terapeut';

$connection = mysqli_connect($host, $user, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Verificare dacă a fost apăsat butonul "Delete" și există cheia "check" în $_POST
if (isset($_POST['delete']) && isset($_POST['check'])) {
    foreach ($_POST['check'] as $key => $value) {
        if ($value == "on") {
            $nume = $_POST['nume' . $key];
            $prenume = $_POST['prenume' . $key];
            $sql = "DELETE FROM clienti WHERE Nume='$nume' AND Prenume='$prenume'";
            if ($connection->query($sql) === TRUE) {
                echo "<meta http-equiv='refresh' content='0'>"; // Actualizare automată a paginii
                exit(); // Oprește execuția scriptului după redirecționare
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        }
    }
}

// Verificare dacă a fost apăsat butonul "Update"
foreach ($_POST as $key => $value) {
    if (substr($key, 0, 6) === 'update') {
        $index = substr($key, 6); // Extrage indexul din numele butonului
        $nume = $_POST['nume' . $index];
        $prenume = $_POST['prenume' . $index];
        $numarTelefon = $_POST['numarTelefon' . $index];
        $dataProgramare = $_POST['dataProgramare' . $index];
        $ora = $_POST['ora' . $index];
        $detalii = $_POST['detalii' . $index];

        $sql = "UPDATE clienti SET NumarTelefon='$numarTelefon', Data='$dataProgramare', Ora='$ora', Detalii='$detalii' WHERE Nume='$nume' AND Prenume='$prenume'";
        if ($connection->query($sql) === TRUE) {
            echo "<meta http-equiv='refresh' content='0'>"; // Actualizare automată a paginii
            exit(); // Oprește execuția scriptului după redirecționare
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrare programari</title>
    <link href="css/diana.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        table {
            margin-top: 20px;
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"] {
            width: 100%;
            box-sizing: border-box;
        }

        footer {
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer_p {
            margin: 0;
        }

        .footer_p p {
            margin: 0;
        }
    </style>
    <script>
        function refreshPage() {
            window.location.reload();
        }
    </script>
</head>

<body>
<header>
    <!--Imaginea-->
    <img src="photos/administrativ.jpg" style="width: 100%; height:315px; margin-top: 0px;">
    <nav>
        <ul>
            <li><a href="index_admin.html">Acasa</a></li>
            <li><a href="test.php">Pacienti</a></li>
            <li><a href="logout.php">Deconectare</a></li>
        </ul>
    </nav>
</header>

<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "terapeut";

$connection = mysqli_connect($host, $user, $password, $database);
$query = "SELECT * FROM clienti";
$result = mysqli_query($connection, $query);
$i = 0;
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
        <tr>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Numar telefon</th>
            <th>Data programare</th>
            <th>Ora programare</th>
            <th>Detalii</th>
            <th>Editeaza</th>
            <th>Sterge</th>
            <th>Selecteaza</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td><input type="text" value="' . $row['Nume'] . '" name="nume' . $i . '" readonly></td>';
            echo '<td><input type="text" value="' . $row['Prenume'] . '" name="prenume' . $i . '" readonly></td>';
            echo '<td><input type="text" value="' . $row['NumarTelefon'] . '" name="numarTelefon' . $i . '" ></td>';
            echo '<td><input type="text" value="' . $row['Data'] . '" name="dataProgramare' . $i . '" ></td>';
            echo '<td><input type="text" value="' . $row['Ora'] . '" name="ora' . $i . '" ></td>';
            echo '<td><input type="text" value="' . $row['Detalii'] . '" name="detalii' . $i . '" ></td>';
            echo '<td><input type="submit" value="Update" name="update'.$i.'"/></td>';
            echo '<td><input type="submit" value="Delete" name="delete"/></td>';
            echo '<td><input type="checkbox" name="check[' . $i . ']"></td>';
            echo '</tr>';
            $i++;
        }
        ?>
    </table>
</form>


</body>
</html>
