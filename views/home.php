<main>
                <div class="firstBgColor">
                    <div class="wrapper">
                        <div class="mainWrapper">
                            <section class="first">
                                <div class="imgWomen">
                                    <img src="pics/women.jpg" alt=""  class="img-responsive"/>
                                </div>
                                <div class="textWomen">
                                    <p>SULTRY & SMART</p>
                                    <p>HOT SPRING LOOKS</p>
                                    <p><a ahref="">Shop Women</a></p>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>  
                <div class="secondBgColor">
                    <div class="wrapper">
                        <div class="mainWrapper">
                            <section class="first">
                                <div class="textWomen whiteFont">
                                    <p>ELEGANT & SLICK</p>
                                    <p>GET READY FOR SUMMERS</p>
                                    <p><a ahref="">Shop man</a></p>
                                </div>
                                <div class="imgWomen">
                                    <img src="pics/man.jpg" alt="" class="img-responsive"/>
                                </div>                               
                            </section>
                        </div>
                    </div>
                </div> 
                <div class="wrapper">
                   <div class="mainWrapper">
                       <section class="arrivals">
                           <h2>New arrivals</h2>
                       </section>
                       <section class="thing articl ">
                           <?php
                            $artikli=poslenjiArtikli();
                            foreach($artikli as $artikal):
                           ?>                           

                           <div class="ar">
                               <div class="articleImg">
                                   <img src="<?=$artikal->slika?>" alt="" width="300px" height="400px"/>
                               </div>
                               <div class="price">
                                    <p><?=$artikal->ime?></p>
                                    <p><?="$".$artikal->cena?></p>
                               </div>
                           </div>
                            <?php endforeach;?>
                       </section>

                       
                       <section class="mailList">
                           <p>GET ON THE LIST</p>
                           <p>and be the first to shop new arrivals and exclusive promotions.</p>
                           <form class="forma">
                               <input type="email" name="email" placeholder="Email Address" class="email"/></br>
                               <input type="button" value="Subscribe Now" class="buttonStyle"/>
                           </form>
                       </section>
                   </div>    
                </div> 
                <div class="thirdBgColor">
                    <div class="wrapper">
                        <div class="imgWrapper">
                            <section class="images">
                               <a href="#"> <img src="pics/winter.png" alt="" width="430px" height="400" class="img-responsive"/></a>
                            </section>
                            <section class="images">
                               <a href="#"> <img src="pics/accessories1.jpg" alt="" width="430px" height="400" class="img-responsive"/></a>
                            </section>
                        </div>
                    </div>
                </div>    
            </main>