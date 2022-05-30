<?php
include ("../models/DB.php");
include ("../models/favorite_part.php");

try {
    $connection = DBConnection::getConnection();
}
catch(PDOException $e) {
    error_log("Error de conexión - " . $e, 0);

    exit();
}

session_start();
if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(array_key_exists("idPart",$_GET)){
        try{
            
            $idPart = $_GET["idPart"];

            $query = $connection->prepare('SELECT * FROM favorite_parts WHERE (idProfile = :idProfile) AND (idPart = :idPart)');
            $query->bindParam(':idProfile',$_SESSION["id"],PDO::PARAM_INT);
            $query->bindParam(':idPart',$idPart,PDO::PARAM_INT);
            $query->execute();

            $exist = false;

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $exist = true;
            }
            echo json_encode($exist);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    else{
        try{
            $query = $connection->prepare('SELECT * FROM favorite_parts WHERE idProfile = :idProfile');
            $query->bindParam(':idProfile',$_SESSION["id"],PDO::PARAM_INT);
            $query->execute();
            $favorite = array();
            
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $favorite = new favorite_part($row['idPart'],$row['idProfile']);
                $favorites[] = $favorite->getArray();
            }
            echo json_encode($favorites);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
}else if($_SERVER["REQUEST_METHOD"] === "POST"){
        $data = json_decode(file_get_contents("php://input"));
        if ($data->_method === "POST") {
            postFavorite($_SESSION["id"],$data->idPart);
        }else if ($data->_method === "DELETE") {
            deleteFavorite($_SESSION["id"],$data->idPart);
        }
    exit();
}

function postFavorite($idProfile,$idPart){
    global $connection;

    try{
        $query = $connection->prepare('INSERT INTO favorite_parts VALUES(NULL,:idProfile,:idPart)');
        $query->bindParam(':idProfile', $idProfile, PDO::PARAM_INT);
        $query->bindParam(':idPart', $idPart, PDO::PARAM_INT);
        $query->execute();

        if($query->rowCount() === 0){
            echo "Error en la inserción";
        }
        else{
             echo "Registro guardado";
        }
    }
    catch(PDOException $e){
        echo $e;
    }
}

function deleteFavorite($idProfile,$idPart){
    global $connection;

    try{
        $query = $connection->prepare('DELETE FROM favorite_parts WHERE (idProfile = :idProfile) AND (idPart = :idPart)');
        $query->bindParam(':idProfile', $idProfile, PDO::PARAM_INT);
        $query->bindParam(':idPart', $idPart, PDO::PARAM_INT);
        $query->execute();

        if($query->rowCount() === 0){
            echo "Error en la inserción";
        }
        else{
             echo "Registro borrado";
        }
    }
    catch(PDOException $e){
        echo $e;
    }
}


?>