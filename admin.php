<!DOCTYPE html>
<html>
<head>
    <title>Pagina de administrare</title>
    <link href="css/diana.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px; 
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
        }

        .footer_p {
            margin: 0;
        }

        .footer_p p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Pagina de administrare</h1>
    </header>
 

</body>
</html>
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

if (isset($_POST['date_introduse'])) {
    $Nume = $_POST['nume'];
    $Prenume = $_POST['prenume'];
    $Email = $_POST['e-mail'];
    $Numar_Telefon = $_POST['numar_Telefon'];
    $Data = $_POST['data'];
    $Ora = $_POST['ora'];
    $Detalii = $_POST['detalii'];

    $sql = "INSERT INTO clienti(Nume, Prenume, Email, NumarTelefon, Data, Ora, Detalii) VALUES('$Nume', '$Prenume', '$Email', '$Numar_Telefon', '$Data', '$Ora', '$Detalii')";

    if ($connection->query($sql) === TRUE) {
        header("location: admin.php"); // Redirectioneaza catre pagina curenta pentru a actualiza afisarea
        exit(); // Opreste executia scriptului dupa redirectionare
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
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
</head>

<body>
<header>
    <!--Imaginea-->
    <img src="photos/administrativ.jpg" style="width: 100%; height:315px; margin-top: 0px;">
    <nav>
        <ul>
            <li><a href="index_admin.html">Acasa</a></li>
            <li><a href="admin.php">Pacienti</a></li>
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

<form method=post action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
            echo '<td><input type="text" value="' . $row['NumarTelefon'] . '" name="numarTelefon' . $i . '" readonly ></td>';
            echo '<td><input type="text" value="' . $row['Data'] . '" name="dataProgramare' . $i . '" ></td>';
            echo '<td><input type="text" value="' . $row['Ora'] . '" name="ora' . $i . '" ></td>';
            echo '<td><input type="text" value="' . $row['Detalii'] . '" name="detalii' . $i . '" ></td>';
            echo '<td><input type="submit" value="update" name="update' . $i . '"/></td>';
            echo '<td><input type="submit" value="delete" name="delete' . $i . '"/></td>';
            echo '<td><input type="checkbox" name="check' . $i . '"></td>';
            echo '</tr>';
            $i++;
        }
        ?>
    </table>
</form>


</body>
</html>

