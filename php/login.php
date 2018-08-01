<?php
session_start();
include "konekcija.php";
    if(isset($_POST['login'])){
        $name=$_POST['username'];
        $pass=md5($_POST['password']);
       
        $query="select k.*,u.id as ulogaID from korisnik k inner join uloga u on k.uloga_id=u.id
        where korisnicko_ime=:name and password=:pass and aktivan=1";
        $statement=$konekcija->prepare($query);
        $statement->bindParam(":name",$name);
        $statement->bindParam(":pass",$pass);
        try{
            $statement->execute();            
            if($statement->rowCount() == 1){
                $user=$statement->fetch();
                $_SESSION['korisnik']=$user;                
                header("Location: https://veste-onlineshop.000webhostapp.com/index.php?id=1");
            }else{ 
                header("Location: https://veste-onlineshop.000webhostapp.com/index.php?id=1");
            }
        }catch(PDOException $e){
           echo $e->getMessage();                
            }
     }
    