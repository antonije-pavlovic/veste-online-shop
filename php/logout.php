<?php
session_start();
if(isset($_SESSION['korisnik'])){
    unset($_SESSION['korisnik']);
    session_destroy();
    header("Location: https://veste-onlineshop.000webhostapp.com/index.php?id=1");
}else{
    header("Location: https://veste-onlineshop.000webhostapp.com/index.php?id=1");
}