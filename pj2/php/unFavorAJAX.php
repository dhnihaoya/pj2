<?php
require("../config.php");
$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM travelimagefavor WHERE UID ='{$_COOKIE['userId']}' AND ImageID = '{$_COOKIE['picToUnFavID']}'";
$pdo->exec($sql);
setcookie("picToDelID","",-1);
echo "取消收藏成功";

?>