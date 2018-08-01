<main>
    <div class="care">
        <div class="wrapper">
            <div class="customerCare"> 
             <form> 
             <h4>Send us mail</h4>
                <div class="form-group">
                    <label for="usr">Input subject</label>
                    <input type="text" class="form-control" id="subject">
                </div>         
                 <div class="form-group">
                    <label for="exampleFormControlTextarea1">Email text:</label>
                    <textarea class="form-control" id="emailText" rows="3"></textarea>
                </div>
                    <button type="button" class=" ajaxCare btn btn-primary ">Submit</button>
                </form>
                <div class="anketa">
                <?php
                    if(isset($_SESSION['korisnik'])):
                ?>
                    <h4>Short survey</h4>

                    <select name="ddlPitanja" class="ddlPitanja" data-id="<?=$_SESSION['korisnik']->id?>">
                        <option value="0">Choose...</option>
                       <?php
                        $rezultati=dohvatiPitanja();
                        foreach($rezultati as $rezultat):
                            if(proveraPitanja($_SESSION['korisnik']->id,$rezultat->id)){
                                continue;
                            }
                       ?>
                       <option value="<?=$rezultat->id;?>"> <?=$rezultat->tekst;?> </option>
                        <?php endforeach;?>
                    </select>
                        <div class="answer">
                        </div>
                    <p class="notice">NOTICE:</br>you do not have to answer all the questions at once, choose the questions you want to answer</p>
                    <div class="statistics">
                        <h3>Survey Statistics:</h3>
                       <?php
                            $pitanja=dohvatiPitanja();
                            $z=0;
                            for($i=0;$i<count($pitanja);$i++){                                
                                echo "</br>".$pitanja[$i]->tekst ."</br>";
                                $odgovori=dohvatiOdgovore($i+1);                                                              
                                for($j=0;$j<count($odgovori);$j++){                                   
                                    $z++;
                                    $brojOdg=statistika($i+1,$z);
                                    echo   " -" . $odgovori[$j]->tekst."&nbsp&nbsp (answers: " .$brojOdg->broj.")". "</br>";                                    
                                }
                            }
                       ?>
                    </div>
                </div>
                        <?php endif;?>
            </div>
        </div>
    </div>
</main>