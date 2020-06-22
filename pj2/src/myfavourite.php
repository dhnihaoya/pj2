<?php
    require("../config.php");
    require("../php/getFavPics.php");
    require ("../php/randomPic.php");

    $favPicNumber = count(getMyFavPicsID()) +1;
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的收藏</title>
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/foundation/5.5.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://static.runoob.com/assets/foundation-icons/foundation-icons.css">
    <link rel="stylesheet" id="style" class="daytime" href="../css/daytime.css">
    <link rel="stylesheet" href="../css/myFav.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="../javascript/myFav.js"></script>

</head>
<body>

<nav class="navbar navbar-inverse" role="navigation" id="topNav">
    <div class="container-fluid">
        <!--最左小标题 -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">旅游</a>
        </div>
        <!--左侧两个小标题-->
        <div>
            <ul class="nav navbar-nav">
                <li><a href="browser.php"><span class="glyphicon glyphicon-plane"></span> 浏览</a></li>
                <li class="active"><a href="../home.php"><span class="glyphicon glyphicon-home"></span>  主页</a></li>
            </ul>
            <!--右侧两个下拉列表-->
            <ul class="nav navbar-nav navbar-right">
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

<!-- 最外层div：页面布局 -->
<div class="off-canvas-wrap" data-offcanvas>
    <!-- 内部元素: "工具栏" 内容 (图标, 链接, 描述内容等)-->
    <div class="inner-wrap">
        <nav class="tab-bar">
            <section class="left-small">
                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>

            <section class="middle tab-bar-section">
                <h1 class="title">my Favourite</h1>
            </section>
        </nav>

        <!-- 滑动菜单 -->
        <aside class="left-off-canvas-menu">
            <!-- Add links or other stuff here -->
            <ul class="off-canvas-list test">
                <li><label><i class='fi-torso'></i>  个人中心</label></li>
                <li><a href='../src/upload.php'><i class='fi-upload'></i>  上传</a></li>
                <li><a href='../src/mypic.php'><i class='fi-photo'></i>  我的照片</a></li>
                <li><a href='../src/myfavourite.php'><i class='fi-heart'></i> 我的收藏</a></li>
                <li><a href='../php/logout.php'><i class='fi-x'></i>  登出</a></li>
            </ul>
        </aside>

        <!-- 主要内容 -->
        <section class="main-section">
            <h2 style="margin-left: 20px;margin-top: 10px"><i class="fi-folder"></i>   <?php echo " {$_COOKIE['Username']} 的收藏夹"; ?></h2>
            <hr>

            <div data-magellan-expedition="fixed" data-options="destination_threshold:100">
                <dl class="sub-nav">
                   <?php
                    outPutMagellanNav();
                   echo "
                    <dd data-magellan-arrival=\"page{$favPicNumber}\"><a href=\"#page{$favPicNumber}\">Random Pics</a></dd>
                     ";
                    ?>
                </dl>
            </div>
            <hr>
            <?php
            outPutFavContent();

            echo "<div data-magellan-destination=\"page{$favPicNumber}\">";
            ?>


            <!-- 此处是换页 -->
            <ul id="pageNumber" class="pagination">

            </ul>

            <h2>random pictures</h2>
                <ul class="clearing-thumbs" data-clearing>
                    <?php
                    $pic1 = new randomPic();
                    $pic2 = new randomPic();
                    $pic3 = new randomPic();
                    $pic1->setPicId($pic1->generateRandomID());
                    $pic2->setPicId($pic2->generateRandomID());
                    $pic3->setPicId($pic3->generateRandomID());
                    $pic1->anotherDemoPic();
                    $pic2->anotherDemoPic();
                    $pic3->anotherDemoPic();
                    ?>
                </ul>
            </div>
    <ul class="breadcrumb">
        <li><a href="#">一个随便的旅游网站</a></li>
        <li><a href="#">我的收藏</a></li>
        <li class="active"><?php echo date("Y-m-d");?></li>
        <li>
            <?php
            if(isset($_COOKIE['Username'])){
                echo"{$_COOKIE['Username']} 你好" ;
            }
            else{
                echo "<a href=\"login.html\" >请登录</a>";
            }
            ?>
        </li>
    </ul>
        </section>

        <!-- 关闭菜单 -->
        <a class="exit-off-canvas"></a>

    </div> <!-- 结束内部内容 -->
</div> <!-- 结束滑动菜单 -->

<!-- 初始化 Foundation JS -->
<script>
    $(document).ready(function() {
        $(document).foundation();
    })
</script>


<footer>
    <p> 19302010002 丁昊 湖人总冠军</p>
</footer>

<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../javascript/myFav.js"></script>
<script src="../javascript/navbar.js"></script>
<script>
    demoPicByPageNum(1);
</script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/foundation.min.js"></script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/vendor/modernizr.js"></script>
</body>
</html>
