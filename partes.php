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
?>

    <div class="filter-bar">
        <img src="assets/icons/filter.svg" alt="" style="cursor: pointer;" onclick="filter()">

    </div>


    <div class="filterclose" id="filter">
        <div>
            <input type="radio" id="cpu" name="parts" value="cpu" checked>
            <label for="cpu">CPU</label>
        </div>
        <div>
            <input type="radio" id="mb" name="parts" value="mb">
            <label for="mb">MotherBoard</label>
        </div>
        <div>
            <input type="radio" id="case" name="parts" value="case">
            <label for="case">Case</label>
        </div>
        <div>
            <input type="radio" id="gpu" name="parts" value="gpu">
            <label for="gpu">GPU</label>
        </div>
        <div>
            <input type="radio" id="ssd" name="parts" value="ssd">
            <label for="ssd">SSD</label>
        </div>
        <div>
            <input type="radio" id="coo" name="parts" value="coo">
            <label for="coo">CPU Cooler</label>
        </div>
        <div>
            <input type="radio" id="fan" name="parts" value="fan">
            <label for="fan">Case Fans</label>
        </div>
        <div>
            <input type="radio" id="psu" name="parts" value="psu">
            <label for="psu">PSU</label>
        </div>
    </div>

    <script src="filter.js"></script>

    <div id="busqueda">
            
    </div>

    <script src="generator-search.js"></script>

</body>
</html> 