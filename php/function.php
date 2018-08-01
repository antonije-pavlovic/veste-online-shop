<?php
include "konekcija.php";

//OBRADA LINKOVA
function getPage($id){
    global $konekcija;
    $upit="select * from meni where id=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            $data=$priprema->fetch();
            $page=$data->putanja;
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    return $page;
}
//DOHVATANJE POSLEDNJIH ARTIKALA
function poslenjiArtikli(){
    global $konekcija;
    $upit="select * from proizvod order by id DESC limit 0,5";
    $artikli=$konekcija->query($upit)->fetchAll();
    return $artikli;
}

//DOHVATANJE PITANJA
function dohvatiPitanja(){
    global $konekcija;    
    $rezultat=$konekcija->query("select * from pitanje")->fetchAll();
    return $rezultat;
}
//DOHVATANJE ODGOVORA   
function dohvatiOdgovore($idPitanja){
    global $konekcija;  
    $upit="select * from odgovor where pitanje_id=:pitanje";  
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":pitanje",$idPitanja);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            $odgovori=$priprema->fetchAll();
            return $odgovori;
        }else{
            return "Sorry, there was a mistake";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
}
//RACUNANJE STATISTIKE
function statistika($idPitanja,$idOdgovora){
    global $konekcija;
    $upit="SELECT count(*) as broj FROM konacan_odgovor WHERE odgovor_id=:idOdgovor and pitanje_id=:idPitanje";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":idOdgovor",$idOdgovora);
    $priprema->bindParam(":idPitanje",$idPitanja);
    try{
        $rezultat=$priprema->execute();        
        if($rezultat){
            return $priprema->fetch();
        }else{
            return "Sorry, there was a mistake";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    } 
}
//PROVERA DA LI JE KORISNIK VEC ODGOVORIO NA PITANJE
function proveraPitanja($idKorisnika,$idPitanja){
    global $konekcija;
    $upit="select * from konacan_odgovor where pitanje_id=:pitanje and korisnik_id=:korisnik ";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":pitanje",$idPitanja);
    $priprema->bindParam(":korisnik",$idKorisnika);
    try{
        $rezultat=$priprema->execute();
        $provera=$priprema->fetchAll();
        if(count($provera) >= 1){
            return true;
        }else{
            return false;
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }    
}
