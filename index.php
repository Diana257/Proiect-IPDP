<!DOCTYPE html>


 <?php
        
              require 'phpmailer/PHPMailerAutoload.php';
              if(isset($_POST['send']))
                  {
                    $email = $_POST['email'];                    
                    $password = $_POST['password'];
                    $to_id = $_POST['toid'];
                    $message = $_POST['message'];
                    $subject = $_POST['subject'];

                    $mail = new PHPMailer;

                    $mail->isSMTP();

                    $mail->Host = 'smtp.gmail.com';

                    $mail->Port = 587;

                    $mail->SMTPSecure = 'tls';

                    $mail->SMTPAuth = true;

                    $mail->Username = $email;

                    $mail->Password = $password;

                    $mail->setFrom('from@example.com', 'First Last');

                    $mail->addReplyTo('replyto@example.com', 'First Last');

                    $mail->addAddress($to_id);

                    $mail->Subject = $subject;

                    $mail->msgHTML($message);

                    if (!$mail->send()) {
                       $error = "Mailer Error: " . $mail->ErrorInfo;
                        ?><script>alert('<?php echo $error ?>');</script><?php
                    } 
                    else {
                       echo '<script>alert("Message sent!");</script>';
                    }
               }
        ?>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Email</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="main">
            <div id="login">
                <h2>Trimite un e-mail</h2>
                <hr/>
                <form method="post" action="index.php" >
                    <input type="text" placeholder="E-mail" name="email"/>
                    <input type="password" placeholder="Parolă" name="password"/>
                    <input type="text" placeholder="Către " name="toid"/>  
                    <input type="text" placeholder="Subiect " name="subject"/>
                    <textarea rows="4" cols="50" placeholder="Scrie un mesaj..." name="message"></textarea>
                    <input type="submit" value="Trimite" name="send"/>
                </form>    
            </div>
        </div>
         
    </body>
</html>