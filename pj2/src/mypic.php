<?php
    require("../config.php");
    require("../php/getMyPic.php");
    require("../php/randomPic.php");
    $myPicNumber = count(getMyPicsID()) +1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的照片</title>
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/foundation/5.5.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://static.runoob.com/assets/foundation-icons/foundation-icons.css">
    <link rel="stylesheet" href="../css/myPic.css">
    <link rel="stylesheet" id="style" class="daytime" href="../css/daytime.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="../javascript/myPic.js"></script>
</head>
<body>



<div class="off-canvas-wrap" data-offcanvas>
    <!-- 内部元素: "工具栏" 内容 (图标, 链接, 描述内容等)-->
    <div class="inner-wrap">
        <nav class="tab-bar">
            <section class="left-small" id="second">
                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>

            <section class="middle tab-bar-section">
                <h1 class="title" >我的照片</h1>
            </section>
        </nav>

        <!-- 滑动菜单 -->
        <aside class="left-off-canvas-menu">
            <!-- Add links or other stuff here -->
            <ul class="off-canvas-list test">
                <li><a href="browser.php"><i class="fi-foot"></i>  浏览</a></li>
                <li><a href="search.php"><i class="fi-magnifying-glass"></i>  搜索</a></li>
                <li><label><i class='fi-torso'></i>  个人中心</label></li>
                <li><a href='../index.php'><i class='fi-home'></i>  主页</a></li>
                <li><a href='../src/upload.php'><i class='fi-upload'></i>  上传</a></li>
                <li><a href='../src/mypic.php'><i class='fi-photo'></i>  我的照片</a></li>
                <li><a href='../src/myfavourite.php'><i class='fi-heart'></i> 我的收藏</a></li>
                <li><a href='../php/logout.php'><i class='fi-x'></i>  登出</a></li>
                <li id="daytime"><a>日间模式</a></li>
                <li id="nighttime"><a>夜间模式</a></li>
            </ul>
        </aside>

        <!-- 主要内容 -->
        <section class="main-section">
            <h2 style="margin-left: 20px;margin-top: 10px" id="second"> <?php echo "{$_COOKIE['Username']} 的照片"?></h2>
            <hr>

            <div data-magellan-expedition="fixed" id="first">
                <dl class="sub-nav">
                    <?php
                    outPutMyMagellanNav();
                    echo "
                    <dd data-magellan-arrival=\"page{$myPicNumber}\"><a href=\"#page{$myPicNumber}\">Random Pics</a></dd>
                     ";
                    ?>
                </dl>
            </div>
            <hr>


            <?php
            outPutMyContent();
            ?>

            <ul class="pagination" id="pageNumber">

            </ul>


            <?php
            echo "<div data-magellan-destination=\"page{$myPicNumber}\">";
            ?>

            <ul class="pagination" id="pageNumber">
                <script>
                    demoPicByPageNum();
                </script>
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


            <ol class="joyride-list" data-joyride>
                <li data-id="first">
                    <p>这里是你的照片中心</p>
                    <p>你可以在这里看你上传的照片</p>
                </li>
                <li data-id="second">
                    <h4>这里是你的个人中心</h4>
                    <p>为了用foundation得到bonus</p>
                    <p>个人中心被移动到了这里</p>
                </li>
                <li data-button="End">
                    <h4>感谢你的上传</h4>
                    <p>继续分享你的照片吧</p>
                </li>
            </ol>
    </div>
    <ul class="inline-list">
        <li><a href="#">世界 你好</a></li>
        <li><a href="../home.php" data-tooltip class="has-tip tip-top" title="回首页">首页</a></li>
        <li><a href="#top" data-tooltip class="has-tip tip-top" title="回顶部">我的照片</a></li>
        <li class="active"><?php echo date("Y-m-d");?></li>
        <li>
            <?php
            if(isset($_COOKIE['Username'])){
                echo"{$_COOKIE['Username']} 你好" ;
            }
            else{
                echo "<a href=\"login.html\" data-tooltip class=\"has-tip tip-top\" title=\"去登陆！\" >请登录</a>";
            }
            ?>
        </li>
    </ul>



        </section>

        <!-- 关闭菜单 -->
        <a class="exit-off-canvas"></a>

    </div> <!-- 结束内部内容 -->
</div> <!-- 结束滑动菜单 -->




<footer>
    <p>Hello World!</p>>
    <p> 19302010002 丁昊 湖人总冠军</p>
</footer>
<script>
    $(document).ready(function() {
        $(document).foundation();
        $(document).foundation('joyride', 'start');
    })
</script>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/foundation.min.js"></script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/vendor/modernizr.js"></script>
</body>
</html>