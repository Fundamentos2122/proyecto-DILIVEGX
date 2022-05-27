<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="build.css">
    <title>Document</title>
</head>
<body onresize="change()">
<?php
include 'assets/header/header.php';
?>

    <div class="build-header">
        <h1 class="name" id="name">
            (build name)
        </h1>

        <div class="counter" id="cou">
            <img src="assets/icons/like.png" alt="" class="i1" id="like" style="cursor: pointer;">
            <p class="like-count" id="countL"></p>
            <img src="assets/icons/dislike.png" alt="" class="i2" id="dislike" style="cursor: pointer;">
            <p class="dislike-count" id="countD"></p>
        </div>
        
        <div class="autor">
            <p>Autor:</p>
            <div>
                <img src="assets/icons/account.png" alt="">
                <p class="a-name" id="autor">(Nombre autor)</p>
            </div>
        </div>
        </div>
    </div>
    <div class="parts" id="parts">

    </div>
    <div class="final">
        <div>
            <p class="price">Total:</p>
            <p class="total-price" id="price">$####</p>
        </div>
        <button>Exportar como PDF</button>
    </div>
    
    <script>
    var id;

    document.addEventListener("DOMContentLoaded", function(){
        getBuild();
    });

        function getBuild(){
        let xhttp = new XMLHttpRequest();

        xhttp.open("GET",`controllers/build_controller.php?id=${<?php echo $_GET["id"] ?>}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    console.log(this.responseText);
                    let list = JSON.parse(this.responseText);
                    document.getElementById("countL").innerHTML = list.CantLikes;
                    document.getElementById("countD").innerHTML = list.CantDisLikes;
                    document.getElementById("name").innerHTML = list.Name;
                    document.getElementById("price").innerHTML = "$"+ list.Price;
                    id = list.id;
                    getAutor(list.id);
                    printBuild(list);
                }
                else{
                    console.log("Error");
                }
            }
        };

        xhttp.send();

        return [];
    }

    function printBuild(list){

        //cpu
            let xhttp = new XMLHttpRequest();
            xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idCPU}`,true);
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let part = JSON.parse(this.responseText);
                        document.getElementById("parts").innerHTML += ` <div onclick="location.href='part.php?id=${part.id}';"><p>CPU:</p>
                        <p>${part.Name}</p>
                        <p class="price"> $${part.Price}</p></div>`
                        printmb();
                    }
                    else{
                        console.log("Error");
                    }
                }
            };
            xhttp.send();
        function printmb(){
        //mb
            let xhttp = new XMLHttpRequest();
            xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idMB}`,true);
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let part = JSON.parse(this.responseText);
                        document.getElementById("parts").innerHTML += `<div onclick="location.href='part.php?id=${part.id}';"><p>MotherBoard:</p>
                    <p>${part.Name}</p>
                    <p class="price"> $${part.Price}</p></div>`
                    printcas();
                    }
                    else{
                        console.log("Error");
                    }
                }
            };
            xhttp.send();
        }
        function printcas(){
        //case
            let xhttp = new XMLHttpRequest();
            xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idCAS}`,true);
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let part = JSON.parse(this.responseText);
                        document.getElementById("parts").innerHTML += `<div onclick="location.href='part.php?id=${part.id}';"><p>Case:</p>
                <p>${part.Name}</p>
                <p class="price"> $${part.Price}</p></div>`
                    printgpu();
                    }
                    else{
                        console.log("Error");
                    }
                }
            };
            xhttp.send();
        }
        function printgpu(){
        //gpu
            let xhttp = new XMLHttpRequest();
            xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idGPU}`,true);
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let part = JSON.parse(this.responseText);
                        document.getElementById("parts").innerHTML += `<div onclick="location.href='part.php?id=${part.id}';"><p>GPU:</p>
                <p>${part.Name}</p>
                <p class="price"> $${part.Price}</p></div>`
                    printssd();
                    }
                    else{
                        console.log("Error");
                    }
                }
            };
            xhttp.send();
        }
        function printssd(){
        //ssd
            let xhttp = new XMLHttpRequest();
            xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idSSD}`,true);
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let part = JSON.parse(this.responseText);
                        document.getElementById("parts").innerHTML += `<div onclick="location.href='part.php?id=${part.id}';"><p>SSD:</p>
                <p>${part.Name}</p>
                <p class="price"> $${part.Price}</p></div>`
                    printcpc();
                    }
                    else{
                        console.log("Error");
                    }
                }
            };
            xhttp.send();
        }
        function printcpc(){
        //cpc
            let xhttp = new XMLHttpRequest();
            xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idCPC}`,true);
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let part = JSON.parse(this.responseText);
                        document.getElementById("parts").innerHTML += `<div onclick="location.href='part.php?id=${part.id}';"><p>CPU Cooler:</p>
                <p>${part.Name}</p>
                <p class="price"> $${part.Price}</p></div>`
                    printfan();
                    }
                    else{
                        console.log("Error");
                    }
                }
            };
            xhttp.send();
        }
        function printfan(){
        //fan
            let xhttp = new XMLHttpRequest();
            xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idFAN}`,true);
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let part = JSON.parse(this.responseText);
                        document.getElementById("parts").innerHTML += `<div onclick="location.href='part.php?id=${part.id}';"><p>Case Fans:</p>
                <p>${part.Name}</p>
                <p class="price"> $${part.Price}</p></div>`
                    printpsu();
                    }
                    else{
                        console.log("Error");
                    }
                }
            };
            xhttp.send();
        }
        function printpsu(){
        //psu
            let xhttp = new XMLHttpRequest();
            xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idPSU}`,true);
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let part = JSON.parse(this.responseText);
                        document.getElementById("parts").innerHTML += `<div onclick="location.href='part.php?id=${part.id}';"><p>PSU:</p>
                <p>${part.Name}</p>
                <p class="price"> $${part.Price}</p></div>`
                    }
                    else{
                        console.log("Error");
                    }
                }
            };
            xhttp.send();
        }
        
    }

    function getAutor(id){
        let xhttp = new XMLHttpRequest();

        xhttp.open("GETuser",`controllers/users_controller.php?id=${id}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    console.log(this.responseText);
                    let list = JSON.parse(this.responseText);
                    document.getElementById("autor").innerHTML = list.UserName;
                }
                else{
                    console.log("Error");
                }
            }
        };

        xhttp.send();

        return [];
    }

    document.getElementById("like").onclick = function(){
        document.getElementById("countL").innerHTML = parseInt(document.getElementById("countL").innerHTML)+1;
        document.getElementById("like").src = "assets/icons/likef.png";
        document.getElementById("cou").style.pointerEvents = "none";
        let xhttp = new XMLHttpRequest();

                        xhttp.open("POSTL", "controllers/build_controller.php", true);

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
                            _method: 'PUT',
                            id: id
                        };
                        xhttp.send(JSON.stringify(data));
    };
    document.getElementById("dislike").onclick = function(){
        document.getElementById("countD").innerHTML = parseInt(document.getElementById("countD").innerHTML)+1;
        document.getElementById("dislike").src = "assets/icons/dislikef.png";
        document.getElementById("cou").style.pointerEvents = "none";
                        let xhttp = new XMLHttpRequest();
                        xhttp.open("POSTD", "controllers/build_controller.php", true);

                        xhttp.setRequestHeader("Content-type", "application/json");

                        xhttp.onreadystatechange = function() {
                            if (this.readyState === 4) {
                                if (this.status === 200) {
                                    if (this.responseText === "Registro guardado") {
                                        getBuild()
                                    }
                                }
                                else {
                                    console.log("Error");
                                }
                            }
                        };
                        let data = {
                            _method: 'PUT',
                            id: id
                        };
                        xhttp.send(JSON.stringify(data));
    };
    </script>


</body>
</html> 