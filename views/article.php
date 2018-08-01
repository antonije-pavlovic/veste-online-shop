<main>
    <div class="article">
        <div class="wrapper">
            <div class="articleWrapper">
                <div class="filterWrap">
                    <div class="filter">
                        <form>                            
                            <label for="text">Search product</label>
                            <input type="hidden" value="<?= $_SESSION['korisnik']->id?>" id="idKOr"/>
                            <input type="hidden" value="<?= $tip?>" id="pretragaTip"/>
                             <input type="text" data-type="<?php $tip?>" class="pretrazi form-control" placeholder="SEARCH"/>                             
                        </form>
                        <form>
                            <div class="form-group">
                                <label for="text">Enter price:</label>
                                <input type="text" class="form-control" id="min"placeholder="MIN PRICE"/>
                                <input type="text" class="form-control" id="max" placeholder="MAX PRICE"/>
                                <input type="hidden" value="<?= $tip?>" id="tip"/>
                                <input type="hidden" value="<?= $_SESSION['korisnik']->id?>" id="kor_id"/>
                            </div>                  
                                <button type="button"  class="priceFilter btn btn-default">Submit</button>
                        </form>                        
                    </div>
                    <div class="articles">
                        <?php

                            foreach($proizvodi as $proizvod):
                        ?>
                       
                        <div class="arc">
                                <h2><?= $proizvod->ime?></h2>
                                <div class="articlePhoto">
                                <a class="lightbox" href="<?= $proizvod->slika ?>" data-fancybox="group" data-caption="<?=$proizvod->ime?>" > <img src="<?= $proizvod->slika?>" alt="<?= $proizvod->ime?>" width="200px" height="200px"/></a>
                                </div>                                
                                <label><?= "$".$proizvod->cena?></label>
                                <a href="#" data-id="<?= $proizvod->id?>" class="articleAjax">More about product</a> 
                                <?php if(isset($_SESSION['korisnik'])): ?>
                                    <input type="button" name="card" data-id="<?=$proizvod->id?>" data-user="<?= $_SESSION['korisnik']->id?>"  value="add to card" class="addToCard"/>
                                <?php endif;?>
                        </div> 
                            <?php  endforeach;?>              
                    </div>                    
                </div>  
                <div class="pagination">
                        <?php        
                         $lista ="<ul>";               
                            for($i=1;$i<$brojStrana+1;$i++){                             
                                  $lista .="<li><a href='index.php?type=".$proizvodi[0]->tip."&id=".$_GET['id']."&page=".$i."'>$i</a></li>";
                            }
                            $lista .="</ul>";
                            echo $lista;
                        ?>
                    </div>             
            </div>        
        </div>
    </div>
</main>