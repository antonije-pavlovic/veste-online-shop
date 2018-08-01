<?php
$user=$_SESSION['korisnik']->id;
$upit="select * from porudzbine where korisnik_id=:user";
$priprema=$konekcija->prepare($upit);
$priprema->bindParam(":user",$user);
try{
    $rezultat=$priprema->execute();
    if($rezultat){
        $komadi=$priprema->fetchAll();
    }
}catch(PDOEXception $e){
    echo $e->getMessage();
}