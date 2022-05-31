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

    
    <div id="adminmenu" style="display: none;">
    <script src = "assets/js/admin-edit.js"></script>
    <p class="title">
        Editar parte
    </p>
    <form class="form" action="controllers/part_controller.php" onsubmit="return chequeo()" method="POST" autocomplete="off" enctype="multipart/form-data">
        <div>
            <?php
                if (array_key_exists("error", $_GET)) 
                    echo '<p style="color:red;">' .$_GET["error"]. '</p>';
            ?>
        </div>
        <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
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
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="input-group">
            <label for="desc">*Descripción: </label>
            <input type="text" name="desc" class="form-control" id="desc">
        </div>
        <div class="input-group">
            <label for="price">*Precio(MXN): </label>
            <input type="number" name="price" class="form-control" id="price">
        </div>
        <div class="input-group">
            <label for="brand">*Marca: </label>
            <input type="text" name="brand" class="form-control" id="brand">
        </div>
        <div class="input-group">
            <label for="socket">*Socket(CPU MB): </label>
            <input type="text" name="socket" class="form-control" id="socket">
        </div>
        <div class="input-group">
            <label for="ff">*Factor de forma(Case MB):</label>
            <input type="text" name="ff" class="form-control" id="ff">
        </div>
        <div class="input-group">
            <label for="wat">Consumo(W): </label>
            <input type="number" name="wat" class="form-control" id="wat">
        </div>
        <div class="input-group">
            <label for="ddr">*Ddr(MB RAM):</label>
            <input type="number" name="ddr" class="form-control" id="ddr">
        </div>
        <div class="input-group">
                <label for="photo">*Imagen(No subir nada si se desea mantener):</label>
                <input type="file" name="photo" id="photo" onchange="handleFiles(this.files)" accept=".jpg">
        </div>
        <button class="btn" style="cursor: pointer;">Editar parte</button>
        <button class="btn" style="cursor: pointer;">Eliminar parte</button>
    </form>
    </div>
    <script>
        var id;
        document.addEventListener("DOMContentLoaded", function(){
            checkAdmin();
            setall();
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
        function setall(){
            if(<?php 
                if(array_key_exists("id",$_GET))
                        echo json_encode(true);
                else
                        echo json_encode(false);
                ?>==true){
                var type =<?php if(array_key_exists("type",$_GET)) echo json_encode($_GET["type"]); else echo json_encode("") ?>;

                        let xhttp = new XMLHttpRequest();

                        xhttp.open("GETcpus","controllers/part_controller.php?id=<?php echo $_GET['id'];?>",true);

                        xhttp.onreadystatechange = function(){
                            if(this.readyState === 4){
                                if(this.status === 200){
                                    let part = JSON.parse(this.responseText);
                                    id = part.id;
                                    if(part.Type == "cpu")
                                        document.getElementById("types").selectedIndex = 0;
                                    else if(part.Type == "mb")
                                        document.getElementById("types").selectedIndex = 1;
                                    else if(part.Type == "cas")
                                        document.getElementById("types").selectedIndex = 2;
                                    else if(part.Type == "gpu")
                                        document.getElementById("types").selectedIndex = 3;
                                    else if(part.Type == "ssd")
                                        document.getElementById("types").selectedIndex = 4;
                                    else if(part.Type == "cpc")
                                        document.getElementById("types").selectedIndex = 5;
                                    else if(part.Type == "psu")
                                        document.getElementById("types").selectedIndex = 6;
                                    else if(part.Type == "ram")
                                        document.getElementById("types").selectedIndex = 7;
                                    else if(part.Type == "fan")
                                        document.getElementById("types").selectedIndex = 8;

                                    document.getElementById("name").value = part.Name;
                                    document.getElementById("desc").value = part.Description;
                                    document.getElementById("price").value = part.Price;
                                    document.getElementById("brand").value = part.Brand;
                                    document.getElementById("socket").value = part.Socket;
                                    document.getElementById("ff").value = part.FormFactor;
                                    document.getElementById("wat").value = part.Wattage;
                                    document.getElementById("ddr").value = part.Ddr;


                                }
                                else{
                                    console.log("Error");
                                }
                            }
                        };

                        xhttp.send();

                        return [];



                }



        } 
    </script>
</body>
</html> 