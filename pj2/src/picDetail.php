<?php
    require_once("../config.php");
    require ("../php/getPicDetail.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>图片详情</title>
    <script src="https://cdn.staticfile.org/vue/2.4.2/vue.min.js"></script>
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/foundation/5.5.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://static.runoob.com/assets/foundation-icons/foundation-icons.css">
    <link rel="stylesheet" href="../css/picDetail.css" type="text/css">
    <link rel="stylesheet" id="style" class="daytime" href="../css/daytime.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
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
                <li><a href="../index.php"><span class="glyphicon glyphicon-home"></span>  主页</a></li>
                <li><a href="search.php"><span class="glyphicon glyphicon-search"></span>  搜索</a></li>
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

<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
        <nav class="tab-bar">
            <section class="left-small">
                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>

            <section class="middle tab-bar-section">
                <h1 class="title">图片细节</h1>
            </section>
        </nav>

        <aside class="left-off-canvas-menu">
            <ul class="off-canvas-list test">
                <?php
                getFoundationPersonalCenter();
                ?>
            </ul>
        </aside>
        <section class="main-section">
            <h3 id="first"></h3><br>
            <ol class="joyride-list" data-joyride>
                <li data-id="first">
                    <p>这里是个人中心</p>
                </li>
                <li data-button="End">
                    <h4>愉快的看图吧</h4>
                </li>
            </ol>


        </section>
        <a class="exit-off-canvas"></a>



        <div class="panel panel-default">
            <div class="panel-heading">
                <?php
                getPicTitle();
                ?>
            </div>
            <div class="panel-body">
                <div id="left">
                    <div>
                        <?php
                        getPic();
                        ?>
                    </div>
                    <div>
                        <?php
                        getDescription();
                        getUserName();
                        ?>
                    </div>
                </div>

                <div class="panel panel-default" style="float: right" id = "right1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            被收藏数
                        </h3>
                    </div>
                    <div class="panel-body" id="favNum">
                        <?php
                        getFavoredNumberOfPic();
                        ?>
                    </div>
                </div>

                <div class="panel panel-default" style="float: right" id = "right1">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            图片细节
                        </h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $arr = getPicCountryAndCity();
                        $cat = getPicCategory();
                        echo "<p><b>国家:</b>  {$arr[0]}</p>";
                        echo "<p><b>城市:</b>  {$arr[1]}</p>";
                        echo "<p><b>类型:</b>  {$cat}</p>";
                        ?>
                    </div>
       -         </div>

                <div class="clear"></div>
                <div class="icon-bar four-up">
                    <a href="../home.php" class="item">
                        <i class="fi-home"></i>
                        <label>回主页</label>
                    </a>
                    <?php
                        outPutFavBar();
                        ?>
                    <a href="#" class="item">
                        <i class="fi-torso"></i>
                        <label>我的照片</label>
                    </a>
                    <a href="#" class="item">
                        <i class="fi-upload"></i>
                        <label>上传我的！</label>
                    </a>
                </div>

            </div>
        </div>








        <ul class="breadcrumb">
            <li>随机图片欣赏</li>
        </ul>
        <ul class="clearing-thumbs" data-clearing>
            <?php
            require ("../php/randomPic.php");
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
        <ul class="breadcrumb" style="margin-bottom: 50px">
            <li><a href="#">一个随便的旅游网站</a></li>
            <li><a href="../home.php">首页</a></li>
            <li><a href="#">图片详情</a></li>
            <li class="active"><?php echo date("Y-m-d");?></li>
            <li>
                <?php
                if(isset($_COOKIE['Username'])){
                    echo"{$_COOKIE['Username']} 你好" ;
                }
                ?>
            </li>
        </ul>


    </div>
</div>

<!-- 初始化 Foundation JS -->
<script>
    $(document).ready(function() {
        $(document).foundation();
        $(document).foundation('joyride', 'start');
    })
</script>
<footer>
    <p>湖人总冠军</p>
</footer>


<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../javascript/navbar.js"></script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/foundation.min.js"></script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/vendor/modernizr.js"></script>
<script src="../javascript/picdetailDemo.js"></script>

</body>


</html>
