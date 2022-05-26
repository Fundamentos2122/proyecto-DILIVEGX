<?php 

include("../models/DB.php");

try {
    $connection = DBConnection::getConnection();
}
catch(PDOException $e) {
    error_log("Error de conexión - " . $e, 0);

    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (array_key_exists("name", $_POST)) {
    //Obtener información del POST
    $name = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    $type = "normal";
    
    postUser($name, $username, $email, $password, $type);
    }
    else {
        $data = json_decode(file_get_contents("php://input"));

        $name = trim($data->name);
        $username = trim($data->username);
        $email = trim($data->email);
        $password = password_hash(trim($data->password), PASSWORD_DEFAULT);
        $type = "normal";
        postUser($name, $username, $email, $password, $type);
    }


}


function postUser($name, $username, $email, $password, $type){
    global $connection;
    
    try {
        $query = $connection->prepare('INSERT INTO profile VALUES(NULL, :name, :username, :email, :password, :type)');
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->execute();
        

        if($query->rowCount() === 0) {
            echo "Error en la inserción";
        }
        else {

        }
    }
    catch(PDOException $e) {
        echo $e;
    }
}

?>