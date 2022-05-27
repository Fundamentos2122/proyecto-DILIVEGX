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
        Registrarse
    </p>
    <div class="form">
        
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
            <input type="password" name="contraseña" class="form-control">
        </div>

        <div class="input-group">
            <label for="contrase">Re-Ingresar Contraseña: </label>
            <input type="password" name="contrase" class="form-control">
        </div>

        <div class="input-group">
                <label for="photo">Foto(JPG):</label>
                <input type="file" name="photo" id="photo" onchange="handleFiles(this.files)">
        </div>



        <div class="policy">
            <input type="checkbox" name="check" >
            <label for="check">Acepto los <a href="#">Terminos de uso</a> y <a href="#">Política de privacidad</a>. </label>
        </div>

        <div>
            <input class="btn" type="submit" value="Registrarse" onclick="subir()">
        </div>
        
    </div>

    <script>
        var file;
        function handleFiles(files){
            file = files[0];
            if(files[0].type=="image/jpeg"){
                
            }
        }
        
        function subir(){
            if(document.getElementsByName("name")[0].value=="")
                window.location.href ="registrarse.php?error=No se insertó un nombre";
            else if(document.getElementsByName("username")[0].value=="")
                window.location.href ="registrarse.php?error=No se insertó un nombre de usuario";
            else if(document.getElementsByName("email")[0].value=="")
                window.location.href ="registrarse.php?error=No se insertó un email";
            else if(document.getElementsByName("contraseña")[0].value=="")
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
                        document.getElementById("photo").files 
                        let xhttp = new XMLHttpRequest();

                        xhttp.open("POST", "controllers/users_controller.php", true);

                        xhttp.setRequestHeader("Content-type", "application/json");

                        xhttp.onreadystatechange = function() {
                            if (this.readyState === 4) {
                                if (this.status === 200) {
                                    if (this.responseText === "Registro guardado") {
                                        
                                    }
                                }
                                else {
                                    console.log("Error");
                                }
                            }
                        };
                        console.log(file);
                        let data = {
                            _method: 'POST',
                            name: document.getElementsByName("name")[0].value,
                            username: document.getElementsByName("username")[0].value,
                            email: document.getElementsByName("email")[0].value,
                            password: document.getElementsByName("contraseña")[0].value,
                            image: file
                        };
                        xhttp.send(JSON.stringify(data));

                        //window.location.href ="login.php"
            }

        }

    </script>

    
    <div class="info">
        <p>Página creada por: Diego Eugenio Saldívar Narváez</p>
        <p>Materia: Fundamentos Web</p>
    </div>

    
</body>
</html> 