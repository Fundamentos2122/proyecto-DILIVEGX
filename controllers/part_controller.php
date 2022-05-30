<?php

use function PHPSTORM_META\type;

include ("../models/DB.php");
include ("../models/part.php");


try {
    $connection = DBConnection::getConnection();
}
catch(PDOException $e) {
    error_log("Error de conexión - " . $e, 0);

    exit();
}


if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(array_key_exists("id",$_GET)){
        try{
            $id = $_GET["id"];

            $query = $connection->prepare('SELECT * FROM part WHERE id = :id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->execute();

            $part;

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);
            }
            echo json_encode($part->getArray());
        }
        catch(PDOException $e){
            echo $e;
        }
    }if(array_key_exists("search",$_GET)){
        try{
            $search = "%".$_GET["search"]."%";
            $query = $connection->prepare('SELECT DISTINCT * FROM part WHERE (Name LIKE :search) OR (Brand LIKE :search2) OR (Type LIKE :search3)');
            $query->bindParam(':search',$search,PDO::PARAM_STR);
            $query->bindParam(':search2',$search,PDO::PARAM_STR);
            $query->bindParam(':search3',$search,PDO::PARAM_STR);
            $query->execute();
            $parts = array();


            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);

                $parts[] = $part->getArray();
            }
            echo json_encode($parts);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    else{

        try{
            $query = $connection->prepare('SELECT * FROM part');
            $query->execute();
            $parts = array();


            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);

                $parts[] = $part->getArray();
            }
            echo json_encode($parts);
        }
        catch(PDOException $e){
            echo $e;
        }
    }

}else if($_SERVER["REQUEST_METHOD"] === "GETcpus"){
    if(array_key_exists("id",$_GET)){
        try{
            $id = $_GET["id"];

            $query = $connection->prepare('SELECT * FROM part WHERE id = :id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->execute();

            $part;

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);
            }
            echo json_encode($part->getArray());
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    else{

        try{
            $query = $connection->prepare('SELECT * FROM part WHERE Type = "cpu"');
            $query->execute();
            $parts = array();


            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);

                $parts[] = $part->getArray();//Push
            }
            echo json_encode($parts);
        }
        catch(PDOException $e){
            echo $e;
        }
    }

}else if($_SERVER["REQUEST_METHOD"] === "GETgpus"){
    if(array_key_exists("id",$_GET)){
        try{
            $id = $_GET["id"];

            $query = $connection->prepare('SELECT * FROM part WHERE id = :id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->execute();

            $part;


            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);

            }
            echo json_encode($part->getArray());
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    else{

        try{
            $query = $connection->prepare('SELECT * FROM part WHERE Type = "gpu"');
            $query->execute();
            $parts = array();


            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);

                $parts[] = $part->getArray();//Push
            }
            echo json_encode($parts);
        }
        catch(PDOException $e){
            echo $e;
        }
    }

}elseif($_SERVER["REQUEST_METHOD"] === "GETparts"){
    if(array_key_exists("socket",$_GET)){
        $socket = $_GET["socket"];
        $type = $_GET["type"];
        try{
            $query = $connection->prepare('SELECT * FROM part WHERE Type = :type AND Socket = :socket');
            $query->bindParam(':type', $type, PDO::PARAM_INT);
            $query->bindParam(':socket', $socket, PDO::PARAM_INT);
            $query->execute();
            $parts = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);

                $parts[] = $part->getArray();
            }
            echo json_encode($parts);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    else if(array_key_exists("ddr",$_GET)){
        $ddr = $_GET["ddr"];
        $type = $_GET["type"];
        try{
            $query = $connection->prepare('SELECT * FROM part WHERE Type = :type AND Ddr = :ddr');
            $query->bindParam(':type', $type, PDO::PARAM_INT);
            $query->bindParam(':ddr', $ddr, PDO::PARAM_INT);
            $query->execute();
            $parts = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);

                $parts[] = $part->getArray();
            }
            echo json_encode($parts);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    else if(array_key_exists("formfactor",$_GET)){
        $formfactor = $_GET["formfactor"];
        $type = $_GET["type"];
        try{
            $query = $connection->prepare('SELECT * FROM part WHERE Type = :type AND FormFactor = :formfactor');
            $query->bindParam(':type', $type, PDO::PARAM_INT);
            $query->bindParam(':formfactor', $formfactor, PDO::PARAM_INT);
            $query->execute();
            $parts = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);

                $parts[] = $part->getArray();
            }
            echo json_encode($parts);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    else{
        $type = $_GET["type"];
        try{
            $query = $connection->prepare('SELECT * FROM part WHERE Type = :type');
            $query->bindParam(':type', $type, PDO::PARAM_INT);
            $query->execute();
            $parts = array();


            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                $part = new part($row['id'],$row['Type'],$row['Name'],$row['Description'],$row['Price'],$row['Image'],$row['Socket'],$row['FormFactor'],$row['Wattage'],$row['Brand'],$row['InternalGPU'],$row['Ddr']);

                $parts[] = $part->getArray();
            }
            echo json_encode($parts);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
}else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (array_key_exists("name", $_POST)) {
    $type = trim($_POST["types"]);
    $name = trim($_POST["name"]);
    $desc = trim($_POST["desc"]);
    $price = trim($_POST["price"]);
    $photo = "";
    if (sizeof($_FILES) > 0) {
        $tmp_name = $_FILES["photo"]["tmp_name"];

        $photo = file_get_contents($tmp_name);
    }
    $socket = trim($_POST["socket"]);
    if($socket == "")
    $socket = null;
    $ff = trim($_POST["ff"]);
    if($ff == "")
    $ff = null;
    $wat = trim($_POST["wat"]);
    if($wat == "")
    $wat = null;
    $brand = trim($_POST["brand"]);
    $ddr = trim($_POST["ddr"]);
    if($ddr == "")
    $ddr = null;
    if (sizeof($_FILES) > 0) {
        $tmp_name = $_FILES["photo"]["tmp_name"];

        $photo = file_get_contents($tmp_name);
    }
    postPart($type, $name, $desc, $price, $photo, $socket, $ff, $wat, $brand, $ddr);
    }
}

function postPart($type, $name, $desc, $price, $photo, $socket, $ff, $wat, $brand, $ddr){
    global $connection;
    
    try {
        $query = $connection->prepare('INSERT INTO part VALUES(NULL,:type,:name,:desc,:price,:photo,:socket,:ff,:wat,:brand,NULL,:ddr)');
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':desc', $desc, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_INT);
        $query->bindParam(':photo', $photo, PDO::PARAM_STR);
        $query->bindParam(':socket', $socket, PDO::PARAM_STR);
        $query->bindParam(':ff', $ff, PDO::PARAM_STR);
        $query->bindParam(':wat', $wat, PDO::PARAM_INT);
        $query->bindParam(':brand', $brand, PDO::PARAM_STR);
        $query->bindParam(':ddr', $ddr, PDO::PARAM_INT);
        $query->execute();
        

        if($query->rowCount() === 0) {
            echo "Error en la inserción";
        }
        else {
            //header('Location: http://localhost/proyecto/login.php');
        }
    }
    catch(PDOException $e) {
        echo $e;
    }
}











?>