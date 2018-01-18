<?php


?>
<!DOCTYPE html>
<html>
<title>Lecker: Kunden</title>
<head>
    <link rel="stylesheet" href="index.css"/>
    <style>
        #login {
            text-align: center;
        }

        #main {
            text-align: center;
        }
    </style>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

<div id="main">
    <h2 style="color:rgb(150, 29, 29)">Herzlich Willkommen in der Bäckerei "Lecker"!</h2>


    <h1>Login Lecker</h1>
    <div id="login">
        <h2>Login Form</h2>
        <form action="" method="post">
            <label>E-Mail :</label>
            <input id="name" name="email" placeholder="e-mail adresse" type="text">
            <label>Passwort :</label>
            <input id="passwort" name="passwort" placeholder="**********" type="password">
            <input name="submit" type="submit" value=" Login ">
            <span><?php echo $error; ?></span>
        </form>
    </div>

    <br></br>

</div>
</body>
</html>