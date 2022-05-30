<?php 

include("../models/DB.php");
include("../models/review.php");

try {
    $connection = DBConnection::getConnection();
}
catch(PDOException $e) {
    error_log("Error de conexión - " . $e, 0);

    exit();
}

if($_SERVER["REQUEST_METHOD"] === "GETPart"){
    try{
        $id = $_GET["id"];

        $query = $connection->prepare('SELECT * FROM review WHERE idParte = :id');
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $reviews = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $review = new review($row['id'],$row['idAutor'],$row['idParte'],$row['CantLikes'],$row['CantDisLikes'],$row['CantReport'],$row['Review']);
            $reviews[] = $review->getArray();
        }
        echo json_encode($reviews);
    }
    catch(PDOException $e){
        echo $e;
    }
}
else if($_SERVER["REQUEST_METHOD"] === "GETUser"){
    session_start();
    try{
        $id = $_SESSION["id"];

        $query = $connection->prepare('SELECT * FROM review WHERE idAutor = :id');
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $reviews = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $review = new review($row['id'],$row['idAutor'],$row['idParte'],$row['CantLikes'],$row['CantDisLikes'],$row['CantReport'],$row['Review']);
            $reviews[] = $review->getArray();
        }
        echo json_encode($reviews);
    }
    catch(PDOException $e){
        echo $e;
    }
}
else if($_SERVER["REQUEST_METHOD"] === "GETReported"){
    try{
        $query = $connection->prepare('SELECT * FROM review WHERE CantReport > 0');
        $query->execute();
        $reviews = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $review = new review($row['id'],$row['idAutor'],$row['idParte'],$row['CantLikes'],$row['CantDisLikes'],$row['CantReport'],$row['Review']);
            $reviews[] = $review->getArray();
        }
        echo json_encode($reviews);
    }
    catch(PDOException $e){
        echo $e;
    }
}else if($_SERVER["REQUEST_METHOD"] === "POST"){
    if (array_key_exists("idParte", $_POST)) {
            session_start();
            postReview($_SESSION['id'],$_POST['idParte'],$_POST['Review']);
    }
    else if (array_key_exists("id", $_POST)) {
        if ($_POST["_method"] === "DELETE") {
            deleteReview($_POST["id"]);
        }
    }
    else {
        //Utilizar file_get_contents
        $data = json_decode(file_get_contents("php://input"));

        if ($data->_method === "POST") {
            session_start();
            postReview($_SESSION['id'],$data->idParte,$data->Review);
        }
        else if($data->_method === "DELETE") {
            deleteReview($data->id);
        }
    }
    exit();
}else if($_SERVER["REQUEST_METHOD"] === "POSTL"){
    if (array_key_exists("id", $_POST)) {
            putReviewL($_POST["id"]);
    }
    else {
        $data = json_decode(file_get_contents("php://input"));
            putReviewL($data->id);
    }
    exit();
}else if($_SERVER["REQUEST_METHOD"] === "POSTD"){
    if (array_key_exists("id", $_POST)) {
            putReviewD($_POST["id"]);
    }
    else {
        $data = json_decode(file_get_contents("php://input"));
            putReviewD($data->id);
    }
    exit();
}else if($_SERVER["REQUEST_METHOD"] === "POSTR"){
    if (array_key_exists("id", $_POST)) {
            reported($_POST["id"]);
    }
    else {
        $data = json_decode(file_get_contents("php://input"));
            reported($data->id);
    }
    exit();
}

function reported($id){
    global $connection;
    try{
        $query = $connection->prepare('UPDATE review SET CantReport = CantReport+1 WHERE id = :id');
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


function putReviewL($id){
    global $connection;
    try{
        $query = $connection->prepare('UPDATE review SET CantLikes = CantLikes+1 WHERE id = :id');
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
function putreviewD($id){
    global $connection;
    try{
        $query = $connection->prepare('UPDATE review SET CantDisLikes = CantDisLikes+1 WHERE id = :id');
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



function postReview($idAutor,$idParte,$Review){
    global $connection;

    try{
        $query = $connection->prepare('INSERT INTO review VALUES(NULL, :idAutor, :idParte, 0, 0, 0, :Review)');
        $query->bindParam(':idAutor', $idAutor, PDO::PARAM_INT);
        $query->bindParam(':idParte', $idParte, PDO::PARAM_INT);
        $query->bindParam(':Review', $Review, PDO::PARAM_STR);
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

function deleteReview($id){
    global $connection;

    try{
        $query = $connection->prepare('DELETE FROM review WHERE id = :id');//Para actualizar es con una coma
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        if($query->rowCount() === 0){
            echo "Error en la eliminación";
        }
        else{
            echo "Registro eliminado";
        }

    }
    catch(PDOException $e){
        echo $e;
    }
}

?>