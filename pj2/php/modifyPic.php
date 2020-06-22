<?php
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$picId = $_COOKIE['picId'];
$picSrc = $_COOKIE['picSrc'];

$sql = "SELECT * FROM travelimges WHERE ImageID = '{$picId}'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$category = $result['Category'];
$expiryTime = time()+600;
setcookie('picToModCat',$category ,$expiryTime, '/pj2/' );

//echo $category;