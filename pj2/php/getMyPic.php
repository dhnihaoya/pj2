<?php

require("getFavPics.php");

function getMyPicsID(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $myID = $_COOKIE['userId'];
    $sql = "SELECT * FROM travelimage WHERE UID = '{$myID}'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $arrOfMyImageID = array();
    $i = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $arrOfMyImageID[$i] = $result['ImageID'];
        $i++;
    }
    $pdo = null;
    return $arrOfMyImageID;
}

function getMyPicsSrc($arrOfImageID){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $arrOfMyImageSrc = array();
    for ( $i = 0 ; $i < count($arrOfImageID) ; $i++ ){
        $sql = "SELECT * FROM travelimage WHERE ImageID = '{$arrOfImageID[$i]}'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $arrOfMyImageSrc[$i] = "../travel-images/medium/".$result['PATH'];
    }
    $pdo = null;
    return $arrOfMyImageSrc;
}


function getMyPicsTitle($arrOfImageID){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $arrOfMyImageTitle = array();
    for ( $i = 0 ; $i < count($arrOfImageID) ; $i++ ){
        $sql = "SELECT * FROM travelimage WHERE ImageID = '{$arrOfImageID[$i]}'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $arrOfMyImageTitle[$i] = $result['Title'];
    }
    $pdo = null;
    return $arrOfMyImageTitle;
}

function getMyPicsDescription($arrOfImageID){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $arrOfMyImageDescription = array();
    for ($i = 0; $i < count($arrOfImageID); $i++) {
        $sql = "SELECT * FROM travelimage WHERE ImageID = '{$arrOfImageID[$i]}'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $arrOfMyImageDescription[$i] = $result['Description'];
    }
    $pdo = null;
    return $arrOfMyImageDescription;
}

function outPutMyContent(){
    $myPicNumber = count(getMyPicsID());
    if($myPicNumber !== 0){
        $arrOfMyPicsTitle = getMyPicsTitle(getMyPicsID());
        $arrOfMyPicsDescription = getMyPicsDescription(getMyPicsID());
        $arrOfMyPicsSrc = getMyPicsSrc(getMyPicsID());
        $arrOfMyPicID = getMyPicsID();
        for($i = 0 ; $i < $myPicNumber ; $i++){
            $pageNum = $i + 1;
            echo "
                <div data-magellan-destination=\"page{$pageNum}\" id = '{$arrOfMyPicID[$i]}' class='demoFavBar' onclick='jump(this.id)'>
                    <h2>{$arrOfMyPicsTitle[$i]}</h2>
                    <div class=\"panel\">
                      <img src=\"{$arrOfMyPicsSrc[$i]}\" alt=\"Cinque Terre\" width=\"400\" height=\"300\"onclick='jump(this.id)' id = '{$arrOfMyPicID[$i]}'> 
                      <div class=\"container\">
                        <p>{$arrOfMyPicsDescription[$i]}</p>
                        <button type=\"button\" class=\"button\" onclick='modifyPic(this.id)' id='del{$arrOfMyPicID[$i]}'>修改此图</button>
                        <button type=\"button\" class=\"button info\" onclick='deletePic(this.id)' id='btn{$arrOfMyPicID[$i]}'>删去此图</button>
                      </div>
                    </div>
                </div>
             ";
        }
    }
    else{
        echo "
        <div style=\"padding:20px;\">
          <h2>这里应该有您收藏的图片</h2>
          <div class=\"panel callout\">
            <h3>图片标题</h3>
            <p>你还没上传任何照片</p>
            <p>快去上传你的照片</p>
          </div>
        </div>
        
        ";
    }
}


function outPutMyMagellanNav(){
    $myPicNumber = count(getMyPicsTitle(getMyPicsID()));
    if($myPicNumber !== 0){
        $arrOfMyPicTitle = getMyPicsTitle(getMyPicsID());
        for($i = 0 ; $i < $myPicNumber ; $i++ ) {
            $pageNum = $i + 1;
            echo "
             <dd data-magellan-arrival=\"page{$pageNum}\"><a href=\"#page{$pageNum}\">{$arrOfMyPicTitle[$i]}</a></dd>
             ";
        }
    }
    else{
        echo "
            <dd data-magellan-arrival=\"page1\">
                       <a href='../src/upload.php' data-tooltip title=\"去上传照片\">你还没有收藏的照片哦 快来分享你的照片吧</a>
            </dd>
         ";
    }

}




?>