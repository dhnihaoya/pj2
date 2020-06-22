<?php
require("../config.php");
require("../php/browser.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>浏览</title>
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" id="style" class="daytime" href="../css/daytime.css">
    <link rel="stylesheet" href="../css/browser.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="../javascript/browser.js"></script>


</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!--最左小标题 -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#" id="top">你好 世界</a>
        </div>
        <!--左侧两个小标题-->
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="browser.php"><span class="glyphicon glyphicon-plane"></span> 浏览</a></li>
                <li><a href="../index.php"><span class="glyphicon glyphicon-home"></span>  主页</a></li>
                <li><a href="search.php"><span class="glyphicon glyphicon-search">  搜索</span></a></li>
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

<div class="row" id="left">
<!-- 以下是左边的部分-->
<div class="col-md-3 col-sm-3">
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">搜索</h3>
    </div>
    <div class="panel-body">
        <input type="text" placeholder="请输入搜索内容" id="SearchInput" >
        <button type="button" class="btn btn-default" id="Search">搜索</button>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            热门国家
        </h3>
    </div>
    <div class="panel-body" id="hotCountry">
        <!--热门国家在这-->
        <?php
            getHotCountry();
        ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            热门城市
        </h3>
    </div>
    <div class="panel-body" id = "hotCity">
        <!--热门城市在这-->
        <?php
        getHotCity();
        ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
                内容
        </h3>
    </div>
        <div class="panel-body" id = "hotCity">
            <a href="#" class="list-group-item" onclick="selectByCategory(this.id)" id="Scenery">
                Scenery
            </a>
            <a href="#" class="list-group-item" onclick="selectByCategory(this.id)" id="City">
                City
            </a>
            <a href="#" class="list-group-item" onclick="selectByCategory(this.id)" id="People">
                People
            </a>
            <a href="#" class="list-group-item" onclick="selectByCategory(this.id)" id="Animal">
                Animal
            </a>
            <a href="#" class="list-group-item" onclick="selectByCategory(this.id)" id="Building">
                Building
            </a>
            <a href="#" class="list-group-item" onclick="selectByCategory(this.id)" id="Wonder">
                Wonder
            </a>
            <a href="#" class="list-group-item" onclick="selectByCategory(this.id)" id="Other">
                Other
            </a>
        </div>
    </div>

</div>
<!-- 以上是左边的部分-->
<!-- 以下是右边的部分-->
<div class="col-sm-9 col-md-9" ">
    <?php
    require("../php/dbconnect.php");
    ?>
    <div class="panel panel-info" id = "filter">
        <div class="panel-heading">
            <h3 class="panel-title">快速筛选</h3>
        </div>
        <div class="panel-body" id="selectGroup">
            <select id="picContent">
                <option>内容</option>
                <option>Scenery</option>
                <option>City</option>
                <option>People</option>
                <option>Animal</option>
                <option>Building</option>
                <option>Wonder</option>
                <option>Other</option>
            </select>
            <select name="country" id="currentcountry">
                <option value="0">--国家--</option>
                <?php
                for ($i = 0; $i < $countryNum; $i++) {
                    global $resultcountries;
                    echo '<option value="' . $resultcountries[$i][0] . '">' . $resultcountries[$i][4] . '</option>';
                    //添加国家
                }
                ?>
            </select>
            <select name="city" id="city">
                <option value="0">--城市--</option>
            </select>


            <button type="button" class="btn btn-success" id="goSearch">搜索</button>


        </div>
    </div>

    <div class="panel panel-default" id="picResultBar">
        <div class="panel-heading">
            <h3 class="panel-title">筛选结果</h3>
        </div>
        <div class="panel-body">
            <!-- 搜索结果输出-->
            <table id="demoPics" class="p1">

            </table>

            <!--令人讨厌的分页-->
            <ul class="pagination">

            </ul>

        </div>
    </div>

    <div>
    </div>


</div>
<!-- 以下是右边的部分-->





</div>




<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


</body>
</html>