<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="form.css">
    <title>Document</title>
</head>
<?php
include 'assets/header/header.php';
?>

    <p class="title">
        Iniciar Sesión
    </p>
    <form class="form" action="controllers/login_controller.php" method="POST" autocomplete="off" enctype="multipart/form-data">
        <?php
            if (array_key_exists("error", $_GET)) 
                echo '<p style="color:red;">' .$_GET["error"]. '</p>';
        ?>
        <input type="hidden" name="_method" value="POST">
        <div class="input-group">
            <label for="email">Email: </label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="input-group">
            <label for="password">Contraseña: </label>
            <input type="password" name="password" class="form-control">
        </div>

        <div>
            <input class="btn" type="submit" value="Iniciar Sesión">
        </div>
        
    </form>

    
</body>
</html> 