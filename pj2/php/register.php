<?php

require("../config.php");
//检查用户ID密码否重复 数据库里有重复则返回true
function registerExist(){
    $pdo = $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "SELECT * FROM traveluser WHERE UserName=:user";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user',$_POST['id']);
    $statement->execute();
    if($statement->rowCount()>0){
        return true;
    }
    return false;
}


function createNewAccount(){
    $pdo  = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!$pdo) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $newUserId = $_POST['id'];
    $newUserPassword = $_POST['password'];
    $registerTime = date("Y-m-d");
    $sqlSearchNumber = "SELECT * FROM traveluser";

    //哈希加盐
    $salt = base64_encode(getRandomStr(32,false));
    $password=sha1($newUserPassword.$salt);





    try {
        $newUserNumber = $pdo->query($sqlSearchNumber)->rowCount() + 1;
        $sqlInsert =
            "INSERT INTO traveluser (UID, UserName, Pass, State, DateJoined, DateLastModified,salt) 
VALUES ('{$newUserNumber}','{$newUserId}','{$password}',1,'{$registerTime}','{$registerTime}','{$salt}')";
        $pdo->exec($sqlInsert);
        echo "<script>alert('注册成功，快去登陆吧')</script>";
        Header("Refresh:1;url=../src/login.html");
    }
    catch(PDOException $e)
    {
        echo $sqlInsert . "<br>" . $e->getMessage();
    }

}

function validRegister(){
    if(!registerExist()){
        createNewAccount();
    }
    else {
        echo "<script>alert('抱歉，此用户名已经被占用')</script>";
        Header("Refresh:1;url=../src/register.html");
    }
}



function getRandomStr($len, $special=true){
    $chars = array(
                 "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
         "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
         "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
         "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
         "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
         "3", "4", "5", "6", "7", "8", "9"
     );

     if($special){
                $chars = array_merge($chars, array(
                         "!", "@", "#", "$", "?", "|", "{", "/", ":", ";",
             "%", "^", "&", "*", "(", ")", "-", "_", "[", "]",
             "}", "<", ">", "~", "+", "=", ",", "."
         ));
     }

     $charsLen = count($chars) - 1;
     shuffle($chars);                            //打乱数组顺序
     $str = '';
     for($i=0; $i<$len; $i++){
                 $str .= $chars[mt_rand(0, $charsLen)];    //随机取出一位
     }
     return $str;
 }








validRegister();


?>
