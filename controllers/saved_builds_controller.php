<?php
include ("../models/DB.php");
include ("../models/saved_build.php");

try {
    $connection = DBConnection::getConnection();
}
catch(PDOException $e) {
    error_log("Error de conexión - " . $e, 0);

    exit();
}

session_start();
if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(array_key_exists("idBuild",$_GET)){
        try{
            
            $idBuild = $_GET["idBuild"];

            $query = $connection->prepare('SELECT * FROM saved_builds WHERE (idProfile = :idProfile) AND (idBuild = :idBuild)');
            $query->bindParam(':idProfile',$_SESSION["id"],PDO::PARAM_INT);
            $query->bindParam(':idBuild',$idBuild,PDO::PARAM_INT);
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
            $query = $connection->prepare('SELECT * FROM saved_builds WHERE idProfile = :idProfile');
            $query->bindParam(':idProfile',$_SESSION["id"],PDO::PARAM_INT);
            $query->execute();
            $saved = array();
            
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $saved = new saved_build($row['idBuild'],$row['idProfile']);
                $saveds[] = $saved->getArray();
            }
            echo json_encode($saveds);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
}else if($_SERVER["REQUEST_METHOD"] === "POST"){
        $data = json_decode(file_get_contents("php://input"));
        if ($data->_method === "POST") {
            postSaved($_SESSION["id"],$data->idBuild);
        }else if ($data->_method === "DELETE") {
            deleteSaved($_SESSION["id"],$data->idBuild);
        }
    exit();
}

function postSaved($idProfile,$idBuild){
    global $connection;

    try{
        $query = $connection->prepare('INSERT INTO saved_builds VALUES(NULL,:idBuild,:idProfile)');
        $query->bindParam(':idBuild', $idBuild, PDO::PARAM_INT);
        $query->bindParam(':idProfile', $idProfile, PDO::PARAM_INT);
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

function deleteSaved($idProfile,$idBuild){
    global $connection;

    try{
        $query = $connection->prepare('DELETE FROM saved_builds WHERE (idProfile = :idProfile) AND (idBuild = :idBuild)');
        $query->bindParam(':idProfile', $idProfile, PDO::PARAM_INT);
        $query->bindParam(':idBuild', $idBuild, PDO::PARAM_INT);
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