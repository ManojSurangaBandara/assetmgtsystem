<?php

class AssetsCenter2 {

    private $id;
    private $name;
    private $make;
    private $modle;

    function __construct($id, $name, $make, $modle) {
        $this->id = $id;
        $this->name = $name;
        $this->make = $make;
        $this->modle = $modle;
    }
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getMake() {
        return $this->make;
    }

    public function getModle() {
        return $this->modle;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setMake($make) {
        $this->make = $make;
    }

    public function setModle($modle) {
        $this->modle = $modle;
    }


}

?>