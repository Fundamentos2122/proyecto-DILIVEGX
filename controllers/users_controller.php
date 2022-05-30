<?php 

include("../models/DB.php");
include("../models/user.php");

try {
    $connection = DBConnection::getConnection();
}
catch(PDOException $e) {
    error_log("Error de conexión - " . $e, 0);

    exit();
}

if($_SERVER["REQUEST_METHOD"] === "GET"){
        try{
            $query = $connection->prepare('SELECT * FROM profile');
            $query->execute();
            $users = array();

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $user = new user($row['id'],$row['Name'],$row['UserName'],$row['Email'],NULL,$row['Type'],$row['Image']);
                $users[] = $user->getArray();
            }
            echo json_encode($users);
        }
        catch(PDOException $e){
            echo $e;
        }
}else if($_SERVER["REQUEST_METHOD"] === "GETuser"){
    if(array_key_exists("id",$_GET)){
        $id = $_GET["id"];
        try{
            $query = $connection->prepare('SELECT * FROM profile WHERE id = :id');
            $query->bindParam(':id',$id,PDO::PARAM_INT);
            $query->execute();
            $user;

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $user = new user($row['id'],$row['Name'],$row['UserName'],$row['Email'],NULL,$row['Type'],$row['Image']);
            }
            echo json_encode($user->getArray());
        }
        catch(PDOException $e){
            echo $e;
        }
    }else{
        session_start();
        if(array_key_exists("id",$_SESSION)){
            $id = $_SESSION["id"];
            try{
                $query = $connection->prepare('SELECT * FROM profile WHERE id = :id');
                $query->bindParam(':id',$id,PDO::PARAM_INT);
                $query->execute();
                $user;
    
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $user = new user($row['id'],$row['Name'],$row['UserName'],$row['Email'],NULL,$row['Type'],$row['Image']);
                }
                echo json_encode($user->getArray());
            }
            catch(PDOException $e){
                echo $e;
            }
        }
    } 
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (array_key_exists("name", $_POST)) {
    //Obtener información del POST
    $name = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    $type = "normal";
    $photo = "";
    if (sizeof($_FILES) > 0) {
        $tmp_name = $_FILES["photo"]["tmp_name"];

        $photo = file_get_contents($tmp_name);
    }
    postUser($name, $username, $email, $password, $type, $photo);
    }
    else {
        $data = json_decode(file_get_contents("php://input"));
        $name = trim($data->name);
        $username = trim($data->username);
        $email = trim($data->email);
        $password = password_hash(trim($data->password), PASSWORD_DEFAULT);
        $type = "normal";
        $image = file_get_contents($data->image);
        postUser($name, $username, $email, $password, $type, $image);
    }
}else if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        deleteUser($id);
}else if ($_SERVER["REQUEST_METHOD"] === "ADMIN") {
    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;
    adminUser($id);
}

function adminUser($id){
    global $connection;
    try{
        $query = $connection->prepare('UPDATE profile SET Type = "admin" WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        if($query->rowCount() === 0){
            echo "Error en la inserción";
        }
        else{
             echo "Registro actualizado";
        }
    }
    catch(PDOException $e){
        echo $e;
    }
}
function deleteUser($id){
    global $connection;

    try{
        $query = $connection->prepare('DELETE FROM profile WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
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
function postUser($name, $username, $email, $password, $type, $image){
    global $connection;
    
    try {
        $query = $connection->prepare('INSERT INTO profile VALUES(NULL, :name, :username, :email, :password, :type, :image)');
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->execute();
        

        if($query->rowCount() === 0) {
            echo "Error en la inserción";
        }
        else {
            header('Location: http://localhost/proyecto/login.php');
        }
    }
    catch(PDOException $e) {
        echo $e;
    }
}

?>