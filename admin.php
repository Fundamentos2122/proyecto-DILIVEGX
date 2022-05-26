<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="cuentaheader.css">
    <link rel="stylesheet" href="perfil.css">
    <link rel="stylesheet" href="admin.css">
    <title>Document</title>
</head>
<body onresize="change()">

<?php
include 'assets/header/header.php';
?>

    <script src="sidebar.js"></script>

    <div class="header">
        <div class="hinfo">
            <div class="profileimg">
                <img src="https://picsum.photos/150" class=>
                <img class="editbtn" src="assets/icons/edit.png" alt="">
            </div>
            <div class="names">
                <p>(Nombre completo)</p>
                <p>(User Name)</p>
            </div>
        </div>
    </div>

    <ul class="acmenu">
        <li onclick="location.href='cuenta-index.html';">Perfil</li>
        <li onclick="location.href='cuenta-builds.html';">Tus Builds</li>
        <li onclick="location.href='cuenta-reviews.html';">Tus reviews</li>
        <li onclick="location.href='cuenta-favoritas.html';">Partes Favoritas</li>
        <li onclick="location.href='cuenta-guardadas.html';">Builds Guardadas</li>
        <li class="selected" onclick="location.href='Admin.html';">Admin Menu</li>
        <p>.</p>
    </ul>

    <p class="category-title">Users</p>
    <div class="category" id="users" onclick="location.href='cuenta-index.html';">
        
    </div>

    <p class="category-title">Reviews con reporte</p>
    <div class="category" id="revs" onclick="location.href='cuenta-index.html';">
        <div class="review">
            <p class="revtext">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, nam? Ipsa perferendis unde fugiat cum sit ipsam ad. Hic quam cumque nemo rem illum quos sint...</p>
            <img class="icon" src="assets/trash.svg" alt="">
        </div>
    </div>


    <script src="admin-generator.js"></script>

    <div class="agregar">
        <button class="btn">Agregar parte</button>
    </div>

</body>
</html> 