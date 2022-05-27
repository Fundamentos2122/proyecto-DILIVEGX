<?php

class part {
    private $_id;
    private $_Type;
    private $_Name;
    private $_Description;
    private $_Price;
    private $_Image;
    private $_Socket;
    private $_FormFactor;
    private $_Wattage;
    private $_Brand;
    private $_InternalGPU;
    private $_Ddr;

    public function __construct($id,$Type,$Name,$Description,$Price,$Image,$Socket,$FormFactor,$Wattage,$Brand, $InternalGPU,$Ddr) {
        $this->setId($id);
        $this->setType($Type);
        $this->setName($Name);
        $this->setDescription($Description);
        $this->setPrice($Price);
        $this->setImage($Image);
        $this->setSocket($Socket);
        $this->setFormFactor($FormFactor);
        $this->setWattage($Wattage);
        $this->setBrand($Brand);
        $this->setInternalGPU($InternalGPU);
        $this->setDdr($Ddr);
    }


    public function getId() {
        return $this->_id;
    }
    public function getType() {
        return $this->_Type;
    }
    public function getName() {
        return $this->_Name;
    }
    public function getDescription() {
        return $this->_Description;
    }
    public function getPrice() {
        return $this->_Price;
    }
    public function getImage() {
        return $this->_Image;
    }
    public function getSocket() {
        return $this->_Socket;
    }
    public function getFormFactor() {
        return $this->_FormFactor;
    }
    public function getWattage() {
        return $this->_Wattage;
    }
    public function getBrand() {
        return $this->_Brand;
    }
    public function getInternalGPU() {
        return $this->_InternalGPU;
    }
    public function getDdr() {
        return $this->_Ddr;
    }

    

    public function setId($id) {
        $this->_id = $id;
    }
    public function setType($Type) {
        $this->_Type=$Type;
    }
    public function setName($Name) {
        $this->_Name = $Name;
    }
    public function setDescription($Description) {
        $this->_Description = $Description;
    }
    public function setPrice($Price) {
        $this->_Price = $Price;
    }
    public function setImage($Image) {
        $this->_Image = base64_encode($Image);
    }
    public function setSocket($Socket) {
        $this->_Socket = $Socket;
    }
    public function setFormFactor($FormFactor) {
        $this->_FormFactor=$FormFactor;
    }
    public function setWattage($Wattage) {
        $this->_Wattage = $Wattage;
    }
    public function setBrand($Brand) {
        $this->_Brand = $Brand;
    }
    public function setInternalGPU($InternalGPU) {
        $this->_InternalGPU = $InternalGPU;
    }
    public function setDdr($Ddr) {
        $this->_Ddr = $Ddr;
    }





    public function getArray() {
        $array = array();

        $array["id"] = $this->getId();
        $array["Type"] = $this->getType();
        $array["Name"] = $this->getName();
        $array["Description"] = $this->getDescription();
        $array["Price"] = $this->getPrice();
        $array["Image"] = $this->getImage();
        $array["Socket"] = $this->getSocket();
        $array["FormFactor"] = $this->getFormFactor();
        $array["Wattage"] = $this->getWattage();
        $array["Brand"] = $this->getBrand();
        $array["InternalGPU"] = $this->getInternalGPU();
        $array["Ddr"] = $this->getDdr();

        return $array;
    }
}



?>