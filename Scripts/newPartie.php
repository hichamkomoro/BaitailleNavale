<?php

include("./connexion.php");
if(isset($_GET["Matcheid"])){
    $conn->query("update matches set user".$_GET['Qui']."_score=".$_GET['Score'].",user".$_GET['Qui']."_LastShut=".$_GET['LastShut']."  where MD5(CONCAT('M',id))='".$_GET['Matcheid']."'");
    if($_GET['Qui']=="1"){
        $Ennemi=2;
    }else{
        $Ennemi=1;
    }
    $rslt = $conn->query("select user".$Ennemi."_LastShut,user".$Ennemi."_score from matches where MD5(CONCAT('M',id))='".$_GET['Matcheid']."'");
    $row = $rslt -> fetch_assoc();
    if($row["user".$Ennemi."_LastShut"]==null){
        echo "null".'---'.$row["user".$Ennemi."_score"];
    }else{
        echo $row["user".$Ennemi."_LastShut"].'---'.$row["user".$Ennemi."_score"];
    }
    exit();
}else if(isset($_GET["annuleMatch"])){
    $rslt = $conn->query("delete from matches where MD5(CONCAT('M',id))='".$_GET['annuleMatch']."'");
    header("Location: ../index.php");
    exit();
}else if(isset($_GET['CheckPartieid'])){
    $rslt = $conn->query("select user2_B2 from matches where MD5(CONCAT('M',id))='".$_GET["CheckPartieid"]."'");
	$row = $rslt->fetch_assoc();
	if($row['user2_B2']==null){
        echo "null";
    }else{
        echo "true";
    }
    exit();
}else if(isset($_POST['etape2Id'])){
    $conn->query("update matches set user2_B2 = ".$_POST["B2"]." , user2_B3 = ".$_POST["B3"]." , user2_B4 = ".$_POST["B4"]." , user2_B5 = ".$_POST["B5"]." where MD5(CONCAT('M',id))='".$_POST['etape2Id']."'");
    header("Location: ../loading.php?p=".md5("Je2")."&id=".$_POST['etape2Id']);
}else{
    $conn->query("insert into matches values(null,'".$_POST["J1"]."',".$_POST["B2"].",".$_POST["B3"].",".$_POST["B4"].",".$_POST["B5"].",null,0,'".$_POST["J2"]."',null,null,null,null,null,0)");

    $ID = ($conn->query("select LAST_INSERT_ID() as id;")->fetch_assoc())["id"];

    header("Location: ../index.php?id=".MD5('M'.$ID));
}

/*
    echo $_POST["J1"]."<br>";
    echo $_POST["J2"]."<br>";
    echo $_POST["B2"]."<br>";
    echo $_POST["B3"]."<br>";
    echo $_POST["B4"]."<br>";
    echo $_POST["B5"];
*/

?>