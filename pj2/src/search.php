<?php

?>
<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>搜索</title>
    <script src="https://cdn.staticfile.org/vue/2.4.2/vue.min.js"></script>
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/search.css" type="text/css">
    <link rel="stylesheet" id="style" class="daytime" href="../css/daytime.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/foundation/5.5.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://static.runoob.com/assets/foundation-icons/foundation-icons.css">
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
                <!--右侧第一个（个人中心）-->
                <?php
                require('../php/getBrowseNavBar.php');
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

<div class="panel panel-default" id="bar1">
    <div class="panel-heading">
        <h3 class="panel-title">
            搜索
        </h3>
    </div>
    <div class="panel-body" id = "hotCity">
        <form name="filter" role="form" method="post">
        <ul class="accordion" data-accordion>
            <li class="accordion-navigation">
                <a href="#demo">通过标题搜索</a>
                <div id="demo" class="content active">
                   <input type="text" id="searchByTitle" ">
                </div>
            </li>
            <li class="accordion-navigation">
                <a href="#demo2">通过描述搜索</a>
                <div id="demo2" class="content">
                    <input type="text" id="searchByContent">
                </div>
            </li>
        </ul>
        </form>
    </div>
</div>

<div class="panel panel-default" id="bar2">
    <div class="panel-heading">
        <h3 class="panel-title">
            搜索
        </h3>
    </div>
    <div class="panel-body" id="resultBar">


    </div>

</div>











</body>







<script>
    $(document).ready(function() {
        $(document).foundation();
    })
</script>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/foundation.min.js"></script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/vendor/modernizr.js"></script>
<script src="../javascript/search.js"></script>
</html>
