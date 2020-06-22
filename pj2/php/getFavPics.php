<?php
//返回数组 内容是收藏的图片ImageID
 function getMyFavPicsID(){
     $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $myID = $_COOKIE['userId'];
     $sql = "SELECT * FROM travelimagefavor WHERE UID = '{$myID}'";
     $stmt = $pdo->prepare($sql);
     $stmt->execute();
     $arrOfImageID = array();
     $i = 0;
     while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $arrOfImageID[$i] = $result['ImageID'];
        $i++;
     }
     $pdo = null;
     return $arrOfImageID;

 }
//输入图片的ID数组 输出对应的PATH数组
 function getMyFavPicsSrcByID($arrOfImageID){
     $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $arrOfImageSrc = array();
     for ( $i = 0 ; $i < count($arrOfImageID) ; $i++ ){
         $sql = "SELECT * FROM travelimage WHERE ImageID = '{$arrOfImageID[$i]}'";
         $stmt = $pdo->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         $arrOfImageSrc[$i] = "../travel-images/medium/".$result['PATH'];
     }
     $pdo = null;
     return $arrOfImageSrc;
 }
//输入
 function getMyFavPicsTitleByID($arrOfImageID){
     $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $arrOfImageTitle = array();
     for ($i = 0; $i < count($arrOfImageID); $i++) {
         $sql = "SELECT * FROM travelimage WHERE ImageID = '{$arrOfImageID[$i]}'";
         $stmt = $pdo->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         $arrOfImageTitle[$i] = $result['Title'];
     }
     $pdo = null;
     return $arrOfImageTitle;
 }

 function getMyFavPicsDescriptionByID($arrOfImageID){
     $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $arrOfImageDescription = array();
     for ($i = 0; $i < count($arrOfImageID); $i++) {
         $sql = "SELECT * FROM travelimage WHERE ImageID = '{$arrOfImageID[$i]}'";
         $stmt = $pdo->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         $arrOfImageDescription[$i] = $result['Description'];
     }
     $pdo = null;
     return $arrOfImageDescription;
 }

 function getMyFavUserByID($arrOfImageID){
     $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $arrOfImageUser = array();
     for ($i = 0; $i < count($arrOfImageID); $i++) {
         $sql = "SELECT * FROM travelimage WHERE ImageID = '{$arrOfImageID[$i]}'";
         $stmt = $pdo->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         $arrOfImageUser[$i] = $result['UID'];
         $sql = "SELECT * FROM traveluser WHERE UID = '{$arrOfImageUser[$i]}'";
         $stmt = $pdo->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         $arrOfImageUser[$i] = $result['UserName'];
     }
     $pdo = null;
     return $arrOfImageUser;
 }



 function outPutMagellanNav(){
     $favPicNumber = count(getMyFavPicsID());
     if( $favPicNumber !== 0){
         $arrOfPicTitle = getMyFavPicsTitleByID(getMyFavPicsID());
          for($i = 0 ; $i < $favPicNumber ; $i++ ){
              $pageNum = $i + 1;
              $picID = getMyFavPicsID()[$i];
              $magNavID = "magNav{$picID}";
             echo "
             <dd data-magellan-arrival=\"page{$pageNum}\" id=\"{$magNavID}\" class='magellan'>
                <a href=\"#page{$pageNum}\">{$arrOfPicTitle[$i]}</a>
             </dd>
             ";
         }
     }
     else{
         echo ">
                       <a href=>你还没有收藏的照片哦 快去找找有没有喜欢的吧</a>
            </dd>
         ";
     }
 }


 function outPutFavContent(){
     $favPicNumber = count(getMyFavPicsID());
     if($favPicNumber !== 0){
         $arrOfPicsTitle = getMyFavPicsTitleByID(getMyFavPicsID());
         $arrOfPicsDescription = getMyFavPicsDescriptionByID(getMyFavPicsID());
         $arrOfPicsSrc = getMyFavPicsSrcByID(getMyFavPicsID());
         $arrOfPicUser = getMyFavUserByID(getMyFavPicsID());
         $arrOfPicID = getMyFavPicsID();
         for($i = 0 ; $i < $favPicNumber ; $i++){
             $pageNum = $i + 1;
             echo "
                <div data-magellan-destination=\"page{$pageNum}\" onclick='jump(this.id)' id='{$arrOfPicID[$i]}' class='demoFavBar'>
                    <h2>{$arrOfPicsTitle[$i]}</h2>
                    <div class=\"panel\">
                    <div class='outerDiv'>
                      <img src=\"{$arrOfPicsSrc[$i]}\" alt=\"Cinque Terre\" width=\"400\" height=\"300\"> 
                      <div class=\"container\">
                        <h4>By {$arrOfPicUser[$i]}</h4>
                        <p>{$arrOfPicsDescription[$i]}</p>
                      </div>
                    </div>
                      <button type=\"button\" class=\"button\" onclick='unFavor(this.id)' id='btn{$arrOfPicID[$i]}'>不再收藏</button>
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
            <p>你还没收藏任何照片</p>
            <p>快去别的页面收藏喜欢的照片吧兄dei</p>
          </div>
        </div>
        
        ";
     }
 }





?>