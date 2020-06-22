<?php
require("../config.php");
//browser左边的通过热门类别，城市，国家
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$arrOfPicID = array();
$arrOfPicSrc = array();
switch ($_COOKIE['searchType']) {
    case "city":
        $sql = "SELECT * FROM geocities WHERE AsciiName ='{$_COOKIE['cityName']}'";
        setcookie('cityName',"",-1);
        $res = $pdo->query($sql);
        $result = $res->fetch(PDO::FETCH_ASSOC);
        //print_r($result);
        $cityCode = $result['GeoNameID'];
        //用城市的ISOCode找图片
        $sql = "SELECT * FROM travelimage WHERE CityCode = '{$cityCode}'";
        break;
    case "category":
        $sql = "SELECT * FROM travelimage WHERE Category = '{$_COOKIE['category']}'";
        setcookie('category',"",-1);
        break;
    case "country":
        $sql = "SELECT * FROM geocountries WHERE CountryName = '{$_COOKIE['country']}'";
        setcookie('country',"",-1);
        $res = $pdo->query($sql);
        $result = $res->fetch(PDO::FETCH_ASSOC);
        $ISO = $result['ISO'];
        $sql = "SELECT * FROM travelimage WHERE CountryCodeISO ='{$ISO}'";
        break;
}
        $res = $pdo->prepare($sql);
        $res->execute();
        $i = 0;
        while ($result = $res->fetch(PDO::FETCH_ASSOC)) {
            $arrOfPicID[$i] = $result['ImageID'];
            $arrOfPicSrc[$i] = "../travel-images/medium/{$result['PATH']}";
            $i++;
        }

        $outPut = "<tr>";
        for($i = 0 ; $i < count($arrOfPicID) ; $i++ ){
            $outPut .= "
                <td id='No{$i}' ><a href='#' id='{$arrOfPicID[$i]}' onclick='setPicCookie(this.id)'><img src=\"{$arrOfPicSrc[$i]}\" ></a></td>
                    ";
            if($i%4 === 3){
                $outPut .= "</tr><tr>";
            }
        }
        $outPut .= "</tr>";
        setcookie("searchType" , "" , -1);

        $pdo = null;

        $expiryTime = time()+60*60*24;
        setcookie("numOfPic",count($arrOfPicSrc) ,$expiryTime ,"/pj2/");

        echo $outPut;














?>