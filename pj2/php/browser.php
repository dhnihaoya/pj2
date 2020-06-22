<?php
//返回数组 里面有存在的各个国家ISOCODE
function getDistinctCountries(){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT DISTINCT CountryCodeISO FROM travelimage";
    $res = $pdo->prepare($sql);
    $res->execute();
    $arrOfCountryISOCode = array();
    $i = 0;
    while ($result = $res->fetch(PDO::FETCH_ASSOC)){
        $arrOfCountryISOCode[$i] = $result['CountryCodeISO'];
        $i++;
    }
    $pdo = null;
    return $arrOfCountryISOCode;
}
//返回关联数组 键是国家 值是图片数字
function getHotCountry(){
    $countryISOCodes = getDistinctCountries();
    //print_r($countryISOCodes);
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $countryRealNames = array();
//生成国家真名
    for ($i = 0 ; $i < count($countryISOCodes) ; $i++ ){
        $sql = "SELECT * FROM  geocountries WHERE ISO = '{$countryISOCodes[$i]}' ";
        $res = $pdo->prepare($sql);
        $res->execute();
        $result = $res->fetch(PDO::FETCH_ASSOC);
        $countryRealNames[$i] = $result['CountryName'];
    }
//生成关联数组
    $hotCountry = array();
    for ( $i = 0 ; $i < count($countryISOCodes) ; $i++ ){
        $sql = "SELECT * FROM travelimage WHERE CountryCodeISO = '{$countryISOCodes[$i]}'";
        $res = $pdo->prepare($sql);
        $res->execute();
        $j = 0;
        while ($result = $res->fetch(PDO::FETCH_ASSOC)) {
            $j++;
        }
        $hotCountry[$countryRealNames[$i]] = $j;
    }
    arsort($hotCountry);
    $keys = array_keys($hotCountry);
    echo "
        <a href=\"#\" class=\"list-group-item\" onclick='selectByCountry(this.id)' id='{$keys[0]}'>{$keys[0]}</a>
        <a href=\"#\" class=\"list-group-item\" onclick='selectByCountry(this.id)' id='{$keys[1]}'>{$keys[1]}</a>
        <a href=\"#\" class=\"list-group-item\" onclick='selectByCountry(this.id)' id='{$keys[2]}'>{$keys[2]}</a></a>
        <a href=\"#\" class=\"list-group-item\" onclick='selectByCountry(this.id)' id='{$keys[3]}'>{$keys[3]}</a>
       ";
}
function getDistinctCities(){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT DISTINCT CityCode FROM travelimage";
    $res = $pdo->prepare($sql);
    $res->execute();
    $arrOfCityCode = array();
    $i = 0;
    while ($result = $res->fetch(PDO::FETCH_ASSOC)){
        $arrOfCityCode[$i] = $result['CityCode'];
        $i++;
    }
    $pdo = null;
    return $arrOfCityCode;
}
//返回关联数组 键是城市 值是图片数字
function getHotCity(){
    $cityCodes = getDistinctCities();
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cityRealNames = array();

//生成城市真名
    for ($i = 1 ; $i < count($cityCodes) ; $i++ ){
        $sql = "SELECT * FROM  geocities WHERE GeoNameID = '{$cityCodes[$i]}' ";
        $res = $pdo->prepare($sql);
        $res->execute();
        $result = $res->fetch(PDO::FETCH_ASSOC);
        $cityRealNames[$i] = $result['AsciiName'];
    }
//生成关联数组
    $hotCity = array();
    for ( $i = 1 ; $i < count($cityCodes) ; $i++ ){
        $sql = "SELECT * FROM travelimage WHERE CityCode = '{$cityCodes[$i]}'";
        $res = $pdo->prepare($sql);
        $res->execute();
        $j = 0;
        while ($result = $res->fetch(PDO::FETCH_ASSOC)) {
            $j++;
        }
        $hotCity[$cityRealNames[$i]] = $j;
    }
    arsort($hotCity);
    $keys = array_keys($hotCity);
    echo "
        <a href=\"#\" class=\"list-group-item\" onclick='selectByCity(this.id)' id='{$keys[0]}'>{$keys[0]}</a>
        <a href=\"#\" class=\"list-group-item\" onclick='selectByCity(this.id)' id='{$keys[1]}'>{$keys[1]}</a>
        <a href=\"#\" class=\"list-group-item\" onclick='selectByCity(this.id)' id='{$keys[2]}'>{$keys[2]}</a>
        <a href=\"#\" class=\"list-group-item\" onclick='selectByCity(this.id)' id='{$keys[3]}'>{$keys[3]}</a>
       ";
}






/*
<li><a href="#">&laquo;</a></li>
<li class="active"><a href="#">1</a></li>
<li class="disabled"><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">&raquo;</a></li>
*/
?>
