<?php
require ("../php/upload.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传照片</title>
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/foundation/5.5.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://static.runoob.com/assets/foundation-icons/foundation-icons.css">
    <link rel="stylesheet" href="../css/upload.css">
    <link rel="stylesheet" id="style" class="daytime" href="../css/daytime.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>

</head>
<body>

<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
        <nav class="tab-bar">
            <section class="left-small">
                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>

            <section class="middle tab-bar-section">
                <h1 class="title">上传</h1>
            </section>
        </nav>

        <aside class="left-off-canvas-menu">
            <ul class="off-canvas-list test">
                <li><a href="browser.php"><i class="fi-foot"></i>  浏览</a></li>
                <li><a href="search.php"><i class="fi-magnifying-glass"></i>  搜索</a></li>
                <li><label><i class='fi-torso'></i>  个人中心</label></li>
                <li><a href='../index.php'><i class='fi-home'></i>  主页</a></li>
                <li><a href='../src/upload.php'><i class='fi-upload'></i>  上传</a></li>
                <li><a href='../src/mypic.php'><i class='fi-photo'></i>  我的照片</a></li>
                <li><a href='../src/myfavourite.php'><i class='fi-heart'></i> 我的收藏</a></li>
                <li><a href='../php/logout.php'><i class='fi-x'></i>  登出</a></li>
            </ul>
        </aside>

        <section class="main-section">
            <div id="preview" style="width:320px;height:240px;"></div><!--用来放预览图片的DIV-->
            <div id="insertPic"></div>
                <fieldset>
                    <form action="../php/uploadPic.php" method="POST" enctype="multipart/form-data" role="form" >
                    <legend><i class="fi-upload"></i>  上传</legend>
                    <label>
                        <input type="file" onchange="previewImage(this,320,240)" accept="image/*" name="pic" id="pic" required />
                    </label>

                    <label>图片标题
                        <input type="text" placeholder="图片标题" required name="Title" id="Title">
                    </label>
                    <label>图片描述
                        <input type="text" placeholder="图片描述" name="Description" id="Description">
                    </label>
                    <label>拍摄国家
                        <select id = 'selectCountry' name = 'country'>
                            <?php
                           require ("../config.php");
                            getCountrySelections();
                            ?>
                        </select>
                    </label>
                    <label>拍摄城市
                        <select id="selectCity" name = 'city'>
                            <option>选择城市</option>
                            <?php
                            getCitySelections();
                            ?>
                        </select>
                    </label>
                     <label>图片内容
                            <select name = 'category' required>
                                <option id="Scenery">Scenery</option>
                                <option id="Animal">Animal</option>
                                <option id="City">City</option>
                                <option id="Building">Building</option>
                                <option id="People">People</option>
                                <option id="Wonder">Wonder</option>
                                <option id="Other">Other</option>
                            </select>
                     </label>
                    <input type="submit" value="上传" class="login" id="button">
                    </form>
                </fieldset>
        </section>

        <a class="exit-off-canvas"></a>

    </div>
</div>






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
<script src="../javascript/myPic.js"></script>
<script src="../javascript/upload.js"></script>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/foundation.min.js"></script>
<script src="https://cdn.staticfile.org/foundation/5.5.3/js/vendor/modernizr.js"></script>
</body>
</html>
