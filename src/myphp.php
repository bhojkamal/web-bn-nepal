<?php
// XML data and convert those data in more readable JSON format

$xmlNode = simplexml_load_file('http://ftp.geoinfo.msl.mt.gov/Documents/Metadata/GIS_Inventory/35524afc-669b-4614-9f44-43506ae21a1d.xml');
$arrayData = xmlToArray($xmlNode);
echo json_encode($arrayData);