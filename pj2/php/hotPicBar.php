<?php
    //$stmt = $pdo->prepare($sql);
    //$stmt->execute();

//返回一个数组，是有收藏的图片的数ImageID
    function getFavoredPicNumbers(){
        $sql = "SELECT DISTINCT ImageID FROM travelimagefavor";
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $res=$pdo->prepare($sql);//准备查询语句
        $res->execute();            //执行查询语句
        $arrOfFavoredImageID = array();
        $i = 0;
        while ($result=$res->fetch(PDO::FETCH_ASSOC)){
            $arrOfFavoredImageID[$i] =  $result["ImageID"];
            $i = $i+1;
        }
        $pdo = null;
     //   print_r($arrOfFavoredImageID);
        return $arrOfFavoredImageID;
    }
 //返回一个数组，和上一个function中每一位对应，存着每张图片的赞数
    function getFavoredNumbers(){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $arrOfFavoredImageID = getFavoredPicNumbers();
        $arrOfFavoredNumbers = array();
        $picNumber = sizeof($arrOfFavoredImageID);
        for ($i = 0; $i < $picNumber ; $i++ ){
            $sql = "SELECT UID FROM travelimagefavor WHERE ImageID = '{$arrOfFavoredImageID[$i]}'";
            $res=$pdo->prepare($sql);//准备查询语句
            $res->execute();            //执行查询语句
            $j = 0;
            while ($result=$res->fetch(PDO::FETCH_ASSOC)){
              //  print_r($result);
                $j = $j+1;
            }
            $arrOfFavoredNumbers[$i] = $j;

        }
        //print_r($arrOfFavoredNumbers);
        $pdo = null;
        return $arrOfFavoredNumbers;
    }
 //返回关联数组 键是id 值是收藏数 $arrOfFavoredImageID[$i]
    function getTable(){
        $arrOfFavoredNumbers = getFavoredNumbers();
        $arrOfFavoredImageID = getFavoredPicNumbers();
        $finalArr = array();
        for ($i = 0 ; $i < count($arrOfFavoredNumbers) ; $i++){
            $finalArr[$arrOfFavoredImageID[$i]] =$arrOfFavoredNumbers[$i] ;
        }
      // print_r($finalArr);
        return $finalArr;
    }
//通过图片ID找到图片路径
    function getSrc($imgID){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT PATH FROM travelimage WHERE ImageID = '{$imgID}'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $src = "travel-images/medium/".$result["PATH"];
        $pdo = null;
        return $src;
    }
//通过图片ID找到图片的标题
    function getTitle($imgID){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT Title FROM travelimage WHERE ImageID = '{$imgID}'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = $result["Title"];
        $pdo = null;
        return $title;
    }
//输出完整的热门图片
    function getHotPicBar(){
        $arr = getTable();
        arsort($arr);
        $astArr = array();
        $i = 0;
            foreach($arr as $x=>$x_value)
            {
                $astArr[$i] = $x;
                $i++;
                if ($i === 3)
                    break;
            }
        $src1 = getSrc($astArr[0]);
        $src2 = getSrc($astArr[1]);
        $src3 = getSrc($astArr[2]);

        $title1 = getTitle($astArr[0]);
        $title2 = getTitle($astArr[1]);
        $title3 = getTitle($astArr[2]);
        echo "
        <div class=\"carousel-inner\">
        <div class=\"item active\">
            <img src=\"{$src1}\" alt=\"First slide\">
            <div class=\"carousel-caption\">{$title1}</div>
        </div>
        <div class=\"item\">
            <img src=\"{$src2}\" alt=\"Second slide\">
            <div class=\"carousel-caption\">{$title2}</div>
        </div>
        <div class=\"item\">
            <img src=\"{$src3}\" alt=\"Third slide\">
            <div class=\"carousel-caption\">{$title3}</div>
        </div>
    </div>
        ";
    }



?>