<?php
    include "konekcija.php";

    if(isset($_GET['token'])){
        $token=$_GET['token'];

        $query="select * from korisnik where token=:token";

        $statement = $konekcija->prepare($query);
        $statement->bindParam(":token",$token);
        try{
            $result=$statement->execute();
            if($result){
                $user=$statement->fetch();
                if(empty($user)){
                    echo "You are not registered!";
                }else{
                    $updateQuery="update korisnik set aktivan=1 where token=:token";
                    $updateStatement=$konekcija->prepare($updateQuery);
                    $updateStatement->bindParam(":token",$token);
                    $resultUpdate=$updateStatement->execute();
                    if($resultUpdate){
                       
                        header("Location: https://veste-onlineshop.000webhostapp.com/index.php?id=1");
                    }else{
                        echo "Sorry, there was a mistake";
                    }
            }

            }else{
                echo "query is not ok";
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
