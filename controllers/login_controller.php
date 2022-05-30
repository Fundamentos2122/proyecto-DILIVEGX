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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["_method"] === "POST") {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        try {
            $query = $connection->prepare('SELECT * FROM profile WHERE Email = :email');
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() === 0) {
                header('Location: http://localhost/proyecto/login.php?error=Usuario no encontrado');
                exit();
            }

            $user;

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $user = new User($row["id"], $row["Name"], $row["UserName"], $row["Email"], $row["Password"], $row["Type"], $row["Image"]);
            }

            if (!password_verify($password, $user->getPassword())) {
                header('Location: http://localhost/proyecto/login.php?error=Contraseña inválida');
                exit();
            }

            session_start();

            $_SESSION["id"] = $user->getId();
            $_SESSION["name"] = $user->getName();
            $_SESSION["username"] = $user->getUsername();
            $_SESSION["email"] = $user->getEmail();
            $_SESSION["type"] = $user->getType();
            $_SESSION["image"] = $user->getImage();

            header('Location: http://localhost/proyecto');
            exit();
        }
        catch(PDOException $e) {
            echo $e;
        }
    }
    else if($_POST["_method"] === "PUT") {
        
    }
    else if($_POST["_method"] === "DELETE") {
        session_start();

        session_destroy();

        header('Location: http://localhost/proyecto');

        exit();
    }
}

?>