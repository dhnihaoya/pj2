<?php
    require("../config.php");
    require("../php/getPicDetail.php");
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM travelimagefavor";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $i = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $i = $result['FavorID'];
    }

    $newRecNum = $i + 1;
    $delRecNum = $newRecNum - 1;
    $FavNumber = getFavNum();
    if(isset($_COOKIE['q'])){
        if($_COOKIE['q'] == 1){
            $sql = "
            INSERT INTO travelimagefavor (FavorID, UID, ImageID)
            VALUES ('{$newRecNum}','{$_COOKIE['userId']}',{$_COOKIE['picId']}); 
            ";
            $pdo->exec($sql);
            $newFavNumber = $FavNumber + 1;
            echo "{$newFavNumber}";
        }
        else{
            $sql = "
            Delete FROM travelimagefavor Where FavorID = '{$delRecNum}'
            ";
            $pdo->exec($sql);
            $newFavNumber = $FavNumber - 1;
            echo "{$newFavNumber}";
        }
    }
    else {
        echo "<script>alert('q is undefined');</script>";
    }

function getFavNum(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT UID FROM travelimagefavor WHERE ImageID = '{$_COOKIE['picId']}'";
    $res=$pdo->prepare($sql);//准备查询语句
    $res->execute();            //执行查询语句
    $j = 0;
    while ($result=$res->fetch(PDO::FETCH_ASSOC)){
        //  print_r($result);
        $j = $j+1;
    }
    return $j;
}


?>