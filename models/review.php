<?php 

class review {
    private $_id;
    private $_idAutor;
    private $_idParte;
    private $_CantLikes;
    private $_CantDisLikes;
    private $_CantReport;
    private $_Review;
    

    public function __construct($id,$idAutor,$idParte,$CantLikes,$CantDisLikes,$CantReport,$Review) {
        $this->setId($id);
        $this->setIdAutor($idAutor);
        $this->setIdParte($idParte);
        $this->setCantLikes($CantLikes);
        $this->setCantDisLikes($CantDisLikes);
        $this->setCantReport($CantReport);
        $this->setReview($Review);

    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getIdAutor() {
        return $this->_idAutor;
    }

    public function setIdAutor($idAutor) {
        $this->_idAutor = $idAutor;
    }

    public function getIdParte() {
        return $this->_idParte;
    }

    public function setIdParte($idParte) {
        $this->_idParte = $idParte;
    }

    public function getCantLikes() {
        return $this->_CantLikes;
    }

    public function setCantLikes($CantLikes) {
        $this->_CantLikes = $CantLikes;
    }
    
    public function getCantDisLikes() {
        return $this->_CantDisLikes;
    }

    public function setCantDisLikes($CantDisLikes) {
        $this->_CantDisLikes = $CantDisLikes;
    }

    public function getCantReport() {
        return $this->_CantReport;
    }

    public function setCantReport($CantReport) {
        $this->_CantReport = $CantReport;
    }

    public function getReview() {
        return $this->_Review;
    }

    public function setReview($Review) {
        $this->_Review = $Review;
    }




    public function getArray() {
        $array = array();

        $array["id"] = $this->getId();
        $array["idAutor"] = $this->getIdAutor();
        $array["idParte"] = $this->getIdParte();
        $array["CantLikes"] = $this->getCantLikes();
        $array["CantDisLikes"] = $this->getCantDisLikes();
        $array["CantReport"] = $this->getCantReport();
        $array["Review"] = $this->getReview();
        return $array;
    }
}

?>