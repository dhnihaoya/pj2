<?php
//cookie中调用被点击的图片id 直接返回数据库查找该图片的结果（数组形式）
function connectDB(){
    $picID = $_COOKIE['picId'];
    $sql = "SELECT * FROM travelimage WHERE ImageID = '{$picID}'";
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $pdo = null;
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
//调用图片的标题
function getPicTitle(){
    $result = connectDB();
    echo "
    <h3 class=\"panel-title\">{$result["Title"]}</h3></h3>
    ";
}
//调用图片的类型
function  getPicCategory(){
    $result = connectDB();
    return  $result['Category'];
}


//得到并且在html中输出照片作者
function getUserName(){
    //先定好UID
    $searchResult = connectDB();
    $userId = $searchResult['UID'];
    //搜出UID对应的用户名
    $sql = "SELECT * FROM traveluser WHERE UID = '{$userId}'";
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "
    <p>Pic by {$result['UserName']}</p>
    ";
}

//得到并在html中输出这个图片的介绍
function getDescription(){
    $result = connectDB();
    echo "
    <p id = 'description'> {$result['Description']} </p>
    ";
}
//查询图片被收藏的次数
function getFavoredNumberOfPic(){
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
    if($j !== 0){
        echo "
        <p id='favorNumber'>$j</p>
        ";
    }
    else{
        echo "
        <p>还没有人收藏这张照片哦，来成为第一个发现他的人吧！</p>
        ";
    }
    return $j;
}
//在html里面输出图片
function getPic(){
    echo "
        <img src='{$_COOKIE['picSrc']}'>
    ";
}

//在左边的列表输出个人中心
function getFoundationPersonalCenter(){
    if(isset($_COOKIE['userId'])){
        echo "
                <li><label><i class='fi-torso'></i>  个人中心</label></li>
                <li><a href='../src/upload.php'><i class='fi-upload'></i>  上传</a></li>
                <li><a href='../src/mypic.php'><i class='fi-photo'></i>  我的照片</a></li>
                <li><a href='../src/myfavourite.php'><i class='fi-heart'></i> 我的收藏</a></li>
                <li><a href='../php/logout.php'><i class='fi-x'></i>  登出</a></li>
                
              ";
    }
    else{
        echo "
                <li><label>您还未登录</label></li>
                <li><a href = '../src/login.html' >登陆</a ></li >
                <li><a href = '../src/register.html' >注册</a ></li >
                <li onclick=\"alert('别走，再玩会儿～')\"><a>看别的网站去了</a></li>
        ";
    }
}
//返回一个数组，第一位是国家 第二位是城市
function getPicCountryAndCity(){
    //最后输出的答案
    $resultArr = array();
    //开始玩耍数据库找城市名
    $preResult = connectDB();
    //找到城市和国家的编码代号
    $countryCode = $preResult['CountryCodeISO'];
    $cityCode = $preResult['CityCode'];
    //换个表格继续查 找出完整国名
    $sql1 = "SELECT * FROM geocountries WHERE ISO = '{$countryCode}'";
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare($sql1);
    $stmt->execute();
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultArr[0] = $result1['CountryName'];

    //开始找城市名
    $sql2 = "SELECT * FROM geocities WHERE GeoNameID = '{$cityCode}'";
    $stmt = $pdo->prepare($sql2);
    $stmt->execute();
    $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultArr[1] = $result2['AsciiName'];

    return $resultArr;
}

//检查一下我之前有没有赞过此图
function checkFavor(){
    $picId = $_COOKIE['picId'];
    $userId = $_COOKIE['userId'];
    $sql = "SELECT * FROM travelimagefavor WHERE UID = '{$userId}' AND ImageID = '{$picId}'";
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount()>0){
        return true;
    }
    else
        return false;

}
//按照情况输出登陆or收藏or取消收藏
function outPutFavBar(){
    if (isset($_COOKIE['userId'])) {
        if(!checkFavor()) {
            echo "
        <a href=\"#\" class=\"item\" onclick='favorThis()' id = 'favorThisPic'>
                <i class=\"fi-heart\"></i>
                <label>收藏此图</label>
        </a>
        ";
        }
        else{
            echo "
        <a href=\"#\" class=\"item\" onclick='unFavorThis()' id = 'unFavorThisPic'>
                <i class=\"fi-x\"></i>
                <label>不再收藏此图</label>
        </a>
            
            
            ";
        }
    }
    else{
        echo "
        <a href=\"../home.php\" class=\"item\">
                <i class=\"fi-home\"></i>
                <label>登陆后可以收藏</label>
        </a>
        ";
    }
}
?>