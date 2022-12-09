<?php

if ($searchby == 'Identification Number') {
    $column = "identificationno";
} elseif ($searchby == 'Province') {
    $column = "province";
} elseif ($searchby == 'District') {
    $column = "district";
} elseif ($searchby == 'DS Division') {
    $column = "dsDivision";
} elseif ($searchby == 'GS Division') {
    $column = "gsDivision";
} elseif ($searchby == 'Building Category') {
    $column = "buildingCategory";
} elseif ($searchby == 'Assets No') {
    $column = "assetsno";
} elseif ($searchby == 'Classification No') {
    $column = "classificationno";
} elseif ($searchby == 'Nature of the Ownership') {
    $column = "natureOwnership";
} elseif ($searchby == 'Ownership') {
    $column = "ownership";
} elseif ($searchby == 'Name of Land') {
    $column = "landname";
} elseif ($searchby == 'Name of Owner') {
    $column = "ownerName";
} elseif ($searchby == 'Building Type') {
    $column = "buildingType";
} elseif ($searchby == 'Rent and Rates') {
    $column = "rentAndRate";
} elseif ($searchby == 'Reg. Name of Owner') {
    $column = "regOwnerName";
} elseif ($searchby == 'Building Number') {
    $column = "buildingno";
} elseif ($searchby == 'Plan Number') {
    $column = "planno";
} elseif ($searchby == 'Plan Date') {
    $column = "plandate";
} elseif ($searchby == 'Area Measurement Type') {
    $column = "areaMeasure";
} elseif ($searchby == 'Area') {
    $column = "area";
} elseif ($searchby == 'Construction Cost') {
    $column = "constructionCost";
} elseif ($searchby == 'Addition Cost') {
    $column = "additionsValue";
} elseif ($searchby == 'Alternative Cost') {
    $column = "alterationValue";
} elseif ($searchby == 'Date of Acquisition') {
    $column = "acquisitiondate";
}
$header = Array("Assets Center",  "assetunit",
 "Province",
    "District",
 "DS Division",
 "GS Division",
 "Land Name",
 "OwnerName",
 "Building Category",
 "Assets No",
 "Building Type",
 "Rent And Rate",
 "Ownership",
 "Reg. OwnerName",
 "Classification No",
 "Identification No",
 "Building No",
 "Plan No",
 "Plan Date",
 "Area Measure",
 "Area",
 "Construction Cost",
 "Additions Value",
 "Alteration Value",
 "Acquisition date",
 "Remarks");
?>
