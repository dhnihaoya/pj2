<?php
require_once('../config.php');
$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
$searchtitle = isset($_GET['type-in-title']) ? $_GET['type-in-title'] : "";
$line = 0;

if(isset($_GET['type-in-title'])){//1。输入标题内容搜索
    $sql = "SELECT ImageID FROM travelimage WHERE Title LIKE :title";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', "%$searchtitle%");
    $stmt -> execute();
    $line = $stmt -> rowCount();
    $result = array();
    for ($j = 0; ($j < ($stmt -> rowCount())) && ($row = $stmt->fetch()); $j++ ){
        array_push($result, $row['ImageID']);
    }
}