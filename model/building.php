<?php

class Building {

    private $assetscenter;
    private $assetunit;
    private $province;
    private $district;
    private $dsDivision;
    private $gsDivision;
    private $landName;
    private $ownerName;
    private $buildingCategory;
    private $assetsno;
    private $buildingType;
    private $rentAndRate;
    private $ownership;
    private $natureOwnership;
    private $regOwnerName;
    private $classificationno;
    private $identificationno;
    private $buildingno;
    private $planno;
    private $plandate;
    private $areaMeasure;
    private $area;
    private $feets;
    private $constructionCost;
    private $additionsValue;
    private $alterationValue;
    private $acquisitiondate;
    private $remarks;
    private $counterId;
    private $acquisitionInstitute;
	private $previousownership;
//        private $capitalCost;
        private $refValue;

    function __construct($assetscenter, $assetunit, $province, $district, $dsDivision, $gsDivision, $landName, $ownerName, $buildingCategory, $assetsno, $buildingType, $rentAndRate, $natureOwnership, $ownership, $regOwnerName, $classificationno, $identificationno, $buildingno, $planno, $plandate, $areaMeasure, $area, $feets, $constructionCost, $additionsValue, $alterationValue, $acquisitiondate, $remarks, $counterId, $acquisitionInstitute, $previousownership, $refValue) {
        $this->assetscenter = $assetscenter;
        $this->assetunit = $assetunit;
        $this->province = $province;
        $this->district = $district;
        $this->dsDivision = $dsDivision;
        $this->gsDivision = $gsDivision;
        $this->landName = $landName;
        $this->ownerName = $ownerName;
        $this->buildingCategory = $buildingCategory;
        $this->assetsno = $assetsno;
        $this->buildingType = $buildingType;
        $this->rentAndRate = $rentAndRate;
        $this->natureOwnership = $natureOwnership;
        $this->ownership = $ownership;
        $this->regOwnerName = $regOwnerName;
        $this->classificationno = $classificationno;
        $this->identificationno = $identificationno;
        $this->buildingno = $buildingno;
        $this->planno = $planno;
        $this->plandate = $plandate;
        $this->areaMeasure = $areaMeasure;
        $this->area = $area;
        $this->feets = $feets;
        $this->constructionCost = $constructionCost;
        $this->additionsValue = $additionsValue;
        $this->alterationValue = $alterationValue;
        $this->acquisitiondate = $acquisitiondate;
        $this->capitalCost = $capitalCost;
        $this->remarks = $remarks;
        $this->counterId = $counterId;
        $this->acquisitionInstitute = $acquisitionInstitute;
	$this->previousownership = $previousownership;
        $this->refValue = $refValue;      
    }

    public function getAssetscenter() {
        return $this->assetscenter;
    }

    public function getAssetunit() {
        return $this->assetunit;
    }

    public function getProvince() {
        return $this->province;
    }

    public function getDistrict() {
        return $this->district;
    }

    public function getDsDivision() {
        return $this->dsDivision;
    }

    public function getGsDivision() {
        return $this->gsDivision;
    }

    public function getLandName() {
        return $this->landName;
    }

    public function getOwnerName() {
        return $this->ownerName;
    }

    public function getBuildingCategory() {
        return $this->buildingCategory;
    }

    public function getAssetsno() {
        return $this->assetsno;
    }

    public function getBuildingType() {
        return $this->buildingType;
    }

    public function getRentAndRate() {
        return $this->rentAndRate;
    }

    public function getNatureOwnership() {
        return $this->natureOwnership;
    }

    public function getOwnership() {
        return $this->ownership;
    }

    public function getRegOwnerName() {
        return $this->regOwnerName;
    }

    public function getClassificationno() {
        return $this->classificationno;
    }

    public function getIdentificationno() {
        return $this->identificationno;
    }

    public function getBuildingno() {
        return $this->buildingno;
    }

    public function getPlanno() {
        return $this->planno;
    }

    public function getPlandate() {
        return $this->plandate;
    }

    public function getAreaMeasure() {
        return $this->areaMeasure;
    }

    public function getArea() {
        return $this->area;
    }

    public function getFeets() {
        return $this->feets;
    }

    public function getConstructionCost() {
        return $this->constructionCost;
    }

    public function getAdditionsValue() {
        return $this->additionsValue;
    }

    public function getAlterationValue() {
        return $this->alterationValue;
    }

    public function getAcquisitiondate() {
        return $this->acquisitiondate;
    }
// new addtion chandana
    
//    public function getCapitalCost() {
//        return $this->capitalCost;
//    }
    
    public function getRefValue() {
        return $this->refValue;
    }
    
//end  
    public function getRemarks() {
        return $this->remarks;
    }

    public function getCounterId() {
        return $this->counterId;
    }

    public function getAcquisitionInstitute() {
        return $this->acquisitionInstitute;
    }

	public function getPreviousownership() {
        return $this->previousownership;
    }
	
    public function setAssetscenter($assetscenter) {
        $this->assetscenter = $assetscenter;
    }

    public function setAssetunit($assetunit) {
        $this->assetunit = $assetunit;
    }

    public function setProvince($province) {
        $this->province = $province;
    }

    public function setDistrict($district) {
        $this->district = $district;
    }

    public function setDsDivision($dsDivision) {
        $this->dsDivision = $dsDivision;
    }

    public function setGsDivision($gsDivision) {
        $this->gsDivision = $gsDivision;
    }

    public function setLandName($landName) {
        $this->landName = $landName;
    }

    public function setOwnerName($ownerName) {
        $this->ownerName = $ownerName;
    }

    public function setBuildingCategory($buildingCategory) {
        $this->buildingCategory = $buildingCategory;
    }

    public function setAssetsno($assetsno) {
        $this->assetsno = $assetsno;
    }

    public function setBuildingType($buildingType) {
        $this->buildingType = $buildingType;
    }

    public function setRentAndRate($rentAndRate) {
        $this->rentAndRate = $rentAndRate;
    }

    public function setNatureOwnership($natureOwnership) {
        $this->natureOwnership = $natureOwnership;
    }

    public function setOwnership($ownership) {
        $this->ownership = $ownership;
    }

    public function setRegOwnerName($regOwnerName) {
        $this->regOwnerName = $regOwnerName;
    }

    public function setClassificationno($classificationno) {
        $this->classificationno = $classificationno;
    }

    public function setIdentificationno($identificationno) {
        $this->identificationno = $identificationno;
    }

    public function setBuildingno($buildingno) {
        $this->buildingno = $buildingno;
    }

    public function setPlanno($planno) {
        $this->planno = $planno;
    }

    public function setPlandate($plandate) {
        $this->plandate = $plandate;
    }

    public function setAreaMeasure($areaMeasure) {
        $this->areaMeasure = $areaMeasure;
    }

    public function setArea($area) {
        $this->area = $area;
    }

    public function setFeets($feets) {
        $this->feets = $feets;
    }

    public function setConstructionCost($constructionCost) {
        $this->constructionCost = $constructionCost;
    }

    public function setAdditionsValue($additionsValue) {
        $this->additionsValue = $additionsValue;
    }

    public function setAlterationValue($alterationValue) {
        $this->alterationValue = $alterationValue;
    }

    public function setAcquisitiondate($acquisitiondate) {
        $this->acquisitiondate = $acquisitiondate;
    }

    public function setRemarks($remarks) {
        $this->remarks = $remarks;
    }

    public function setCounterId($counterId) {
        $this->remarks = $counterId;
    }

    public function setAcquisitionInstitute($acquisitionInstitute) {
        $this->acquisitionInstitute = $acquisitionInstitute;
    }

	public function setPreviousownership($previousownership) {
        $this->previousownership = $previousownership;
    }
}
