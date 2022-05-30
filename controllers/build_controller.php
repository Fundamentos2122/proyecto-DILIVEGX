<?php

include ("../models/DB.php");
include ("../models/build.php");

try {
    $connection = DBConnection::getConnection();
}
catch(PDOException $e) {
    error_log("Error de conexión - " . $e, 0);

    exit();
}


if($_SERVER["REQUEST_METHOD"] === "GETuser"){
    session_start();
    if(array_key_exists("id",$_SESSION)){
        try{
            $id = $_SESSION["id"];

            $query = $connection->prepare('SELECT * FROM build WHERE idAutor = :id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->execute();
            $builds = array();

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $build = new build($row['id'],$row['Name'],$row['idAutor'],$row['idCPU'],$row['idMB'],$row['idCAS'],$row['idGPU'],$row['idSSD'],$row['idCPC'],$row['idPSU'],$row['idRAM'],$row['idFAN'],$row['CantLikes'],$row['CantDisLikes'],$row['Price'],$row['Image']);
                $builds[] = $build->getArray();
            }
            echo json_encode($builds);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
}else if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(array_key_exists("id",$_GET)){
        try{
            $id = $_GET["id"];

            $query = $connection->prepare('SELECT * FROM build WHERE id = :id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->execute();

            $build;

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $build = new build($row['id'],$row['Name'],$row['idAutor'],$row['idCPU'],$row['idMB'],$row['idCAS'],$row['idGPU'],$row['idSSD'],$row['idCPC'],$row['idPSU'],$row['idRAM'],$row['idFAN'],$row['CantLikes'],$row['CantDisLikes'],$row['Price'],$row['Image']);
            }
            echo json_encode($build->getArray());
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    else{
        try{
            $query = $connection->prepare('SELECT * FROM build');
            $query->execute();
            $builds = array();

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $build = new build($row['id'],$row['Name'],$row['idAutor'],$row['idCPU'],$row['idMB'],$row['idCAS'],$row['idGPU'],$row['idSSD'],$row['idCPC'],$row['idPSU'],$row['idRAM'],$row['idFAN'],$row['CantLikes'],$row['CantDisLikes'],$row['Price'],$row['Image']);
                $builds[] = $build->getArray();
            }
            echo json_encode($builds);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
}
else if($_SERVER["REQUEST_METHOD"] === "POST"){
    if (array_key_exists("cpu", $_POST)) {
        //Utilizar el arreglo $_POST
        if ($_POST["_method"] === "POST") {
            //Registro nuevo
            postBuild($_POST["name"],$_POST["autor"],$_POST["cpu"],$_POST["mb"],$_POST["ram"],$_POST["cas"],$_POST["gpu"],$_POST["ssd"],$_POST["cpc"],$_POST["psu"],$_POST["fan"],0,0,$_POST["price"],base64_decode($_POST["image"]), true);
        }
        else if ($_POST["_method"] === "PUT") {
            putBuild($_POST["id"],$_POST["name"],$_POST["autor"],$_POST["cpu"],$_POST["mb"],$_POST["ram"],$_POST["cas"],$_POST["gpu"],$_POST["ssd"],$_POST["cpc"],$_POST["psu"],$_POST["fan"],0,0,$_POST["price"],base64_decode($_POST["image"]), true);
        }
    }
    else if (array_key_exists("id", $_POST)) {
        if ($_POST["_method"] === "DELETE") {
            deleteBuild($_POST["id"], true);
        }
    }
    else {
        //Utilizar file_get_contents
        $data = json_decode(file_get_contents("php://input"));

        if ($data->_method === "POST") {
            postBuild($data->name,$data->autor,$data->cpu,$data->mb,$data->ram,$data->cas,$data->gpu,$data->ssd,$data->cpc,$data->psu,$data->fan,0,0,$data->price,base64_decode($data->image), false);
        }
        else if($data->_method === "PUT") {
            putBuild($data->id,$data->name,$data->autor,$data->cpu,$data->mb,$data->ram,$data->cas,$data->gpu,$data->ssd,$data->cpc,$data->psu,$data->fan,$data->CantLikes,$data->CantDisLikes,$data->price,base64_decode($data->image), false);
        }else if ($data->_method === "DELETE") {
            deleteBuild($data->id, true);
        }
    }
    exit();
}
else if($_SERVER["REQUEST_METHOD"] === "POSTL"){
    if (array_key_exists("id", $_POST)) {
            putBuildL($_POST["id"]);
    }
    else {
        $data = json_decode(file_get_contents("php://input"));
            putBuildL($data->id);
    }
    exit();
}
else if($_SERVER["REQUEST_METHOD"] === "POSTD"){
    if (array_key_exists("id", $_POST)) {
            putBuildD($_POST["id"]);
    }
    else {
        $data = json_decode(file_get_contents("php://input"));
            putBuildD($data->id);
    }
    exit();
}

function putBuildL($id){
    global $connection;
    try{
        $query = $connection->prepare('UPDATE build SET CantLikes = CantLikes+1 WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        if($query->rowCount() === 0){
            echo "Error en la actualización";
        }
        else{
            echo "Registro actualizado";
        }
    }
    catch(PDOException $e){
        echo $e;
    }
}
function putBuildD($id){
    global $connection;
    try{
        $query = $connection->prepare('UPDATE build SET CantDisLikes = CantDisLikes+1 WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        if($query->rowCount() === 0){
            echo "Error en la actualización";
        }
        else{
            echo "Registro actualizado";
        }
    }
    catch(PDOException $e){
        echo $e;
    }
}


function postBuild($name,$autor,$cpu,$mb,$ram,$cas,$gpu,$ssd,$cpc,$psu,$fan,$CantLikes,$CantDisLikes,$price,$image, $redirect){
    global $connection;

    try{
        $query = $connection->prepare('INSERT INTO build VALUES(NULL,:name , :autor, :cpu, :mb, :cas, :gpu, :ssd, :cpc, :psu, :ram, :fan, :CantLikes, :CantDisLikes, :Price, :Image)');
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':autor', $autor, PDO::PARAM_INT);
        $query->bindParam(':cpu', $cpu, PDO::PARAM_INT);
        $query->bindParam(':mb', $mb, PDO::PARAM_INT);
        $query->bindParam(':ram', $ram, PDO::PARAM_INT);
        $query->bindParam(':cas', $cas, PDO::PARAM_INT);
        $query->bindParam(':gpu', $gpu, PDO::PARAM_INT);
        $query->bindParam(':ssd', $ssd, PDO::PARAM_INT);
        $query->bindParam(':cpc', $cpc, PDO::PARAM_INT);
        $query->bindParam(':psu', $psu, PDO::PARAM_INT);
        $query->bindParam(':fan', $fan, PDO::PARAM_INT);
        $query->bindParam(':CantLikes', $CantLikes, PDO::PARAM_INT);
        $query->bindParam(':CantDisLikes', $CantDisLikes, PDO::PARAM_INT);
        $query->bindParam(':Price', $price, PDO::PARAM_INT);
        $query->bindParam(':Image', $image, PDO::PARAM_STR);
        $query->execute();

        if($query->rowCount() === 0){
            echo "Error en la inserción";
        }
        else{
             echo "Registro guardado";
            if($redirect){

            }
            else{
                echo "Registro guardado";
            }
        }

    }
    catch(PDOException $e){
        echo $e;
    }
}

function putBuild($id,$name,$autor,$cpu,$mb,$ram,$cas,$gpu,$ssd,$cpc,$psu,$fan,$CantLikes,$CantDisLikes,$price,$image, $redirect){
    global $connection;

    try{
        $query = $connection->prepare('UPDATE build SET Name = :name, idAutor = :autor, idCPU = :cpu, idMB = :mb, idCAS = :cas, idGPU = :gpu, idSSD = :ssd, idCPC = :cpc, idPSU = psu, idRAM = ram, idFAN = fan, CantLikes=:CantLikes, CantDisLikes=:CantDisLikes,Price=:price,Image=:image, WHERE id = :id');//Para actualizar es con una coma
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':autor', $autor, PDO::PARAM_INT);
        $query->bindParam(':cpu', $cpu, PDO::PARAM_INT);
        $query->bindParam(':mb', $mb, PDO::PARAM_INT);
        $query->bindParam(':ram', $ram, PDO::PARAM_INT);
        $query->bindParam(':cas', $cas, PDO::PARAM_INT);
        $query->bindParam(':gpu', $gpu, PDO::PARAM_INT);
        $query->bindParam(':ssd', $ssd, PDO::PARAM_INT);
        $query->bindParam(':cpc', $cpc, PDO::PARAM_INT);
        $query->bindParam(':psu', $psu, PDO::PARAM_INT);
        $query->bindParam(':fan', $fan, PDO::PARAM_INT);
        $query->bindParam(':CantLikes', $CantLikes, PDO::PARAM_INT);
        $query->bindParam(':CantDisLikes', $CantDisLikes, PDO::PARAM_INT);
        $query->bindParam(':price', $price, PDO::PARAM_INT);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->execute();

        if($query->rowCount() === 0){
            echo "Error en la actualización";
        }
        else{
            echo "Registro actualizado";
            if($redirect){
            }
            else{
                echo "Registro actualizado";
            }
        }

    }
    catch(PDOException $e){
        echo $e;
    }

}

function deleteBuild($id,$redirect){
    global $connection;

    try{
        $query = $connection->prepare('DELETE FROM build WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        if($query->rowCount() === 0){
            echo "Error en la eliminación";
        }
        else{
            if($redirect){
            }
            else{
                echo "Registro eliminado";
            }
        }

    }
    catch(PDOException $e){
        echo $e;
    }
}

?>