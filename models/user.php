<?php 

class User {
    private $_id;
    private $_name;
    private $_username;
    private $_email;
    private $_password;
    private $_type;
    private $_Image;
    

    public function __construct($id,$name,$username,$email,$password,$type,$Image) {
        $this->setId($id);
        $this->setName($name);
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setType($type);
        $this->setImage($Image);
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getName() {
        return $this->_name;
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function setUsername($username) {
        $this->_username = $username;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function setEmail($email) {
        $this->_email = $email;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function getType() {
        return $this->_type;
    }

    public function setType($type) {
        $this->_type = $type;
    }

    public function getImage() {
        return $this->_Image;
    }

    public function setImage($Image) {
        $this->_Image = base64_encode($Image);
    }



    public function getArray() {
        $array = array();

        $array["id"] = $this->getId();
        $array["Name"] = $this->getName();
        $array["UserName"] = $this->getUsername();
        $array["Email"] = $this->getEmail();
        $array["Password"] = $this->getPassword();
        $array["Type"] = $this->getType();
        $array["Image"] = $this->getImage();
        return $array;
    }
}

?>