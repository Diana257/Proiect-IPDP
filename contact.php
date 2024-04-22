<?php
		session_start();
			$host='localhost';
			$user='root';
			$password='';
			$database='terapeut';

			$connection=mysqli_connect($host, $user, $password, $database);
				if ($connection->connect_error) {
						die("Connection failed: " . $connection->connect_error);
} 
				
			
			if(isset($_POST['date_introduse'])){
				$Nume=$_POST['nume'];
				$Prenume=$_POST['prenume'];
				$Email=$_POST['e-mail'];
				$Numar_Telefon=$_POST['numar_Telefon'];
				$Data=$_POST['data'];
				$Detalii=$_POST['detalii'];
				
				$sql="INSERT INTO clienti(Nume, Prenume, Email, NumarTelefon, Data, Detalii) VALUES('$Nume', '$Prenume', '$Email', '$Numar_Telefon' , '$Data' , '$Detalii')";
			
				
				if ($connection->query($sql) === TRUE) {
					echo "Inregistrare realizata cu succes!";
					} 
				else {
					echo "Error: " . $sql . "<br>" . $connection->error;
					}
			}
			$connection->close();
		?>

<!DOCTYPE html>
<html>
	
	<head>
		<title>Contact</title>
		<link href="css/contact.css" rel="stylesheet" type="text/css" />
		<!--<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	</head>
	
	<body>
		
		<header>
			<!--Imaginea-->
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
									<td><input type="text" name="nume"></td>
								</tr>
								<tr>
									<td>Prenume:</td>
									<td><input type="text" name="prenume"></td>
								</tr>
								<tr>
									<td>E-mail:</td>
									<td><input type="text" name="e-mail"></td>
								</tr>
								<tr>
									<td>Număr de telefon:        . </td>
									<td><input type="text" name="numar_Telefon"></td>
								</tr>
								<tr>
									<td>Dată programare:       . </td>
									<td><input type="text" name="data"></td>
								</tr>
								<tr>
									<td>Detalii</td>
									<td><input type="text" name="detalii"></td>
								</tr>
								<tr>
									<!--<td></br><button type="button" name="date_introduse" class="btn btn-success">OK</button></td>-->
									<td></br><input style="width: 70px; height: 30px;" type="Submit" name="date_introduse" value="Ok" ></td>
									
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
				<p>Log in <a href="login.php"><img src="photos/login.png"></a></p>
				
			</div>
		</footer>
		
	</body>
</html>