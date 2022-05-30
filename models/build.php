<?php

class build {
    private $_id;
    private $_Name;
    private $_idAutor;
    private $_idCPU;
    private $_idMB;
    private $_idCAS;
    private $_idGPU;
    private $_idSSD;
    private $_idCPC;
    private $_idPSU;
    private $_idRAM;
    private $_idFAN;
    private $_CantLikes;
    private $_CantDisLikes;
    private $_Price;
    private $_Image;

    public function __construct($id,$Name,$idAutor,$idCPU,$idMB,$idCAS,$idGPU,$idSSD,$idCPC,$idPSU,$idRAM, $idFAN,$CantLikes, $CantDisLikes, $Price, $Image) {
        $this->setId($id);
        $this->setName($Name);
        $this->setIdAutor($idAutor);
        $this->setIdCPU($idCPU);
        $this->setIdMB($idMB);
        $this->setIdCAS($idCAS);
        $this->setIdGPU($idGPU);
        $this->setIdSSD($idSSD);
        $this->setIdCPC($idCPC);
        $this->setIdPSU($idPSU);
        $this->setIdRAM($idRAM);
        $this->setIdFAN($idFAN);
        $this->setCantLikes($CantLikes);
        $this->setCantDisLikes($CantDisLikes);
        $this->setPrice($Price);
        $this->setImage($Image);
    }


    public function getId() {
        return $this->_id;
    }
    public function getName() {
        return $this->_Name;
    }
    public function getIdAutor() {
        return $this->_idAutor;
    }
    public function getIdCPU() {
        return $this->_idCPU;
    }
    public function getIdMB() {
        return $this->_idMB;
    }
    public function getIdCAS() {
        return $this->_idCAS;
    }
    public function getIdGPU() {
        return $this->_idGPU;
    }
    public function getIdSSD() {
        return $this->_idSSD;
    }
    public function getIdCPC() {
        return $this->_idCPC;
    }
    public function getIdPSU() {
        return $this->_idPSU;
    }
    public function getIdRAM() {
        return $this->_idRAM;
    }
    public function getIdFAN() {
        return $this->_idFAN;
    }
    public function getCantLikes() {
        return $this->_CantLikes;
    }
    public function getCantDisLikes() {
        return $this->_CantDisLikes;
    }
    public function getPrice() {
        return $this->_Price;
    }
    public function getImage() {
        return $this->_Image;
    }

    

    public function setId($id) {
        $this->_id = $id;
    }
    public function setname($Name) {
        $this->_Name = $Name;
    }
    public function setIdAutor($idAutor) {
        $this->_idAutor = $idAutor;
    }
    public function setIdCPU($idCPU) {
        $this->_idCPU = $idCPU;
    }
    public function setIdMB($idMB) {
        $this->_idMB = $idMB;
    }
    public function setIdCAS($idCAS) {
        $this->_idCAS = $idCAS;
    }
    public function setIdGPU($idGPU) {
        $this->_idGPU = $idGPU;
    }
    public function setIdSSD($idSSD) {
        $this->_idSSD = $idSSD;
    }
    public function setIdCPC($idCPC) {
        $this->_idCPC = $idCPC;
    }
    public function setIdPSU($idPSU) {
        $this->_idPSU = $idPSU;
    }
    public function setIdRAM($idRAM) {
        $this->_idRAM = $idRAM;
    }
    public function setIdFAN($idFAN) {
        $this->_idFAN = $idFAN;
    }
    public function setCantLikes($CantLikes) {
        $this->_CantLikes = $CantLikes;
    }
    public function setCantDisLikes($CantDisLikes) {
        $this->_CantDisLikes = $CantDisLikes;
    }
    public function setPrice($Price) {
        $this->_Price = $Price;
    }
    public function setImage($Image) {
        $this->_Image = base64_encode($Image);
    }







    public function getArray() {
        $array = array();

        $array["id"] = $this->getId();
        $array["Name"] = $this->getName();
        $array["idAutor"] = $this->getIdAutor();
        $array["idCPU"] = $this->getIdCPU();
        $array["idMB"] = $this->getIdMB();
        $array["idCAS"] = $this->getIdCAS();
        $array["idGPU"] = $this->getIdGPU();
        $array["idSSD"] = $this->getIdSSD();
        $array["idCPC"] = $this->getIdCPC();
        $array["idPSU"] = $this->getIdPSU();
        $array["idRAM"] = $this->getIdRAM();
        $array["idFAN"] = $this->getIdFAN();
        $array["CantLikes"] = $this->getCantLikes();
        $array["CantDisLikes"] = $this->getCantDisLikes();
        $array["Price"] = $this->getPrice();
        $array["Image"] = $this->getImage();

        return $array;
    }
}



?>