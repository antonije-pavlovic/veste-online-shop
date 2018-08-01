<?php
include "konekcija.php";
//FILTERI
if(isset($_POST['cena'])){
    $min=$_POST['min'];
    $max=$_POST['max'];
    $tip=$_POST['tip'];

    $upit="select * from proizvod where tip=:tip and cena between :min and :max";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":tip",$tip);
    $priprema->bindParam(":min",$min);
    $priprema->bindParam(":max",$max);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            $data=$priprema->fetchAll();
            echo json_encode($data);
           
        }else{
            echo "upit nije ok";
        }
    }catch(PDOException $e){
        echo $e->getMesaage();
    }
}
//PRETRAGA
if(isset($_POST['pretraga'])){
    $tekst=$_POST['tekst'];
    $tip=$_POST['tip'];
    
    $upit="select * from proizvod where ime LIKE '%$tekst%' and tip='$tip' ";
    $rezultat=$konekcija->query($upit)->fetchAll();
    echo json_encode($rezultat);
    // $priprema=$konekcija->prepare($upit);
    // $priprema->bindParam(":tekst",$tekst);
    // try{
    //     $rezultat=$priprema->execute();
    //     if($rezultat){
    //         $data=$priprema->fetchAll();
    //         echo json_encode($data);
    //     }else{
    //         echo "upit zeza";
    //     }
    // }catch(PDOException $e){
    //     echo $e->getMessage();
    //}
}
//DODAVANJE PROIZVODA U KORPU / tabela porudzbine
if(isset($_POST['card'])){
    $proizvodID=$_POST['proizvodID'];
    $korisnikID=$_POST['userID'];

    $upit="insert into porudzbine values('',:korisnik_id,:proizvod_id)";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":korisnik_id",$korisnikID);
    $priprema->bindParam(":proizvod_id",$proizvodID);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            echo "You have successfully added the product to the cart";
        }else{
            echo "We apologize for a mistake, please try again later or contact us via mail";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

//BRISANJE PORUDZBINE
if(isset($_POST['brisi'])){
    $idPorudzbine=$_POST['idPorudzbine'];
    $upit="delete from porudzbine where id=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$idPorudzbine);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            echo "uspesno je obrisan prozivod";           
        }else{
            echo "greska";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
//KONACNA KUPOVINA-nece da radi kada se klikne na buyu korpi
if(isset($_POST['kupi'])){  
    $korID=$_POST['korID'];
    $proID=$_POST['proID'];
    $cena=$_POST['Cena'];    
    $datum=date("M-d-Y H:i:s",time());
    $porudzbina=$_POST['porudzbina'];
    
    $upit="insert into kupljeno values('',:kupac_id,:proizvod_id,:cena,:datum)";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":kupac_id",$korID);
    $priprema->bindParam(":proizvod_id",$proID);
    $priprema->bindParam(":cena",$cena);
    $priprema->bindParam(":datum",$datum);
    
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            $brisanje="delete from porudzbine where id=:id";
            $pripremaBrisanje=$konekcija->prepare($brisanje);
            $pripremaBrisanje->bindParam(":id",$porudzbina);
            try{
                $brisanjeRezultat=$pripremaBrisanje->execute();
                if($brisanjeRezultat){
                    echo "Congratulations! You have successfully purchased the product";
                }else{
                    echo "We apologize for a mistake, please try again later or contact us via mail";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }else{
           echo "We apologize for a mistake, please try again later or contact us via mail";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }

}
//MORE ABOUT PRODUCT
if(isset($_POST['more'])){
    $id=$_POST['idProizvoda'];
    $upit="select * from proizvod where id=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            $data=$priprema->fetch();
            echo json_encode($data);
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
//ANKETA-DOHVATANJE ODGOVORA
if(isset($_POST['pitanjeLista'])){
    $id=$_POST['idPitanja'];
    $upit="select * from odgovor where pitanje_id=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            $data=$priprema->fetchAll();
            echo json_encode($data);
        }else{
            echo "nije ok";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
//UPISIVANJE ODGOVORA U BAZU
if(isset($_POST['konacan'])){
    $idUser=$_POST['idUser'];
    $idOdgovora=$_POST['idOdgovora'];
    $idPitanja=$_POST['idPitanja'];
    $upit="insert into konacan_odgovor values('',:odgovor,:korisnik,:pitanje)";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":odgovor",$idOdgovora);
    $priprema->bindParam(":korisnik",$idUser);
    $priprema->bindParam(":pitanje",$idPitanja);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            echo "Your answer has been successfully filled in, thank you.";
        }else{
            echo "An error has occurred";
        }
    }catch(PDOEXception $e){
        echo $e->getMessage();
    }
}
/*********************ADMIN AJAX*******************/
//UNOS NOVOG KORISNIKA
if(isset($_POST['unos'])){
    $ime=$_POST['ime'];
    $korisnicko_ime=$_POST['korisnicko_ime'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $aktivan=$_POST['aktivan'];
    $date=date("Y-m-d H:m:s",time());
    $token = md5(time() . $date);
    $uloga=$_POST['uloga'];

    //provera regularnim izrazima
    $regName="/^[A-Z][a-z]{2,12}$/";        
    $regUsername="/^\w{4,20}$/";
    $regEmail="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $regPass="/^[A-z0-9]{5,20}\W?[A-z0-9]{0,20}$/";
    
    $errors=[];
    if(!preg_match($regName, $ime))
      array_push($errors,"your name is not valid");

    if(!preg_match($regUsername, $korisnicko_ime))
      array_push($errors,"your name is not valid");

    if(!preg_match($regEmail, $email))
      array_push($errors,"your name is not valid");

    if(!preg_match($regPass, $password))
      array_push($errors,"your name is not valid");   
    if($uloga == '0') 
       array_push($errors,"choose a role for user"); 
       
    $sifra=md5($password);
    $upit="insert into korisnik values('',:ime,:username,:email,:password,:aktivan,:token,:uloga)";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":ime",$ime);
    $priprema->bindParam(":username",$korisnicko_ime);
    $priprema->bindParam(":email",$email);
    $priprema->bindParam(":password",$sifra);
    $priprema->bindParam(":aktivan",$aktivan);
    $priprema->bindParam(":token",$token);
    $priprema->bindParam(":uloga",$uloga);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            echo "You have successfully entered the user";
           
        }else{
            echo "doslo je do greske";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

//BRISANJE KORISNIKA
if(isset($_POST['brisanjeKorisnika'])){
   $id=$_POST['id'];
   $upit="delete from korisnik where id=:id";
   $priprema=$konekcija->prepare($upit);
   $priprema->bindParam(':id',$id);
   try{
        $rezultat=$priprema->execute();
        if($rezultat){
            echo "The user has been successfully deleted";
        }else{
            echo "upit nije ok";
        }
   } catch(PDOException $e){
        echo $e->getMessage();
   }
}

//UPDATE KORISNIKA
if(isset($_POST['updateUser'])){
    $id=$_POST['id'];
    $upit="select * from korisnik where id=:id";
    $upitUloge="select * from uloga";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $rezultat = $priprema->execute();
        $rezultatUloge=$konekcija->query($upitUloge)->fetchAll();
        if($rezultat){
            $data=json_encode($priprema->fetch());
            if($rezultatUloge){
                $niz=[$data,$rezultatUloge];
                echo json_encode($niz);
            }
        }else{
            echo "upit nije ok";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
//UPIS UNETIH IZMENA ZA KORISNIKA
if(isset($_POST['izmene'])){
    $id=$_POST['id'];
    $ime=$_POST['ime'];
    $username=$_POST['korisnickoIme'];
    $email=$_POST['email'];
    $aktivan=$_POST['aktivan'];
    $uloga=$_POST['uloga'];

    //provera regularnim izrazima
    $upit="update korisnik set ime=:ime, korisnicko_ime=:username, email=:email, aktivan=:aktivan, uloga_id=:uloga where id=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":ime",$ime);
    $priprema->bindParam(":username",$username);
    $priprema->bindParam(":email",$email);
    $priprema->bindParam(":aktivan",$aktivan);
    $priprema->bindParam(":uloga",$uloga);
    $priprema->bindParam(":id",$id);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            echo "You have successfully made changes";
        }else{
            echo "upit nije ok";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
//BRISANJE PROIZVODA
if(isset($_POST['brisanje'])){
    $id=$_POST['id'];

    $upit="delete from proizvod where id=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            echo "You have successfully deleted the product";
        }else{
            echo "upit nije ok";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
//DOHVATANJE PROIZVODA ZA UPDATE
if(isset($_POST['proizvod'])){
    $id=$_POST['id'];
    $upit="select * from proizvod where id=:id";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":id",$id);
    try{
        $rezultat=$priprema->execute();
        if($rezultat){
            $data=$priprema->fetch();
            echo json_encode($data);
        }else{
            echo "upit nije ok";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}


