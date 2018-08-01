<body>
        <div id="main">
            <div id="dataHolder">
                <div class="wrapper">
                    <div class="help">
                        <div id="login">
                            <?php
                                    if(isset($_SESSION['korisnik'])):
                                    
                            ?>
                            <form method="POST" action="php/logout.php">
                                <input type="submit" value="logout" name="logout" class="btn btn-default"/>
                            </form>
                            <?php else :?>                              
                            <form method="POST" action="php/login.php">
                            <div class="polja">
                                <input type="text"  placeholder="Username" name="username" class="form-control"/>
                                <input type="password" placeholder="Password" name="password" class="form-control"/> 
                            </div>                           
                                <input type="submit" value="login" name="login" class="btn btn-default"/>
                            </form>
                                <label><a href="index.php?id=10" >or sing up</a></label>
                            <?php endif;?>
                        </div>
                        <div id="data">
                            <div id="left">
                            <?php 
                                if(isset($_SESSION['korisnik'])):
                                    if($_SESSION['korisnik']->ulogaID == 1):
                            ?>
                                <a href="index.php?id=12">ADMIN PANEL</a>
                            <?php
                                endif;
                            endif;
                            ?>
                            </div>
                            <div id="right">
                            <?php 
                                if(isset($_SESSION['korisnik'])):                                  
                            ?>
                                <a href="index.php?id=11"><img src="pics/cart.png" alt="cart" width="40px" height="40px"/></a>
                                <?php endif; ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>