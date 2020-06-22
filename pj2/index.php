<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>你好 世界</title>
    <script src="https://cdn.staticfile.org/vue/2.4.2/vue.min.js"></script>
    <link rel="stylesheet" href="css/reset.css" type="text/css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
    <link rel="stylesheet" id="style" class="daytime" href="css/daytime.css">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!--最左小标题 -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#" id="top">旅游</a>
        </div>
        <!--左侧两个小标题-->
        <div>
            <ul class="nav navbar-nav">
                <li><a href="src/browser.php"><span class="glyphicon glyphicon-plane"></span> 浏览</a></li>
                <li class="active"><a><span class="glyphicon glyphicon-home"></span>  主页</a></li>
                <li><a href="src/search.php"><span class="glyphicon glyphicon-search"></span>  搜索</a></li>
            </ul>
            <!--右侧两个下拉列表-->
            <ul class="nav navbar-nav navbar-right">
                <!--右侧第一个（个人中心）-->
                <?php
                    require('php/getNavBar.php');
                    getPersonalCenter();
                ?>
                <!--右侧第二个（日间/夜间模式）-->
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="styleChanger">
                        日间模式 <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li id="daytime" style="text-align: center">日间模式</li>
                        <li class="divider"></li>
                        <li id="nighttime" style="text-align: center">夜间模式</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<p id="HOT">    热门图片展示</p>
<div id="myCarousel" class="carousel slide">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- 轮播（Carousel）项目 -->
    <?php
    require ("config.php");
    require ("php/hotPicBar.php");
    getHotPicBar();
    ?>
    <!-- 轮播（Carousel）导航 -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>



<!--缩略图展示-->
<?php
    require("php/randomPic.php");
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlSearchPicNumber = "SELECT * FROM travelimage";
    $picNumber = $pdo->query($sqlSearchPicNumber)->rowCount();

?>
<!--第一行缩略图-->
<div class="row">
    <!-- the first tiny pic of the row-->
    <div class="col-md-3 col-sm-6">
        <?php
        //调用写的随机图片类，这边的num就是图片的imageID
        $picture1 = new randomPic();
        $num1 = $picture1->generateRandomID(0.125);
        $picture1->setPicId($num1);

        echo "<div class = \"thumbnail\" onclick=\"jumpToPicDetail($num1)\">";
        echo "<img src=\"{$picture1->getPicPath()}\" alt= \"一张图\" id=\"pic{$num1}\">";
        //为了蹭分用的vue框架
        echo  " <div class=\"caption\" id=\"vue_{$num1}\">";
        ?>
                <h3>{{Title}}</h3>
                <p>{{Description}}</p>
            </div>
        <?php
            $picture1->demoPic();
        ?>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <?php
        $picture2 = new randomPic();
        $num2 = $picture2->generateRandomID(0.125,0.25);
        $picture2->setPicId($num2);

        echo "<div class = \"thumbnail\" onclick=\"jumpToPicDetail($num2)\">";
        echo "<img src=\"{$picture2->getPicPath()}\" alt= \"一张图\" id='pic{$num2}'>";
        echo  " <div class=\"caption\" id='vue_{$num2}'>";
        ?>
                <h3>{{Title}}</h3>
                <p>{{Description}}</p>
            </div>
            <?php
            $picture2->demoPic();
            ?>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <?php
        $picture3 = new randomPic();
        $num3 = $picture3->generateRandomID(0.25,0.375);
        $picture3->setPicId($num3);

        echo "<div class = \"thumbnail\" onclick=\"jumpToPicDetail($num3)\">";
        echo "<img src=\"{$picture3->getPicPath()}\" alt= \"一张图\" id='pic{$num3}'>";
        echo  " <div class=\"caption\" id='vue_{$num3}'>";
        ?>
                <h3>{{Title}}</h3>
                <p>{{Description}}</p>
            </div>
            <?php
            $picture3->demoPic();
            ?>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <?php
        $picture4 = new randomPic();
        $num4 = $picture4->generateRandomID(0.375,0.5);
        $picture4->setPicId($num4);

        echo "<div class = \"thumbnail\" onclick=\"jumpToPicDetail($num4)\">";
        echo "<img src=\"{$picture4->getPicPath()}\" alt= \"一张图\" id='pic{$num4}'>";
        echo  " <div class=\"caption\" id='vue_{$num4}'>";
        ?>
                <h3>{{Title}}</h3>
                <p>{{Description}}</p>
            </div>
            <?php
            $picture4->demoPic();
            ?>
        </div>
    </div>
</div>
<!-- another row of tiny pics-->
<div class="row">
    <!-- the first tiny pic of the row-->
    <div class="col-md-3 col-sm-6">
        <?php
        $picture5 = new randomPic();
        $num5 = $picture5->generateRandomID(0.5,0.625);
        $picture5->setPicId($num5);

        echo "<div class = \"thumbnail\" onclick=\"jumpToPicDetail($num5)\">";
        echo "<img src=\"{$picture5->getPicPath()}\" alt= \"一张图\" id='pic{$num5}'>";
        echo  " <div class=\"caption\" id='vue_{$num5}'>";
        ?>
                <h3>{{Title}}</h3>
                <p>{{Description}}</p>
            </div>
            <?php
            $picture5->demoPic();
            ?>
        </div>
    </div>


    <div class="col-md-3 col-sm-6">
        <?php
        $picture6 = new randomPic();
        $num6 = $picture6->generateRandomID(0.625,0.75);
        $picture6->setPicId($num6);

        echo "<div class = \"thumbnail\" onclick=\"jumpToPicDetail($num6)\">";
        echo "<img src=\"{$picture6->getPicPath()}\" alt= \"一张图\" id='pic{$num6}'>";
        echo  " <div class=\"caption\" id='vue_{$num6}'>";
        ?>
        <h3>{{Title}}</h3>
        <p>{{Description}}</p>
            </div>
            <?php
            $picture6->demoPic();
            ?>
        </div>
    </div>



    <div class="col-md-3 col-sm-6">
        <?php
        $picture7 = new randomPic();
        $num7 = $picture7->generateRandomID(0.75,0.875);
        $picture7->setPicId($num7);

        echo "<div class = \"thumbnail\" onclick=\"jumpToPicDetail($num7)\">";
        echo "<img src=\"{$picture7->getPicPath()}\" alt= \"一张图\" id='pic{$num7}'>";
        echo  " <div class=\"caption\" id='vue_{$num7}'>";
        ?>
        <h3>{{Title}}</h3>
        <p>{{Description}}</p>
            </div>
            <?php
            $picture7->demoPic();
            ?>
        </div>
    </div>

    <div class="col-md-3 col-sm-6" onclick="">
        <?php
        $picture8 = new randomPic();
        $num8 = $picture8->generateRandomID(0.875,1);
        $picture8->setPicId($num8);
        echo "<div class = \"thumbnail\" onclick=\"jumpToPicDetail($num8)\">";
        echo "<img src=\"{$picture8->getPicPath()}\" alt= \"一张图\" id='pic{$num8}'>";
        echo  " <div class=\"caption\" id='vue_{$num8}'>";
        ?>
        <h3>{{Title}}</h3>
        <p>{{Description}}</p>
            </div>
            <?php
            $picture8->demoPic();
            ?>
        </div>
    </div>
</div>
<!-- the third row of tiny pics-->

<a href="#myCarousel">
    <img src="pics/totop.jpg" id="assist">
</a>
<a>
    <img src="pics/refresh.png" id="refresh" onclick="window.location.reload();">
</a>

<!--面包屑导航 -->
<ul class="breadcrumb">
    <li><a href="#">你好 世界</a></li>
    <li><a href="#top">首页</a></li>
    <li class="active"><?php echo date("Y-m-d");?></li>
    <li>
        <?php
        if(isset($_COOKIE['Username'])){
            echo"{$_COOKIE['Username']} 你好" ;
        }
        ?>
    </li>
</ul>

<footer>
    <p> 19302010002 湖人总冠军！！！</p>
</footer>


<script src="javascript/jquery.js"></script>
<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="javascript/index.js"></script>
<script src="javascript/navbar.js"></script>
<script src="javascript/setCookieForPicDetail.js"></script>

</body>
</html>