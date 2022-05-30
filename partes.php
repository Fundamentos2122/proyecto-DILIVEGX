<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="search.css">
    <title>Document</title>
</head>
<body onresize="change()">
<?php
include 'assets/header/header.php';
$hola = "prueba";
?>

    <div class="filter-bar">
        <img src="assets/icons/filter.svg" alt="" style="cursor: pointer;" onclick="filter()">
    </div>
    <div class="filterclose" id="filter">
        <div>
            <input type="radio" id="all" name="parts" value="all" onclick="filtered(this.id)" checked >
            <label for="cpu">All</label>
        </div>
        <div>
            <input type="radio" id="cpu" name="parts" value="cpu" onclick="filtered(this.id)">
            <label for="cpu">CPU</label>
        </div>
        <div>
            <input type="radio" id="mb" name="parts" value="mb" onclick="filtered(this.id)">
            <label for="mb">MotherBoard</label>
        </div>
        <div>
            <input type="radio" id="cas" name="parts" value="case" onclick="filtered(this.id)">
            <label for="case">Case</label>
        </div>
        <div>
            <input type="radio" id="gpu" name="parts" value="gpu" onclick="filtered(this.id)">
            <label for="gpu">GPU</label>
        </div>
        <div>
            <input type="radio" id="ssd" name="parts" value="ssd" onclick="filtered(this.id)">
            <label for="ssd">SSD</label>
        </div>
        <div>
            <input type="radio" id="cpc" name="parts" value="coo" onclick="filtered(this.id)">
            <label for="coo">CPU Cooler</label>
        </div>
        <div>
            <input type="radio" id="fan" name="parts" value="fan" onclick="filtered(this.id)">
            <label for="fan">Case Fans</label>
        </div>
        <div>
            <input type="radio" id="psu" name="parts" value="psu" onclick="filtered(this.id)">
            <label for="psu">PSU</label>
        </div>
    </div>
    <script src="filter.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            getParts();
        });
        var list;
        function getParts() {
            let xhttp = new XMLHttpRequest();
            xhttp.open("GET",<?php 
                if(array_key_exists("search",$_GET))
                    echo json_encode("controllers/part_controller.php?search=".$_GET["search"]);
                else
                    echo json_encode("controllers/part_controller.php");
                 ?>,true);
            
            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let parts = JSON.parse(this.responseText);
                        list = parts;
                        paintParts();
                    }
                    else{
                        console.log("Error");
                    }
                }
            };

            xhttp.send();

            return [];
            }

            function paintParts() {
            let html = '';

            for(var i = 0; i < list.length; i++) {
                html +=`<div class="card" style="cursor: pointer;" onclick="window.location='http://localhost/proyecto/part.php?id=${list[i].id}'">
                        <img src="data:image/jpg;base64,${list[i].Image}" alt="">
                        <div>
                        <div class="build-info">
                            <p class="build-name">${list[i].Name}</p>
                            <p class="build-name">${list[i].Brand}</p>
                        </div>
                        <div class="build-info">
                            <p>Precio: </p>
                            <p class="build-price">$${list[i].Price}</p>
                        </div>
                        </div>
                    </div>`;
            }

            document.getElementById("busqueda").innerHTML = html; 
        }

        function filtered(id){
            if(id=="all")
                paintParts();
            else{
            let html = '';
            for(var i = 0; i < list.length; i++) 
                if(id==list[i].Type)
                html +=`<div class="card" style="cursor: pointer;" onclick="window.location='http://localhost/proyecto/part.php?id=${list[i].id}'">
                        <img src="data:image/jpg;base64,${list[i].Image}" alt="">
                        <div>
                        <div class="build-info">
                            <p class="build-name">${list[i].Name}</p>
                            <p class="build-name">${list[i].Brand}</p>
                        </div>
                        <div class="build-info">
                            <p>Precio: </p>
                            <p class="build-price">$${list[i].Price}</p>
                        </div>
                        </div>
                    </div>`;
            
            document.getElementById("busqueda").innerHTML = html; 
        }
            
        }
    </script>
    <div id="busqueda">
            
    </div>


</body>
</html> 