<?php

class Vehicle {

    private $assetscenter;
    private $assetunit;
    private $mainCategory;
    private $itemCategory;
    private $itemDescription;
    private $make;
    private $modle;
    private $assetsno;
    private $newAssestno;
    private $catalogueno;
    private $identificationno;
    private $engineno;
    private $chessisno;
    private $yearManufacture;
    private $ownerShip;
    private $armyno;
    private $civilno;
    private $fuel;
    private $purchasedDate;
    private $unitValue;
    private $totalCost;
    private $horsePower;
    private $tare;
    private $presentLocation;
    private $receivedDate;
    private $Remarks;
    private $counterId;
    private $acquisitionInstitute;
    private $natureOwnership;
    private $CapRepairCost;
    

    function __construct($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $make, $modle, $assetsno, $newAssestno, $catalogueno, $identificationno, $engineno, $chessisno, $yearManufacture, $ownerShip, $armyno, $civilno, $fuel, $purchasedDate, $unitValue, $totalCost, $horsePower, $tare, $presentLocation, $receivedDate, $Remarks, $counterId, $acquisitionInstitute, $natureOwnership, $CapRepairCost) {
        $this->assetscenter = $assetscenter;
        $this->assetunit = $assetunit;
        $this->mainCategory = $mainCategory;
        $this->itemCategory = $itemCategory;
        $this->itemDescription = $itemDescription;
        $this->make = $make;
        $this->modle = $modle;
        $this->assetsno = $assetsno;
        $this->newAssestno = $newAssestno;
        $this->catalogueno = $catalogueno;
        $this->identificationno = $identificationno;
        $this->engineno = $engineno;
        $this->chessisno = $chessisno;
        $this->yearManufacture = $yearManufacture;
        $this->ownerShip = $ownerShip;
        $this->armyno = $armyno;
        $this->civilno = $civilno;
        $this->fuel = $fuel;
        $this->purchasedDate = $purchasedDate;
        $this->unitValue = $unitValue;
        $this->totalCost = $totalCost;
        $this->horsePower = $horsePower;
        $this->tare = $tare;
        $this->presentLocation = $presentLocation;
        $this->receivedDate = $receivedDate;
        $this->Remarks = $Remarks;
        $this->counterId = $counterId;
        $this->acquisitionInstitute = $acquisitionInstitute;
	$this->natureOwnership = $natureOwnership;
        $this->CapRepairCost = $CapRepairCost;
    }

    public function getAssetscenter() {
        return $this->assetscenter;
    }

    public function getAssetunit() {
        return $this->assetunit;
    }

    public function getMainCategory() {
        return $this->mainCategory;
    }

    public function getItemCategory() {
        return $this->itemCategory;
    }

    public function getItemDescription() {
        return $this->itemDescription;
    }

    public function getMake() {
        return $this->make;
    }

    public function getModle() {
        return $this->modle;
    }

    public function getAssetsno() {
        return $this->assetsno;
    }

    public function getNewAssestno() {
        return $this->newAssestno;
    }

    public function getCatalogueno() {
        return $this->catalogueno;
    }

    public function getIdentificationno() {
        return $this->identificationno;
    }

    public function getEngineno() {
        return $this->engineno;
    }

    public function getChessisno() {
        return $this->chessisno;
    }

    public function getYearManufacture() {
        return $this->yearManufacture;
    }

    public function getOwnerShip() {
        return $this->ownerShip;
    }

    public function getArmyno() {
        return $this->armyno;
    }

    public function getCivilno() {
        return $this->civilno;
    }

    public function getFuel() {
        return $this->fuel;
    }

    public function getPurchasedDate() {
        return $this->purchasedDate;
    }

    public function getUnitValue() {
        return $this->unitValue;
    }

    public function getTotalCost() {
        return $this->totalCost;
    }

    public function getHorsePower() {
        return $this->horsePower;
    }

    public function getTare() {
        return $this->tare;
    }

    public function getPresentLocation() {
        return $this->presentLocation;
    }

    public function getReceivedDate() {
        return $this->receivedDate;
    }

    public function getRemarks() {
        return $this->Remarks;
    }

    public function getCounterId() {
        return $this->counterId;
    }

    public function getAcquisitionInstitute() {
        return $this->acquisitionInstitute;
    }

    public function getnatureOwnership() {
        return $this->natureOwnership;
    }
    
    // add by chandana
    public function getCapitalRepairCost() {
        return $this->CapRepairCost;
    }
	
    public function setAssetscenter($assetscenter) {
        $this->assetscenter = $assetscenter;
    }

    public function setAssetunit($assetunit) {
        $this->assetunit = $assetunit;
    }

    public function setMainCategory($mainCategory) {
        $this->mainCategory = $mainCategory;
    }

    public function setItemCategory($itemCategory) {
        $this->itemCategory = $itemCategory;
    }

    public function setItemDescription($itemDescription) {
        $this->itemDescription = $itemDescription;
    }

    public function setMake($make) {
        $this->make = $make;
    }

    public function setModle($modle) {
        $this->modle = $modle;
    }

    public function setAssetsno($assetsno) {
        $this->assetsno = $assetsno;
    }

    public function setNewAssestno($newAssestno) {
        $this->newAssestno = $newAssestno;
    }

    public function setCatalogueno($catalogueno) {
        $this->catalogueno = $catalogueno;
    }

    public function setIdentificationno($identificationno) {
        $this->identificationno = $identificationno;
    }

    public function setEngineno($engineno) {
        $this->engineno = $engineno;
    }

    public function setChessisno($chessisno) {
        $this->chessisno = $chessisno;
    }

    public function setYearManufacture($yearManufacture) {
        $this->yearManufacture = $yearManufacture;
    }

    public function setOwnerShip($ownerShip) {
        $this->ownerShip = $ownerShip;
    }

    public function setArmyno($armyno) {
        $this->armyno = $armyno;
    }

    public function setCivilno($civilno) {
        $this->civilno = $civilno;
    }

    public function setFuel($fuel) {
        $this->fuel = $fuel;
    }

    public function setPurchasedDate($purchasedDate) {
        $this->purchasedDate = $purchasedDate;
    }

    public function setUnitValue($unitValue) {
        $this->unitValue = $unitValue;
    }

    public function setTotalCost($totalCost) {
        $this->totalCost = $totalCost;
    }

    public function setHorsePower($horsePower) {
        $this->horsePower = $horsePower;
    }

    public function setTare($tare) {
        $this->tare = $tare;
    }

    public function setPresentLocation($presentLocation) {
        $this->presentLocation = $presentLocation;
    }

    public function setReceivedDate($receivedDate) {
        $this->receivedDate = $receivedDate;
    }

    public function setRemarks($Remarks) {
        $this->Remarks = $Remarks;
    }

    public function setCounterId($counterId) {
        $this->counterId = $counterId;
    }

    public function setAcquisitionInstitute($acquisitionInstitute) {
        $this->acquisitionInstitute = $acquisitionInstitute;
    }
	
    public function setnatureOwnership($natureOwnership) {
        $this->natureOwnership = $natureOwnership;
    }
}
