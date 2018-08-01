<?php
    include "php/cart.php";
?>
<main>
    <div class="cart">
        <div class="wrapper">
            <div class="cartWrapper">
                <form class="cartForm">
                <table class="table table-hover">
                    <tr>
                        <th>Product name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Delete</th>
                        <th>Buy</th>
                    </tr>
                    <?php
                    $ukupno=0;
                   
                        foreach($komadi as $komad):                                                    
                            $tmp=$komad->proizvod_id;
                            $rezultat=$konekcija->query("select * from proizvod where id=$tmp")->fetch(); 
                            $ukupno += $rezultat->cena;                         
                    ?>
                      <tr>
                            <td><?=$rezultat->ime?></td>
                            <td><?=$rezultat->velicina?></td>
                            <td><?="$" . $rezultat->cena?></td>
                            <td><input type="button" data-id="<?=$komad->id?>" class="brisi btn btn-danger" value="delete"></td>
                            <td><input type="button" data-porudzbina="<?=$komad->id?>" data-korisnik="<?= $_SESSION['korisnik']->id?>" data-proizvod="<?=$tmp?>" data-cena="<?= $rezultat->cena?>" class="kupi btn btn-success" value="BUY"></td>
                        </tr>  
                    <?php endforeach;?>
                    <tr>
                        <td colspan="2">Total amount:</td>
                        <td ><?="$" . $ukupno;?></td>
                      
                    </tr>
                   </table> 
                </form>
             
            </div>        
        </div>
    </div>
</main>