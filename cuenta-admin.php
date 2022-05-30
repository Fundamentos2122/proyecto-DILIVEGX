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
    <link rel="stylesheet" href="form.css">
    <title>Document</title>
</head>
<body onresize="change()">

<?php
include 'assets/header/header.php';
?>
<?php
include 'assets/header/cuentaheader.php';
?>

    <ul class="acmenu">
        <li onclick="location.href='cuenta-index.php';">Perfil</li>
        <li onclick="location.href='cuenta-builds.php';">Tus Builds</li>
        <li onclick="location.href='cuenta-reviews.php';">Tus reviews</li>
        <li onclick="location.href='cuenta-favoritas.php';">Partes Favoritas</li>
        <li onclick="location.href='cuenta-guardadas.php';">Builds Guardadas</li>
        <li class="selected" onclick="location.href='Admin.php';">Admin Menu</li>
        <p>.</p>
    </ul>
    
    <div id="adminmenu" style="display: none;">
    <p class="category-title">Users</p>
    <div class="category" id="users">
        
    </div>

    <p class="category-title">Reviews con reporte</p>
    <div class="category" id="revs">
        
    </div>

    
    <script src = "assets/js/cuenta-admin.js"></script>
    <p class="title">
        Agregar parte
    </p>
    <form class="form" action="controllers/part_controller.php" onsubmit="return chequeo()" method="POST" autocomplete="off" enctype="multipart/form-data">
        <div>
            <?php
                if (array_key_exists("error", $_GET)) 
                    echo '<p style="color:red;">' .$_GET["error"]. '</p>';
            ?>
        </div>
        <div class="input-group">
            <label for="types">*Tipo: </label>
            <select name="types" id="types">
                <option value="cpu">CPU</option>
                <option value="mb">MB</option>
                <option value="cas">CASE</option>
                <option value="gpu">GPU</option>
                <option value="ssd">SSD</option>
                <option value="cpc">COOLER</option>
                <option value="psu">PSU</option>
                <option value="ram">RAM</option>
                <option value="fan">FAN</option>
            </select>
        </div>
        <div class="input-group">
            <label for="name">*Nombre: </label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="input-group">
            <label for="desc">*Descripción: </label>
            <input type="text" name="desc" class="form-control">
        </div>
        <div class="input-group">
            <label for="price">*Precio(MXN): </label>
            <input type="number" name="price" class="form-control">
        </div>
        <div class="input-group">
            <label for="brand">*Marca: </label>
            <input type="text" name="brand" class="form-control">
        </div>
        <div class="input-group">
            <label for="socket">*Socket(CPU MB): </label>
            <input type="text" name="socket" class="form-control">
        </div>
        <div class="input-group">
            <label for="ff">*Factor de forma(Case MB):</label>
            <input type="text" name="ff" class="form-control">
        </div>
        <div class="input-group">
            <label for="wat">Consumo(W): </label>
            <input type="number" name="wat" class="form-control">
        </div>
        <div class="input-group">
            <label for="ddr">*Ddr(MB RAM):</label>
            <input type="number" name="ddr" class="form-control">
        </div>
        <div class="input-group">
                <label for="photo">*Imagen(JPG):</label>
                <input type="file" name="photo" id="photo" onchange="handleFiles(this.files)" accept=".jpg">
        </div>
        <button class="btn" style="cursor: pointer;">Agregar parte</button>
    </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            checkAdmin();
        })
        function checkAdmin(){
        if(<?php 
                if(array_key_exists("id",$_SESSION))
                    if($_SESSION["type"]=="admin")
                        echo json_encode(true);
                    else
                        echo json_encode(false);
                ?>==true)
        document.getElementById("adminmenu").style.display = "block";
        }
    </script>
</body>
</html> 