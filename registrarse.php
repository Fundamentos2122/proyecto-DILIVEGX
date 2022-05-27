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
    <script>
        var file;
        function handleFiles(files){
            file = files[0];
            if(files[0].type=="image/jpeg"){

            }
        }
        
        function chequeo(){
            if(document.getElementsByName("name")[0].value=="")
                window.location.href ="registrarse.php?error=No se insertó un nombre";
            else if(document.getElementsByName("username")[0].value=="")
                window.location.href ="registrarse.php?error=No se insertó un nombre de usuario";
            else if(document.getElementsByName("email")[0].value=="")
                window.location.href ="registrarse.php?error=No se insertó un email";
            else if(document.getElementsByName("password")[0].value=="")
                window.location.href ="registrarse.php?error=No se insertó una contraseña";
            else if(document.getElementsByName("contrase")[0].value=="")
                window.location.href ="registrarse.php?error=No se re insertó la contraseña";
            else if(!document.getElementsByName("check")[0].checked)
                window.location.href ="registrarse.php?error=Es necesario aceptar los Términos de uso y Política";
            else if(document.getElementsByName("contraseña")[0].value!=document.getElementsByName("contrase")[0].value)
                window.location.href ="registrarse.php?error=Contraseñas no coinciden";
            else if(!file || file.type!="image/jpeg")
                window.location.href ="registrarse.php?error=La imagen es inexistente o no es JPG";
            else{
                return true;
            }

            return false;
        }
    </script>
</head>
<?php
include 'assets/header/header.php';
?>
    
    <p class="title">
        Registrarse
    </p>

    <form class="form" action="controllers/users_controller.php" onsubmit="return chequeo()" method="POST" autocomplete="off" enctype="multipart/form-data">
        
        <div>
        <?php
            if (array_key_exists("error", $_GET)) 
                echo '<p style="color:red;">' .$_GET["error"]. '</p>';
        ?>
        </div>
        
        <div class="input-group">
            <label for="name">Nombre: </label>
            <input type="text" name="name" class="form-control">
        </div>
        
        <div class="input-group">
            <label for="username">Usuario: </label>
            <input type="text" name="username" class="form-control">
        </div>

        <div class="input-group">
            <label for="email">Email: </label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="input-group">
            <label for="contraseña">Contraseña: </label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="input-group">
            <label for="contrase">Re-Ingresar Contraseña: </label>
            <input type="password" name="contrase" class="form-control">
        </div>

        <div class="input-group">
                <label for="photo">Foto(JPG):</label>
                <input type="file" name="photo" id="photo" onchange="handleFiles(this.files)" accept=".jpg">
        </div>

        <div class="policy">
            <input type="checkbox" name="check" >
            <label for="check">Acepto los <a href="#">Terminos de uso</a> y <a href="#">Política de privacidad</a>. </label>
        </div>


        <input class="btn" type="submit" value="Registrarse">

    
    </form>
        

    

    
    <div class="info">
        <p>Página creada por: Diego Eugenio Saldívar Narváez</p>
        <p>Materia: Fundamentos Web</p>
    </div>

    
</body>
</html> 