<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="info.css">
    <title>Document</title>
</head>
<body onresize="change()">
<?php
include 'assets/header/header.php';
?>

<div class="main">

    <div class="first">

        <div class="builds" id="builds">
            <p class="cardtitle">Top Builds</p>
            
        </div>

        <div class="create">
            <p class="cardtitle">Nueva Build</p>
            <div class="item2"><a href="newbuild.php"><img src="assets/icons/case.png" alt="" class="new-img"></a></div>
        </div>

    </div>

    <div class="builds" id = "cpus">
        <p class="cardtitle">Top CPUs</p>
        <!-- <div class="item"><a href="part.php"><img src="assets/icons/cpu.png" alt="" class="item-img"><p>Prueba</p></a></div> -->
        

    </div>

    <div class="builds" id = "gpus">
        <p class="cardtitle">Top GPUs</p>
        
    </div>
</div>

<div class="info">
    <p>Página creada por: Diego Eugenio Saldívar Narváez</p>
    <p>Materia: Fundamentos Web</p>
</div>

<script src = "assets/js/index.js"></script>

</body>
</html> 