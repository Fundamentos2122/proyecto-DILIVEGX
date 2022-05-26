<?php

use function PHPSTORM_META\type;

include ("../models/DB.php");
include ("../models/part.php");
//include ("../models/build.php");


try {
    $connection = DBConnection::getConnection();
}
catch(PDOException $e) {
    error_log("Error de conexión - " . $e, 0);

    exit();
}



if($_SERVER["REQUEST_METHOD"] === "GETcpus"){
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

}

if($_SERVER["REQUEST_METHOD"] === "GETgpus"){
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

}

if($_SERVER["REQUEST_METHOD"] === "GETparts"){
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
}











?>