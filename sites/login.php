<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie do admina</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div id="box">
        <h3>Logowanie</h3>
        <form action="../php/login.php" method="post">
            <label>Login: <input type="text" name="login" id="login"></label>
            <label>Hasło: <input type="password" name="password" id="password"></label>
            <input type="submit" value="Zaloguj">
            <?php
                if(isset($_SESSION['errorLogin'])){
                    echo "<span id='error'>".$_SESSION['errorLogin']."</span>";
                }
            ?>
        </form>
    </div>
</body>

</html>