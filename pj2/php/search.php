<?php
    require_once('../config.php');
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $searchContent = "%".$_POST['content']."%";
    if ($_POST['type'] === 'Title' ){
        $sql = "SELECT * FROM travelimage WHERE Title LIKE :title";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':title',$searchContent);
    }
    if($_POST['type'] === 'Content'){
        $sql = "SELECT * FROM travelimage WHERE Title LIKE :content";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':content',$searchContent);
    }
    $statement->execute();
    $pdo = null;
    $arrOfPicID = array();
    $arrOfPicSrc = array();
    $arrOfPicTitle = array();
    $arrOfPicDescription  = array();
    $output = "";
    $i = 0;
    while ($result = $statement->fetch(PDO::FETCH_ASSOC)){
        $arrOfPicID[$i] = $result['ImageID'];
        $arrOfPicSrc[$i] = "../travel-images/medium/".$result['PATH'];
        $arrOfPicDescription[$i] = $result['Description'];
        $arrOfPicTitle[$i]  = $result['Title'];

        $output .= "
            <div class='Bar{$i}' id='$arrOfPicID[$i]' onclick='jump(this.id)'>
                <h2>$arrOfPicTitle[$i]</h2>
                    <div class=\"panel\">
                        <img src=\"{$arrOfPicSrc[$i]}\" > 
                        <div class=\"container\">
                            <h3>{$arrOfPicTitle[$i]}</h3>
                            <p>{$arrOfPicTitle[$i]}</p>
                        </div>
                    </div>
            </div>
        
        
        ";

        $i++;
    }

    echo $output;



?>