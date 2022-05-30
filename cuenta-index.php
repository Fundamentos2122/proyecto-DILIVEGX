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
    <title>Document</title>
</head>
<?php
include 'assets/header/header.php';
?>
<?php
include 'assets/header/cuentaheader.php';
?>

    <ul class="acmenu">
        <li class="selected" onclick="location.href='cuenta-index.php';">Perfil</li>
        <li onclick="location.href='cuenta-builds.php';">Tus Builds</li>
        <li onclick="location.href='cuenta-reviews.php';">Tus reviews</li>
        <li onclick="location.href='cuenta-favoritas.php';">Partes Favoritas</li>
        <li onclick="location.href='cuenta-guardadas.php';">Builds Guardadas</li>
        <?php
            if(array_key_exists("type",$_SESSION))
                if($_SESSION["type"] == "admin")
                    echo '<li onclick="location.href=`cuenta-admin.php`;">Admin Menu</li>'
        ?>
        <p>.</p>
    </ul>



    <div class="profile">
        <div class="pdata">
            <p>Nombre:</p>
            <p class="pname">
            <?php
                echo $_SESSION["name"];
            ?>
            </p>
        </div>
        

        <div class="pdata">
            <p>Usuario:</p>
            <p class="puser">
            <?php
                echo $_SESSION["username"];
            ?>
            </p>
        </div>

        <div class="pdata">
            <p>Correo:</p>
            <p class="pmail">
            <?php
                echo $_SESSION["email"];
            ?>
            </p>
        </div>
    </div>

    <div class="revb">
            <p onclick="sessionEnd()" style="color: rgb(114, 21, 201); cursor: pointer; font-weight: 600;">Cerrar sesión</p>    
    </div>



    <script>
        function sessionEnd(){      
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open('GET','controllers/destroy_session.php', true);
                    xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState == 4){
                        if(xmlhttp.status == 200){
                            window.location.href ="index.php"
                        }
                    }
                    };
                    xmlhttp.send(null);
        }
    </script>
</body>
</html> 