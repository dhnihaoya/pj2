<?php

// header('Content-type:text/html; charset=utf-8');

// session_start();

//  $_SESSION["loggedIn"] = false;
require_once("../config.php");
//id password （post
//UserName Pass
function validLogin(){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    //very simple (and insecure) check of valid credentials.
    $sql = "SELECT * FROM traveluser WHERE UserName=:user";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user',$_POST['id']);
    $statement->execute();
    if ($statement->rowCount()<0)
        return false;
    else{
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $salt = $result['salt'];
        //考虑数据库里前面的用户
        if($salt == ""){
            return ($_POST['password'] == $result['Pass']);
        }
        else{
            $prePass = $_POST['password'].$salt;
            return (sha1($prePass) == $result['Pass']);
        }
    }
   /* $result = $statement->fetch(PDO::FETCH_ASSOC);
    $pdo = null;
    if($statement->rowCount()>0){
        $expiryTime = time()+60*60*24;
        setcookie("userId" , $result['UID'] , $expiryTime ,'/pj2/');
        return true;
    }*/
 //   return false;
}

if(validLogin()){
    $expiryTime = time()+60*60*24;
    setcookie("Username", $_POST['id'], $expiryTime,'/pj2/');
    if(isset($_COOKIE['Username'])) {
        $url = "../index.php";
        Header("Location: ".$url);
    }
}
else
{
    echo "<script>alert('用户名或密码错误')</script>";
    Header("Refresh:1;url=../src/login.html");

}
?>
