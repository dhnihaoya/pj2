<?php
require ("../config.php");
    // 获取上传的图片
    $pic = $_FILES['pic']['tmp_name'];
    $upload_ret = false;

    if($pic){
        // 上传的路径，建议写物理路径
        $uploadDir = '../travel-images/medium';
        // 创建文件夹
        if(!file_exists($uploadDir)){
            mkdir($uploadDir, 0777);
        }
        // 用时间戳来保存图片，防止重复
        $targetFile = $uploadDir . '/' . $_FILES['pic']['name'];
        // 将临时文件 移动到我们指定的路径，返回上传结果
        $upload_ret = move_uploaded_file($pic, $targetFile) ? true : false;
    }

    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $picTitle = $_POST['Title'];
    $picCity = $_POST['city'];
    if($picCity == "选择城市")
        $picCity = null;
    $picDes = $_POST['Description'];
    $picCountry = $_POST['country'];
    $picPATH = $_FILES['pic']['name'];
    $picCate = $_POST['category'];

    $sql = "SELECT * FROM geocountries where CountryName = '{$picCountry}'";
    $res= $pdo->query($sql);
    $result = $res->fetch(PDO::FETCH_ASSOC);
    $picCountry = $result['ISO'];

    if($picCity != null){
        $sql = "SELECT * FROM geocities WHERE AsciiName = '{$picCity}'";
        $res= $pdo->query($sql);
        $result = $res->fetch(PDO::FETCH_ASSOC);
        $picCity = $result['GeoNameID'];
    }


    $sql = "SELECT * FROM travelimage";
    $res = $pdo->prepare($sql);
    $res->execute();
    $i=0;
    while ($result = $res->fetch(PDO::FETCH_ASSOC) ){
        $i = $result['ImageID'];
    }
    $imageID = (int)$i + 1;
if($picCity != null) {
    $sql = "
    INSERT INTO travelimage (ImageID, Title,Description,Latitude,Longitude,CityCode,CountryCodeISO,UID,PATH,Category)
    VALUES('{$imageID}','{$picTitle}','{$picDes}',2,2,'{$picCity}','{$picCountry}','{$_COOKIE['userId']}','{$_FILES['pic']['name']}','{$picCate}')
    ";
}
else{
    $sql = "
    INSERT INTO travelimage (ImageID,Title,Description,Latitude,Longitude,CountryCodeISO,UID,PATH)
    VALUES('{$imageID}','{$picTitle}','{$picDes}',2,2,'{$picCountry}','{$_COOKIE['userId']}','{$_FILES['pic']['name']}','{$picCate}')
    ";
}

    $res = $pdo->prepare($sql);
    $res->execute();

    $expiryTime = time()+60;
    $path = "../travel-images/medium/{$_FILES['pic']['name']}";
    setcookie("picId" ,$imageID , $expiryTime, '/pj2/');
    setcookie("picSrc",$path,$expiryTime,'/pj2/');

    $url = "../src/picDetail.php";
    Header("Location: ".$url);










//"INSERT INTO traveluser (UID, UserName, Pass, State, DateJoined, DateLastModified)
//VALUES ('{$newUserNumber}','{$newUserId}','{$newUserPassword}',1,'{$registerTime}','{$registerTime}')";











?>
