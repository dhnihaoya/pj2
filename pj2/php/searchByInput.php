<?php
require_once('../config.php');

$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$searchInput = $_GET['searchInput'];
$searchType = $_GET['searchType'];

if($searchType == 'Title')
    $sql = "SELECT * FROM travelimage WHERE Title LIKE '%{$searchInput}%'";
else
    $sql = " SELECT * FROM travelimage WHERE Description LIKE '%{$searchInput}%'";

$res = $pdo->prepare($sql);
$res->execute();
$arrOfPicID = array();
$arrOfPicSrc = array();
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
$expiryTime = time()+60*60*24;
setcookie("numOfPic",count($arrOfPicSrc) ,$expiryTime ,"/pj2/");
$pdo = null;
echo $outPut;

?>