<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: index.html");
	exit;
}

include_once 'dbconnect.php';

$errormsg = "";

// Verificăm dacă formularul a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extragem datele din formular
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    // Verificăm dacă adresa de email este deja înregistrată
    $check_query = mysqli_query($con, "SELECT * FROM users WHERE Email = '$email'");
    if(mysqli_num_rows($check_query) > 0) {
        $errormsg = "Adresa de email este deja înregistrată!";
    } else {
        // Adăugăm noul utilizator în baza de date
        $fullname = $firstname . ' ' . $lastname;
        $insert_query = mysqli_query($con, "INSERT INTO users (Name, Email, Password) VALUES ('$fullname', '$email', '" . md5($password) . "')");
        if($insert_query) {
            // Redirectăm utilizatorul către pagina de login după înregistrare
            header("Location: login.php");
            exit;
        } else {
            $errormsg = "A apărut o eroare la înregistrare. Vă rugăm să încercați din nou.";
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Înregistrare utilizator</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <style>
        
        body {
            margin-top: 120px; 
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="registerform">
                <fieldset>
                    <legend>Înregistrare</legend>
                    
                    <div class="form-group">
                        <label for="firstname">Nume</label>
                        <input type="text" name="firstname" placeholder="Numele dvs." required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="lastname">Prenume</label>
                        <input type="text" name="lastname" placeholder="Prenumele dvs." required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Adresa dvs. de email" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="password">Parolă</label>
                        <input type="password" name="password" placeholder="Parola dvs." required class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Înregistrare" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php echo $errormsg; ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        Do you already have an account? <a href="login.php">Log in here</a>
        </div>
    </div>
</div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
