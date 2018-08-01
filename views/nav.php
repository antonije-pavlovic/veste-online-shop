<div id="nav">
<div class="wrapper">
                    <div class="left">
                            <p>VESTE</p>
                    </div>                   
                    <nav class="flex-nav">
                       <?php
                         include "php/konekcija.php";
                            function show($roditelj,$konekcija){
                                $query="select * from meni where roditelj=$roditelj";
                                $result = $konekcija->query($query);
                                    if ($result->rowCount() > 0){                                                                  
                                            echo "<ul>";                                      
                                    }
                                    foreach($result as $res){
                                        if($res->id == 4 || $res->id == 5 ){
                                            echo "<li><a href='#'>".$res->naziv."</a>";
                                        }else{
                                            if($res->tip != null){
                                                echo "<li><a href='index.php?type=".$res->tip."&id=".$res->id."'>".$res->naziv."</a>";
                                            }else{
                                                echo "<li><a href='index.php?type=o&id=".$res->id."'>".$res->naziv."</a>";
                                            }
                                            
                                        }                                       
                                        show( $res->id, $konekcija);
                                        echo "</li>";
                                    }
                                    if ($result->rowCount() > 0){
                                        echo "</ul>"; 
                                    }
                                } 

                                $query_link = "SELECT * FROM meni WHERE roditelj=0";
                                $result_link = $konekcija->query($query_link);
                                echo "<ul class='sf-menu '>";
                                    foreach($result_link as $res){                                        
                                        if($res->id == 10 || $res->id == 11 ||  $res->id == 12 ){
                                            continue;
                                        }                                       
                                        if($res->tip != null){
                                            echo "<li><a href='index.php?type=".$res->tip."&id=".$res->id."'>".$res->naziv."</a>";
                                        }
                                        echo "<li><a href='index.php?id=".$res->id."'>".$res->naziv."</a>";
                                        show( $res->id,$konekcija);
                                        echo "</li>";
                                    }
                            
                                echo "</ul>"; 
                       ?>                      
                       
                    </nav>
                </div>
            </div>