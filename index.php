<?php
session_start();
include "php/konekcija.php";
include "views/head.php";
include "views/header.php";
include "views/nav.php";
include "php/function.php";
include "php/article.php";
?>
<main>
    <?php
        if(isset($_GET['id'])){  

           $page= getPage($id=$_GET['id']);
            include "views/". $page;

        }else{
            include "views/home.php";
        }
    ?>
</main>
<?php
    include "views/footer.php";
?>