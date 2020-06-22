<?php
function getDistinctCountries(){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT DISTINCT ISO FROM geocountries";
    $res = $pdo->prepare($sql);
    $res->execute();
    $arrOfCountryISOCode = array();
    $i = 0;
    while ($result = $res->fetch(PDO::FETCH_ASSOC)){
        $arrOfCountryISOCode[$i] = $result['ISO'];
        $i++;
    }
    $pdo = null;
    return $arrOfCountryISOCode;
}

function getCountrySelections(){
    $output = "";
    $arrOfCountryISOCode = getDistinctCountries();
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $countryRealNames = array();
//生成国家真名
    for ($i = 0 ; $i < count($arrOfCountryISOCode) ; $i++ ){
        $sql = "SELECT * FROM  geocountries WHERE ISO = '{$arrOfCountryISOCode[$i]}' ";
        $res = $pdo->prepare($sql);
        $res->execute();
        $result = $res->fetch(PDO::FETCH_ASSOC);
        $countryRealNames[$i] = $result['CountryName'];
    }
    $pdo = null;
    for($i=0; $i<count($arrOfCountryISOCode);$i++){
        $output.= "<option id='{$arrOfCountryISOCode[$i]}'>{$countryRealNames[$i]}</option>";
    }
    echo $output;
}


function getDistinctCities(){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT DISTINCT GeoNameID FROM geocities";
    $res = $pdo->prepare($sql);
    $res->execute();
    $arrOfCityCode = array();
    $i = 0;
    while ($result = $res->fetch(PDO::FETCH_ASSOC)){
        $arrOfCityCode[$i] = $result['GeoNameID'];
        $i++;
    }
    $pdo = null;
    return $arrOfCityCode;
}

function getCitySelections(){
    $output = "";
    $arrOfCityISOCode = getDistinctCities();
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cityRealNames = array();
    for ($i = 0 ; $i < count($arrOfCityISOCode) ; $i++ ){
        $sql = "SELECT * FROM  geocities WHERE GeoNameID = '{$arrOfCityISOCode[$i]}' ";
        $res = $pdo->prepare($sql);
        $res->execute();
        $result = $res->fetch(PDO::FETCH_ASSOC);
        $cityRealNames[$i] = $result['AsciiName'];
    }
    $pdo = null;
    for($i=0; $i<1000;$i++){
        $output.= "<option id='{$arrOfCityISOCode[$i]}'>{$cityRealNames[$i]}</option>";
    }
    echo $output;
}







































?>