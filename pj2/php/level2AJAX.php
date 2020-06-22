<?php
require("../config.php");
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$cityGeoNameID = '0';
if($_POST['city'] !== '0'){
    $sql = "SELECT * FROM geocities WHERE AsciiName = '{$_POST['city']}'";
    $res = $pdo->query($sql);
    $result = $res->fetch(PDO::FETCH_ASSOC);
    $cityGeoNameID = $result['GeoNameID'];
}
$content = $_POST['content'];
$countryCode = $_POST['countryCode'];

//准备sql
////有内容 有国家 有城市
if($content!== '0' && $countryCode!=='0' && $cityGeoNameID!=='0')
    $sql2 = "SELECT * FROM travelimage WHERE Category = '{$content}' AND CityCode = '{$cityGeoNameID}' AND CountryCodeISO = '{$countryCode}'";
//有内容 有国家 没城市
if ($content!=='0' && $countryCode!=='0' && $cityGeoNameID=='0')
    $sql2 = "SELECT * FROM travelimage WHERE Category = '{$content}' AND CountryCodeISO = '{$countryCode}'";
//有内容 没国家
if ($content!=='0' && $countryCode=='0' )
    $sql2 = "SELECT * FROM travelimage WHERE Category = '{$content}'";
//没内容 有国家 没城市
if($content=='0' && $countryCode!='0' && $cityGeoNameID=='0')
    $sql2 = "SELECT * FROM travelimage WHERE CountryCodeISO = '{$countryCode}'";
//没内容 有国家 有城市
if($content == '0' && $countryCode !=='0' && $cityGeoNameID!=='0')
    $sql2 = "SELECT * FROM travelimage WHERE CityCode = '{$cityGeoNameID}' AND CountryCodeISO = '{$countryCode}'";

//查找并把结果填充进数组
$arrOfPicId = array();
$arrOfPicSrc = array();
$res2 = $pdo->prepare($sql2);
$res2->execute();
$i = 0;
while ($result2 = $res2->fetch(PDO::FETCH_ASSOC)){
    $arrOfPicSrc[$i] = "../travel-images/medium/".$result2['PATH'];
    $arrOfPicId[$i] = $result2['ImageID'];
    $i++;
}


$outPut = "<tr>";
for($i = 0 ; $i < count($arrOfPicId) ; $i++ ){
    $outPut .= "
                <td id='No{$i}' ><a href='#' id='{$arrOfPicId[$i]}' onclick='setPicCookie(this.id)'><img src=\"{$arrOfPicSrc[$i]}\" ></a></td>
                    ";
    if($i%4 === 3){
        $outPut .= "</tr><tr>";
    }
}
$outPut .= "</tr>";
$expiryTime = time()+60*60*24;
setcookie("numOfPic",count($arrOfPicSrc) ,$expiryTime ,"/pj2/");
echo $outPut;

?>