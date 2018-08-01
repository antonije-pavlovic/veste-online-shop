<?php
    if(isset($_GET['type']))
    $tip=$_GET['type'];
    $upit="select * from proizvod where tip=:tip";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":tip",$tip);
    try{
        $rezultat=$priprema->execute();
        
    }catch(PDOExcepion $e){
        echo $e->getMessage();
    }
    //za paginaciju
    $brojPoStrani=2;
    $brojStrana=ceil($priprema->rowCount()/$brojPoStrani);
    
    if (!isset($_GET['page'])){
        $page = 1;
    } 
    else{
        $page = $_GET['page'];
    }

    $odKogKrece= ($page-1)*$brojPoStrani;
        
    $upit='select * from proizvod where tip="'.$tip.'" limit '.$odKogKrece.','.$brojPoStrani.' ';
    $proizvodi=$konekcija->query($upit)->fetchAll();
?>