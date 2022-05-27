<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="cuentaheader.css">
    <link rel="stylesheet" href="cards.css">
    <title>Document</title>
</head>
<?php
include 'assets/header/header.php';
?>
<?php
include 'assets/header/cuentaheader.php';
?>


    <ul class="acmenu">
        <li onclick="location.href='cuenta-index.php';">Perfil</li>
        <li class="selected" onclick="location.href='cuenta-builds.php';">Tus Builds</li>
        <li onclick="location.href='cuenta-reviews.php';">Tus reviews</li>
        <li onclick="location.href='cuenta-favoritas.php';">Partes Favoritas</li>
        <li onclick="location.href='cuenta-guardadas.php';">Builds Guardadas</li>
        <p>.</p>
    </ul>
    
    <div id="builds">

    </div>
    <script src="generator-builds.js"></script>
    
    
</body>
</html> 