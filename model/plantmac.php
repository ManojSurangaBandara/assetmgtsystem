<?php

class PlantMac {

    private $assetscenter;
    private $assetunit;
    private $mainCategory;
    private $itemCategory;
    private $itemDescription;
    private $assetsno;
    private $newAssestno;
    private $catalogueno;
    private $identificationno;
    private $ledgerno;
    private $ledgerFoliono;
    private $eqptSriNo;
    private $purchasedDate;
    private $quantity;
    private $capacity;
    private $unitValue;
    private $totalCost;
    private $receivedDate;
    private $Remarks;
    private $counterId;
    private $groupId;
    private $groupQty;
    private $presentLocation;
    private $transferSelect;
    private $TransferToCenter;
    private $TransferToUnit;
    private $TransferToDetails;
    private $TransferToDate;
    private $TransferToConfirm;
    private $acquisitionInstitute;
	private $natureOwnership;

    function __construct($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $assetsno, $newAssestno, $catalogueno, $identificationno, $ledgerno, $ledgerFoliono, $eqptSriNo, $purchasedDate, $quantity, $capacity, $unitValue, $totalCost, $receivedDate, $Remarks, $counterId, $groupId, $groupQty, $presentLocation, $transferSelect, $TransferToCenter, $TransferToUnit, $TransferToDetails, $TransferToDate, $TransferToConfirm, $acquisitionInstitute, $natureOwnership) {
        $this->assetscenter = $assetscenter;
        $this->assetunit = $assetunit;
        $this->mainCategory = $mainCategory;
        $this->itemCategory = $itemCategory;
        $this->itemDescription = $itemDescription;
        $this->assetsno = $assetsno;
        $this->newAssestno = $newAssestno;
        $this->catalogueno = $catalogueno;
        $this->identificationno = $identificationno;
        $this->ledgerno = $ledgerno;
        $this->ledgerFoliono = $ledgerFoliono;
        $this->eqptSriNo = $eqptSriNo;
        $this->purchasedDate = $purchasedDate;
        $this->quantity = $quantity;
        $this->capacity = $capacity;
        $this->unitValue = $unitValue;
        $this->totalCost = $totalCost;
        $this->receivedDate = $receivedDate;
        $this->Remarks = $Remarks;
        $this->counterId = $counterId;
        $this->groupId = $groupId;
        $this->groupQty = $groupQty;
        $this->presentLocation = $presentLocation;
        $this->transferSelect = $transferSelect;
        $this->TransferToCenter = $TransferToCenter;
        $this->TransferToUnit = $TransferToUnit;
        $this->TransferToDetails = $TransferToDetails;
        $this->TransferToDate = $TransferToDate;
        $this->TransferToConfirm = $TransferToConfirm;
        $this->acquisitionInstitute = $acquisitionInstitute;
		$this->natureOwnership = $natureOwnership;
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

    public function getLedgerno() {
        return $this->ledgerno;
    }

    public function getLedgerFoliono() {
        return $this->ledgerFoliono;
    }

    public function getEqptSriNo() {
        return $this->eqptSriNo;
    }

    public function getPurchasedDate() {
        return $this->purchasedDate;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getCapacity() {
        return $this->capacity;
    }

    public function getUnitValue() {
        return $this->unitValue;
    }

    public function getTotalCost() {
        return $this->totalCost;
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

    public function getGroupId() {
        return $this->groupId;
    }

    public function getGroupQty() {
        return $this->groupQty;
    }

    public function getPresentLocation() {
        return $this->presentLocation;
    }

    public function getAcquisitionInstitute() {
        return $this->acquisitionInstitute;
    }
	
    public function getnatureOwnership() {
        return $this->natureOwnership;
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

    public function setLedgerno($ledgerno) {
        $this->ledgerno = $ledgerno;
    }

    public function setLedgerFoliono($ledgerFoliono) {
        $this->ledgerFoliono = $ledgerFoliono;
    }

    public function setEqptSriNo($eqptSriNo) {
        $this->eqptSriNo = $eqptSriNo;
    }

    public function setPurchasedDate($purchasedDate) {
        $this->purchasedDate = $purchasedDate;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }

    public function setUnitValue($unitValue) {
        $this->unitValue = $unitValue;
    }

    public function setTotalCost($totalCost) {
        $this->totalCost = $totalCost;
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

    public function setGroupId($groupId) {
        $this->groupId = $groupId;
    }

    public function setGroupQty($groupQty) {
        $this->groupQty = $groupQty;
    }

    public function setPresentLocation($presentLocation) {
        $this->presentLocation = $presentLocation;
    }

    public function setAcquisitionInstitute($acquisitionInstitute) {
        $this->acquisitionInstitute = $acquisitionInstitute;
    }
	
    public function setnatureOwnership($natureOwnership) {
        $this->natureOwnership = $natureOwnership;
    }
		
}
