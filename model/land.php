<?php

class Land {

    private $assetscenter;
    private $assetunit;
    private $province;
    private $district;
    private $dsDivision;
    private $gsDivision;
    private $category;
    private $assetsno;
    private $classificationno;
    private $identificationno;
    private $register;
    private $landname;
    private $natureOwnership;
    private $ownership;
    private $planno;
    private $deedno;
    private $deeddate;
    private $landNature;
    private $areaMeasure;
    private $area;
    private $acre;
    private $rood;
    private $parch;
    private $estimatedValue;
    private $acquisitiondate;
    private $remarks;
    private $counterId;
    private $acquisitionInstitute;
	private $valCost;
        private $refValue;

    function __construct($assetscenter, $assetunit, $province, $district, $dsDivision, $gsDivision, $category, $assetsno, $classificationno, $identificationno, $register, $landname, $natureOwnership, $ownership, $planno, $deedno, $deeddate, $landNature, $areaMeasure, $area, $acre, $rood, $parch, $estimatedValue, $acquisitiondate, $remarks, $counterId, $acquisitionInstitute, $previousownership,  $valCost, $refValue) {
        $this->assetscenter = $assetscenter;
        $this->assetunit = $assetunit;
        $this->province = $province;
        $this->district = $district;
        $this->dsDivision = $dsDivision;
        $this->gsDivision = $gsDivision;
        $this->category = $category;
        $this->assetsno = $assetsno;
        $this->classificationno = $classificationno;
        $this->identificationno = $identificationno;
        $this->register = $register;
        $this->landname = $landname;
        $this->natureOwnership = $natureOwnership;
        $this->ownership = $ownership;
        $this->planno = $planno;
        $this->deedno = $deedno;
        $this->deeddate = $deeddate;
        $this->landNature = $landNature;
        $this->areaMeasure = $areaMeasure;
        $this->area = $area;
        $this->acre = $acre;
        $this->rood = $rood;
        $this->parch = $parch;
        $this->estimatedValue = $estimatedValue;
        $this->acquisitiondate = $acquisitiondate;
        $this->remarks = $remarks;
        $this->counterId = $counterId;
        $this->acquisitionInstitute = $acquisitionInstitute;
	$this->previousownership = $previousownership;
        $this->valCost = $valCost; 
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

    public function getCategory() {
        return $this->category;
    }

    public function getAssetsno() {
        return $this->assetsno;
    }

    public function getClassificationno() {
        return $this->classificationno;
    }

    public function getIdentificationno() {
        return $this->identificationno;
    }

    public function getRegister() {
        return $this->register;
    }

    public function getLandname() {
        return $this->landname;
    }

    public function getNatureOwnership() {
        return $this->natureOwnership;
    }

    public function getOwnership() {
        return $this->ownership;
    }

    public function getPlanno() {
        return $this->planno;
    }

    public function getDeedno() {
        return $this->deedno;
    }

    public function getDeeddate() {
        return $this->deeddate;
    }

    public function getLandNature() {
        return $this->landNature;
    }

    public function getAreaMeasure() {
        return $this->areaMeasure;
    }

    public function getArea() {
        return $this->area;
    }

    public function getAcre() {
        return $this->acre;
    }

    public function getRood() {
        return $this->rood;
    }

    public function getParch() {
        return $this->parch;
    }

    public function getEstimatedValue() {
        return $this->estimatedValue;
    }

    public function getAcquisitiondate() {
        return $this->acquisitiondate;
    }

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
    
    //added by chandana
    
    public function getValCost() {
        return $this->valCost;
    }
    public function getRefValue() {
        return $this->refValue;
    }
    
    //end
	
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

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setAssetsno($assetsno) {
        $this->assetsno = $assetsno;
    }

    public function setClassificationno($classificationno) {
        $this->classificationno = $classificationno;
    }

    public function setIdentificationno($identificationno) {
        $this->identificationno = $identificationno;
    }

    public function setRegister($register) {
        $this->register = $register;
    }

    public function setLandname($landname) {
        $this->landname = $landname;
    }

    public function setNatureOwnership($natureOwnership) {
        $this->natureOwnership = $natureOwnership;
    }

    public function setOwnership($ownership) {
        $this->ownership = $ownership;
    }

    public function setPlanno($planno) {
        $this->planno = $planno;
    }

    public function setDeedno($deedno) {
        $this->deedno = $deedno;
    }

    public function setDeeddate($deeddate) {
        $this->deeddate = $deeddate;
    }

    public function setLandNature($landNature) {
        $this->landNature = $landNature;
    }

    public function setAreaMeasure($areaMeasure) {
        $this->areaMeasure = $areaMeasure;
    }

    public function setArea($area) {
        $this->area = $area;
    }

    public function setAcre($acre) {
        $this->acre = $acre;
    }

    public function setRood($rood) {
        $this->rood = $rood;
    }

    public function setParch($parch) {
        $this->parch = $parch;
    }

    public function setEstimatedValue($estimatedValue) {
        $this->estimatedValue = $estimatedValue;
    }

    public function setAcquisitiondate($acquisitiondate) {
        $this->acquisitiondate = $acquisitiondate;
    }

    public function setRemarks($remarks) {
        $this->remarks = $remarks;
    }

    public function setCounterId($counterId) {
        $this->counterId = $counterId;
    }

    public function setAcquisitionInstitute($acquisitionInstitute) {
        $this->acquisitionInstitute = $acquisitionInstitute;
    }

    public function setPreviousownership($previousownership) {
        $this->previousownership = $previousownership;
    }
    
    
}
