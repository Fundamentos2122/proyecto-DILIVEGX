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

        <div class="counter">
            <img src="assets/icons/like.svg" alt="" class="i1">
            <p class="like-count">##</p>
            <img src="assets/icons/dislike.svg" alt="" class="i2">
            <p class="dislike-count">##</p>
        </div>
        
        <div class="autor">
            <p>Autor:</p>
            <div>
                <img src="https://picsum.photos/150" alt="">
                <p class="a-name">(Nombre autor)</p>
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
                document.getElementById("name").innerHTML = list.Name;
                document.getElementById("price").innerHTML = "$"+ list.Price;
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
    </script>


</body>
</html> 