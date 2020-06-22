<?php
require("../config.php");
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM travelimage WHERE UID ='{$_COOKIE['userId']}' AND ImageID = '{$_COOKIE['picToDelID']}'";
$pdo->exec($sql);
$sql = "DELETE FROM travelimagefavor WHERE ImageID = '{$_COOKIE['picToDelID']}'";
$pdo->exec($sql);
setcookie("picToDelID", "", -1);
echo "删除成功";
?>
