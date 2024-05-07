<?php
session_start();

// Verificam daca utilizatorul este conectat
if(isset($_SESSION['usr_name'])) {
    header("Location: index2.html"); // Redirect catre pagina corecta pentru utilizatorii conectati
    exit();
} else {
    header("Location: index.html"); // Redirect catre pagina corectă pentru utilizatorii neconectati
    exit();
}
?>
