

    <div class="admin">
        <div class="wrapper">
            <div class="options">
                <div class="adminWrapper">
                    <form action="<?= $_SERVER['PHP_SELF'] . "?id=12";?>" method="post">
                            <div class="form-group">
                                <select name="ddlOpcije" class="form-control">
                                    <option value="0">Choose...</option>
                                    <option value="1">Enter a new user</option>
                                    <option value="2">Delete or edit users</option>
                                    <option value="3">Enter the new product</option>
                                    <option value="4">Delete or edit products</option>                                    
                                </select>
                            </div>
                            <input type="submit" value="submit" name="admin" class="btn btn-info"/>
                    </form>            
                </div>  
                <?php
    if(isset($_POST['admin'])){
        $opcija=$_POST['ddlOpcije'];
       // echo $opcija;
        if($opcija == 1){
           
           $html = '<section class="enterUser">';
           $html .= '<form>';

           $html .= '<div class="form-group">'; 
           $html .= ' <label>First name</label>';
           $html .= ' <input type="text" class="form-control"  placeholder="Enter first name" id="name" /> ';
           $html .= '</div>'; 
           
           $html .= '<div class="form-group">'; 
           $html .= ' <label>Username</label>';
           $html .= ' <input type="text" class="form-control"  placeholder="Enter username" id="username" /> ';
           $html .= '</div>'; 

           $html .= '<div class="form-group">'; 
           $html .= ' <label>Email address</label>';
           $html .= ' <input type="text" class="form-control"  placeholder="Enter email" id="email" /> ';
           $html .= '</div>'; 

           $html .= '<div class="form-group">'; 
           $html .= ' <label>Password</label>';
           $html .= ' <input type="text" class="form-control"  placeholder="Enter password" id="password" /> ';
           $html .= '</div>'; 

           $html .= '<div class="form-group">'; 
           $html .= ' <label>Active:</label>';
           $html .= ' <select id="active" class="form-control"> <option value="0">inactive</option> <option value="1">Active</option> </select> ';
           $html .= '</div>'; 

           $html .= '<div class="form-group">'; 
           $html .= ' <label>Role</label>';
           $html .= ' <select id="role" class="form-control"> <option value="0">Choose</option> <option value="1">Admin</option> <option value="2">User</option> </select> ';
           $html .= '</div>'; 

           $html .= '<div class="form-group">';            
           $html .= '<input type="button" value="submit" class="submitEnter btn btn-primary"/>';
           $html .= '</div>'; 
           $html .='</form>';
           $html .= '</section>';
           echo $html;
           
        }elseif($opcija == 2){
            $upit="select k.*,u.id as uloga from korisnik k inner join uloga u on k.uloga_id=u.id";            
            $korisnici=$konekcija->query($upit)->fetchAll();          
            
            $html = '<section class="enterUser">';
            $html .= '<table class="table table-hover">';
            $html .= '<tr><th>Name:</th><th>Username:</th><th>Email:</th><th>Active status:</th><th>Role:</th><th>Delete:</th><th>Edit:</th></tr>';
                foreach($korisnici as $kor){                    
                    $html .= '<tr><td>'.$kor->ime.'</td><td>'.$kor->korisnicko_ime.'</td><td>'.$kor->email.'</td> <td>'. $kor->aktivan.'</td> <td>'. $kor->uloga.'</td>';
                    $html .= ' <td><input type="button" value="Delete" data-id='.$kor->id.' class="deleteUser btn btn-danger"/></td><td><input type="button" value="Edit" data-id='. $kor->id.' class="updateUser btn btn-primary"/></td> </tr>';
                }
            $html .= '</table>';
            $html .= '</section>';
            echo $html;
        }elseif($opcija == 3){
            $html = '<section class="enterUser">';
            $html .= '<form action="index.php?id=12" method="POST" enctype="multipart/form-data">';
 
            $html .= '<div class="form-group">'; 
            $html .= ' <label>Product name:</label>';
            $html .= ' <input type="text" class="form-control"  placeholder="Enter product name" name="ime" /> ';
            $html .= '</div>'; 
            
            $html .= '<div class="form-group">'; 
            $html .= ' <label>Describe:</label>';
            $html .= ' <textarea class="form-control" placeholder="Enter describe" name="opis"></textarea>';
            $html .= '</div>'; 
 
            $html .= '<div class="form-group">'; 
            $html .= ' <label>Upload photo:</label>';
            $html .= ' <input type="file" class="form-control" name="slika" /> ';
            $html .= '</div>'; 
 
            $html .= '<div class="form-group">'; 
            $html .= ' <label>price</label>';
            $html .= ' <input type="text" class="form-control"  placeholder="Enter price" name="cena" /> ';
            $html .= '</div>'; 
 
            $html .= '<div class="form-group">'; 
            $html .= ' <label>Type:</label>';
            $html .= ' <select name="tip" class="form-control"> ';
                    $html .= '<option value="zc">Women shoes</option> ';
                    $html .= '<option value="mc">Man shoes</option> ';
                    $html .= '<option value="o">Suit</option> ';
                    $html .= '<option value="h">Dress</option> ';
                    $html .=  '</select> ';
            $html .= '</div>'; 
 
            $html .= '<div class="form-group">'; 
            $html .= ' <label>Size:</label>';
            $html .= ' <input type="text" class="form-control"  placeholder="Enter size" name="velicina" /> ';
            $html .= '</div>'; 
 
            $html .= '<div class="form-group">';            
            $html .= '<input type="submit" value="submit" name="product" class="btn btn-primary"/>';
            $html .= '</div>'; 
            $html .= '</form>';
            $html .= '</section>';
            echo $html;
        }elseif($opcija == 4){
            $upit="select * from proizvod";
            $proizvodi=$konekcija->query($upit)->fetchAll();  

            $html = '<section class="enterUser">';
            $html .= '<table class="table table-hover">';
            $html .= '<tr><th>Name:</th><th>Describe:</th><th>Photo:</th><th>Price</th><th>Type:</th><th>Size:</th><th>Edit:</th></tr>';
                foreach($proizvodi as $proizvod){                    
                    $html .= '<tr><td>'.$proizvod->ime.'</td><td>'.$proizvod->opis.'</td> <td><img src="'.$proizvod->slika.'" widht="150px" height="150px"/></td> <td>'. $proizvod->cena.'</td><td>'. $proizvod->tip.'</td><td>'. $proizvod->velicina.'</td>';
                    $html .= ' <td><input type="button" value="Delete" data-id='.$proizvod->id.' class="deleteProduct btn btn-danger"/></td><td><input type="button" value="Edit" data-id='. $proizvod->id.' class="updateProduct btn btn-primary"/></td> </tr>';
                }
            $html .= '</table>';
            $html .= '</section>';
            echo $html;
        }
        
    }
    if(isset($_POST['product'])){
        $ime=$_POST['ime'];
        $opis=$_POST['opis'];        
        $cena=$_POST['cena'];
        $tip=$_POST['tip'];
        $velicina=$_POST['velicina'];

        $regIme = "/^[A-z\s\.]+$/";
        $regOpis ="/^[A-z0-9\.\s]+$/";
        $regCena ="/^[0-9]+$/";
        $regVelicina="/^[s,m,x,l,0-9]+$/"; 

        $greske=[];
        if(!preg_match($regIme,$ime)){
            $greske[]="name is not good";
        }
        if(!preg_match($regOpis,$opis)){
            $greske[]="descrie is not good";
        }
        if(!preg_match($regCena,$cena)){
            $greske[]="price is not ok";
        }
        if(!preg_match($regVelicina,$velicina)){
            $greske[]="size is not ok";
        }

        $slika = $_FILES['slika'];
        $ime_fajla = $slika['name'];
        $tip_fajla = $slika['type'];
        $velicina_fajla = $slika['size'];
        $tmp_putanja = $slika['tmp_name'];
        
        $formati = array("image/jpg", "image/jpeg", "image/png");

        if(!in_array($tip_fajla, $formati)){
            $greske[] = "type is not ok.";
        }
    
        if($velicina_fajla > 5000000){ 
            $greske[] = "file is need to be under 5mb.";
        }
        if(count($greske) == 0){
            $naziv_fajla = time().$ime_fajla;
            $nova_putanja = "pics/articles/".$naziv_fajla;
            move_uploaded_file($tmp_putanja, $nova_putanja);

            $upit="insert into proizvod values('',:ime, :opis, :slika, :cena, :tip, :velicina)";
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(":ime",$ime);
            $priprema->bindParam(":opis",$opis);
            $priprema->bindParam(":slika",$nova_putanja);
            $priprema->bindParam(":cena",$cena);
            $priprema->bindParam(":tip",$tip);
            $priprema->bindParam(":velicina",$velicina);
            try{
                $rezultat=$priprema->execute();
                if($rezultat){
                    echo '<p>You have successfully uploded the product</p>';
                }else{
                    echo "upit nije ok";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }else{
            echo "<ol>";
            foreach($greske as $greska)
                echo '<li>'.$greska.'</li>';
            echo "</ol>";
        }


    }

//UPDATE PROIZVODA
if(isset($_POST['updateProduct'])){
    $ime=$_POST['ime'];
    $opis=$_POST['opis'];        
    $cena=$_POST['cena'];
    $tip=$_POST['tip'];
    $velicina=$_POST['velicina'];
    $id=$_POST['skriveno'];

    $greske=[];
    $regIme = "/^[A-z\s\.]+$/";
    $regOpis ="/^(.)+$/";
    $regCena ="/^[0-9]+$/";
    $regVelicina="/^[s,m,x,l,0-9]+$/"; 
    if(!preg_match($regIme,$ime)){
        $greske[]="name is not good";
    }
    if(!preg_match($regOpis,$opis)){
        $greske[]="describe is not good";
    }
    if(!preg_match($regCena,$cena)){
        $greske[]="price is not ok";
    }
    if(!preg_match($regVelicina,$velicina)){
        $greske[]="size is not ok";
    }

    $slika = $_FILES['slika'];
    $ime_fajla = $slika['name'];
    $tip_fajla = $slika['type'];
    $velicina_fajla = $slika['size'];
    $tmp_putanja = $slika['tmp_name'];
    
    $formati = array("image/jpg", "image/jpeg", "image/png");

    if(!in_array($tip_fajla, $formati)){
        $greske[] = "type is not ok.";
    }

    if($velicina_fajla > 5000000){ 
        $greske[] = "file is need to be under 5mb.";
    }
    if(count($greske) == 0){
        $naziv_fajla = time().$ime_fajla;
        $nova_putanja = "pics/articles/".$naziv_fajla;
        move_uploaded_file($tmp_putanja, $nova_putanja);

        $upit="update proizvod set ime=:ime, opis=:opis, slika=:slika, cena=:cena, tip=:tip, velicina=:velicina where id=:id";
        $priprema=$konekcija->prepare($upit); 
        $priprema->bindParam(":ime",$ime);
        $priprema->bindParam(":opis",$opis);
        $priprema->bindParam(":slika",$nova_putanja);
        $priprema->bindParam(":cena",$cena);
        $priprema->bindParam(":tip",$tip);
        $priprema->bindParam(":velicina",$velicina);
        $priprema->bindParam(":id",$id);
        try{
            $rezultat=$priprema->execute();
            if($rezultat){
                echo '<p>You have successfully updated the product</p>';
            }else{
                echo "upit nije ok";
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }else{
        echo "<ol>";
            foreach($greske as $greska)
                echo '<li>'.$greska.'</li>';
            echo "</ol>";
    }
}
?> 
            </div>    
        </div>
    </div>

