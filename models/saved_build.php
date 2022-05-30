<?php

class saved_build {
    private $_idBuild;
    private $_idProfile;


    public function __construct($idBuild,$idProfile) {
        $this->setIdBuild($idBuild);
        $this->setidProfile($idProfile);
    }


    public function getIdBuild() {
        return $this->_idBuild;
    }
    public function getIdProfile() {
        return $this->_idProfile;
    }


    

    public function setIdBuild($idBuild) {
        $this->_idBuild = $idBuild;
    }
    public function setIdProfile($idProfile) {
        $this->_idProfile = $idProfile;
    }





    public function getArray() {
        $array = array();

        $array["idBuild"] = $this->getIdBuild();
        $array["idProfile"] = $this->getIdProfile();

        return $array;
    }
}



?>