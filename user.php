<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Programari online</title>
    <link href="css/diana.css" rel="stylesheet" type="text/css" />
    <style>
       body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat; 
        }

        header {
           background-color:#467d11;
            color: white;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        header nav ul li {
            display: inline;
            margin-right: 20px;
            margin-top:40px;
        }
        header nav ul li a {
            margin-top:40px;
            text-decoration: none;
            color: white;
        }
        .body1 {
            text-align: center;
            padding: 200px 20px 20px; /* Adjust top padding to allow space for the fixed header */
        }
        h2 {
            color: #333;
        }
        .programeaza-button {
            margin-top: 20px;
        }
        .programeaza-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
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
    <nav>
        <ul>
            <li><a href="index2.html">Acasa</a></li>
            <li><a href="despre_mine.html">Despre mine</a></li>
            <li><a href="intrebari_frecvente.html">Intrebari frecvente</a></li>
            <li><a href="contact.php">Programari online</a></li>
        </ul>
    </nav>
</header>

<div class="body1">
    <?php if (isset($_SESSION['usr_name'])): ?>
        <h2>Bine ai venit, <?= $_SESSION['usr_name'] ?>!</h2>
    <?php else: ?>
        <h2>Bine ai venit, Utilizator!</h2>
    <?php endif; ?>

    <div class="programeaza-button">
        <a href="contact.php">Programeaza-te acum!</a>
    </div>
</div>

<footer>
    <div class="footer_p">
        <p>Log out <a href="logout.php"><img src="photos/login.png"></a></p>
    </div>
</footer>

</body>
</html>
