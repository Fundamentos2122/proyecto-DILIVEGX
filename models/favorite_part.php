<?php

class favorite_part {
    private $_idPart;
    private $_idProfile;


    public function __construct($idPart,$idProfile) {
        $this->setIdPart($idPart);
        $this->setidProfile($idProfile);
    }


    public function getIdPart() {
        return $this->_idPart;
    }
    public function getIdProfile() {
        return $this->_idProfile;
    }


    

    public function setIdPart($idPart) {
        $this->_idPart = $idPart;
    }
    public function setIdProfile($idProfile) {
        $this->_idProfile = $idProfile;
    }





    public function getArray() {
        $array = array();

        $array["idPart"] = $this->getIdPart();
        $array["idProfile"] = $this->getIdProfile();

        return $array;
    }
}



?>