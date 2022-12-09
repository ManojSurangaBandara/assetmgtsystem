<?php
if ($searchby == 'Identification Number') {
    $column = "identificationno";
} elseif ($searchby == 'Main Category') {
    $column = "mainCategory";  
} elseif ($searchby == 'Item Category') {
    $column = "itemCategory";
} elseif ($searchby == 'Item Description') {
    $column = "itemDescription";
} elseif ($searchby == 'Catalogue Number') {
    $column = "catalogueno";
} elseif ($searchby == 'Assets Number') {
    $column = "assetsno";
} elseif ($searchby == 'Classification No') {
    $column = "newAssestno";
} elseif ($searchby == 'Ledger Number') {
    $column = "ledgerno";
} elseif ($searchby == 'Ledger Folio Number') {
    $column = "ledgerFoliono";
} elseif ($searchby == 'Serial Number') {
    $column = "eqptSriNo";
} elseif ($searchby == 'Date of Purchased') {
    $column = "purchasedDate";
} elseif ($searchby == 'Date of Received') {
    $column = "receivedDate";
}
?>
