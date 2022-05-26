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
    <link rel="stylesheet" href="newbuild.css">
    <title>Document</title>
</head>
<body onresize="change()">
<?php
    include 'assets/header/header.php';
?>
<div id="print">
    <h1>
        Nueva Build
    </h1>

    <p class="part-title">*CPU</p>
    <div class="part" id="cpu">
        
    </div>

    <p class="part-title">*MotherBoard</p>
    <div class="part" id="mb">
        
    </div>

    <p class="part-title">*RAM</p>
    <div class="part" id="ram">
        
    </div>

    <p class="part-title">*Case</p>
    <div class="part" id="cas">
        
    </div>

    <p class="part-title">GPU</p>
    <div class="part" id="gpu">
        
    </div>

    <p class="part-title">SSD</p>
    <div class="part" id="ssd">
        
    </div>

    <p class="part-title">CPU Cooler</p>
    <div class="part" id="cpc">
        
    </div>

    <p class="part-title">Case Fans</p>
    <div class="part" id="fan">
        
    </div>

    <p class="part-title">*PSU</p>
    <div class="part" id="psu">    
    </div>
</div>
    <div class="actions" id ="btns" style="display: none;">
        <div>
            <?php
                if (array_key_exists("id", $_SESSION))
                    echo '<input type="text" class="build-name" placeholder="Nombre de la build">
                    <button onclick="saveBuild(); location.href=`cuenta-builds.php`;">Guardar en tu perfil</button>';
            ?>
        </div>
        <div>
            <button id="pdf">Exportar como PDF</button>
        </div>
    </div>
    <script src="generator-newbuild.js"></script>
    <script src = "pdflibrary/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById("pdf").onclick = function(){
            var opt = {
                margin: 0,
                filename: 'build.pdf',
                image: {type: 'jpeg', quality: 0.98},
                html2canvas: {scale: 1},
                jsPDF: {unit: 'in', format: 'letter', orientation: 'portrait'}
            };
            html2pdf(document.getElementById("print"), opt)
        };
    </script>
    <script>
        function saveBuild(){
        var build_name;
        if(document.getElementsByClassName("build-name")[0].value=="")
            build_name = "(No name)";
        else
            build_name = document.getElementsByClassName("build-name")[0].value;
        let xhttp = new XMLHttpRequest();

        xhttp.open("POST", "controllers/build_controller.php", true);

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
        
        let data = {
            _method: 'POST',
            name: build_name,
            autor: <?php echo $_SESSION["id"] ?>,
            cpu: cpu,
            mb: mb,
            ram: ram,
            cas: cas,
            gpu: gpu,
            ssd: ssd,
            cpc: cpc,
            psu: psu,
            fan: fan,
            price: price,
            image: image
        };
        xhttp.send(JSON.stringify(data));
    }
    </script>
    
    <div class="info">
        <p>Página creada por: Diego Eugenio Saldívar Narváez</p>
        <p>Materia: Fundamentos Web</p>
    </div>
    
</body>
</html> 