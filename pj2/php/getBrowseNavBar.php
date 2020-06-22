<?php

//browser.php用
function withoutLogin(){
    return"
     <li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href='login.html'>
                        <span class=\"glyphicon glyphicon-user\"></span> 登陆<b class=\"caret\"></b>
                    </a>
                    <ul class=\"dropdown-menu\">
                        <li><a href='login.html'><span class=\"glyphicon glyphicon-user\"></span> 登陆</a></li>
                    </ul>
     </li>
    ";
}
function withLogin(){
    return "
          <li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                        <span class=\"glyphicon glyphicon-user\"></span>"
        ." ".$_COOKIE['Username']." 您好".
        "<b class=\"caret\"></b>
                    </a>
                    <ul class=\"dropdown-menu\">
                        <li><a href='upload.php'><span class=\"glyphicon glyphicon-open\"></span>  上传</a></li>
                        <li><a href='mypic.php'><span class=\"glyphicon glyphicon-picture\"></span>   我的照片</a></li>
                        <li><a href='myfavourite.php'><span class=\"glyphicon glyphicon-folder-open\"></span>   我的收藏</a></li>
                        <li><a href='../php/logout.php'><span class=\"glyphicon glyphicon-remove\"></span>   登出</a></li>
                    </ul>
          </li>
    ";
}
function getPersonalCenter()
{
    if (isset($_COOKIE["Username"])) {
        echo withLogin();
    } else {
        echo withoutLogin();
    }
}
?>
