<?php
class randomPic
//一定要先传入一个picId再调用！
{
    //这里的picID就是数据库的imageID
    private $picId;

//从前端传入picID
    function setPicId($id){
        $this->picId = $id;
    }
//得到总图片数字
    function getTotalPicNumbers(){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sqlSearchPicNumber = "SELECT * FROM travelimage";
        return $pdo->query($sqlSearchPicNumber)->rowCount();
    }


//通过传入的id生成sql语句
    function generateSQL(){
        $id = $this->picId;
        return "select * from travelimage where ImageID ='{$id}'";
    }

//返回一个数组 几位分别是图片标题（Title）图片介绍（Description）作者（UID）
//图片路径（PATH）经度（Longitude）纬度（Latitude）,$result['Longitude'],$result['Latitude']
    function getPicInformation(){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare($this->generateSQL());
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $picInformation = array( $result["Title"] , $result["Description"], $result["UID"], $result["PATH"]);
       // print_r($picInformation);
        $pdo = null;
        return $picInformation;
    }


    function getPicPath(){
        $this->getPicInformation();
        $path = "travel-images/medium/".$this->getPicInformation()[3];
        return $path;
    }

    //用vue框架显示图片 用于home.php
    function demoPic(){
        if($this->getPicInformation()[1] === null  ){
            $description = "This picture has no description";
        }
        else{
            $description = $this->getPicInformation()[1];
        }
        echo "<script type='text/javascript'>
                    var vm = new Vue({
                        el: '#vue_{$this->picId}',
                        data: {
                            Title: \"{$this->getPicInformation()[0]}\",
                            Description: \"{$description}\"
                        },
                    })
               </script>";
    }

    //用foundation框架生成picDetail页面随机图片欣赏的一个<li>
    function anotherDemoPic(){
        //换成medium文件夹里的
        $prePicPath = "../".$this->getPicPath();
        $picPath = str_replace("square-medium","medium",$prePicPath);
       // str_replace("world", "Kitty", "Hello world!"）
        echo "
        <li><a href=\"{$picPath}\"><img src=\"{$picPath}\" width=\"200\" height=\"150\"></a></li>
        ";
    }


//传入的应该是一个分数
    function generateRandomID(){
        //看传入几个参数 （避免home中重复图片）
        $n = func_get_args();

        $arrOfExistId = array();
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM travelimage";
        $res=$pdo->prepare($sql);//准备查询语句
        $res->execute();            //执行查询语句
        $i = 0;
        while ($result=$res->fetch(PDO::FETCH_ASSOC)){
            $arrOfExistId[$i] = $result['ImageID'];
            $i++;
        }

        if(count($n) === 0){
            $randIndex = rand($arrOfExistId[0], count($arrOfExistId) - 1);
            return $arrOfExistId[$randIndex];
        }
        else if(count($n) === 1){
            $preEndIndex = count($arrOfExistId) - 1;
            $endIndex = round($preEndIndex*$n[0]-1);
            $randIndex = rand($arrOfExistId[0], $endIndex);
            return $arrOfExistId[$randIndex];
        }
        else{
            $beginIndex = round((count($arrOfExistId)-1)*$n[0]+1);
            $endIndex = round((count($arrOfExistId)-1)*$n[1]-1);
            $randIndex = rand($beginIndex, $endIndex);
            return $arrOfExistId[$randIndex];
        }
    }




}
?>