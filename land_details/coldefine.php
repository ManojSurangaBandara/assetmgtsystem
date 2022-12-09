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
} elseif ($searchby == 'Land Category') {
    $column = "category";
} elseif ($searchby == 'Assets No') {
    $column = "assetsno";
} elseif ($searchby == 'Classification No') {
    $column = "classificationno";
} elseif ($searchby == 'Register Number') {
    $column = "register";
} elseif ($searchby == 'Land Name') {
    $column = "landname";
} elseif ($searchby == 'Plan Number') {
    $column = "planno";
} elseif ($searchby == 'Title Deed Number') {
    $column = "deedno";
} elseif ($searchby == 'Title Deed Date') {
    $column = "deeddate";
} elseif ($searchby == 'Nature of Land') {
    $column = "landNature";
} elseif ($searchby == 'Area') {
    $column = "area";
} elseif ($searchby == 'Date of Acquisition') {
    $column = "acquisitiondate";
} elseif ($searchby == 'Remarks') {
    $column = "remarks";
}
?>
