/****************D R O P D O W N   M E N I******/
$(document).ready(function(){
 /*   
    $('nav li ul').hide(); 
     $(".trigger").click(function(e){        
        $(this).children("ul").slideToggle("slow"),
        $(this).toggleClass("dropdown-active");
    });

    $(window).resize(function() {
       if($(window).width() < 500){
           $('.flex-nav').hide();
           $('.hamburger').show();
       }else{
        $('.flex-nav').show();
        $('.hamburger').hide();
       }
    });
*/
//slider proizvoda
$('.thing').slick({
    dots:true,
    arrows:false,
    autoplay:true,
    autoplaySpeed:1000,
    slidesToShow: 3,
});

    // $(".hamburger").click(function(e){        
    //     $('.flex-nav').slideToggle("slow"),
    //     $('.flex-nav').toggleClass("dropdown-active");
    // });
    
    //form validation
    $('#submit').click(function(){
        //values from sing up form
        var name=$("#name").val();       
        var username=$("#username").val();
        var email=$("#email").val();
        var pass=$("#pass").val();
        var repeatPass=$("#repeatPass").val();

        //creating regular expressions
        var regName= /^[A-Z][a-z]{2,12}$/;        
        var regUsername=/^\w{4,20}$/;
        var regEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var regPass=/^[A-z0-9]{5,20}\W?[A-z0-9]{0,20}$/;        
        
        var err=[];
        //checking first name
        if(!regName.test(name)){
            err.push("name is not good");
            $('#name').css("border-color","red");
        }else{
            $('#name').css("border-color","green");
        }       
        //checking username
        if(!regUsername.test(username)){
            err.push("username is not good");
            $('#username').css("border-color","red");
        }else{
            $('#username').css("border-color","green");
        }
        //checking email
        if(!regEmail.test(email)){
            err.push("email is not good");
            $('#email').css("border-color","red");
        }else{
            $('#email').css("border-color","green");
        }
        //checking password
        if(!regPass.test(pass)){
            err.push("password is not good");
            $('#pass').css("border-color","red");
        }else{
            $('#pass').css("border-color","green");
        }

        //checking repeat pass
        if(repeatPass != pass || repeatPass=="" ){
            err.push("password do not match");
            $('#repeatPass').css("border-color","red");
        }else{
            $('#repeatPass').css("border-color","green");
        }
        
        if(err.length > 0){
            var list="";
            list +="<ul class='list'>";
            for(var i=0;i<err.length;i++){
                list +="<li>"+ err[i] +"</li>";
            }
            list +="</ul>";

            $("#errors").append(list);
        }else{
           // alert("dsds")
            $.ajax({
                url:"php/singup.php",
                method:"POST",                
                data : {
                    send: true,
                    name,
                    username,
                    email,
                    pass,
                    repeatPass
                },
                success : function(data){
                    console.log(data);
                },
                error : function(xhr,status,msg){
                    console.log(xhr.status);                    
                }
            })
            alert("Please check your mail. Verification mail is sent to you");
        }
       
    });

    //dropdown
    jQuery(function(){ 
        jQuery('ul.sf-menu').superfish(); 
      }); 
      
      //CUSTOMR CARE FORM
       $('.ajaxCare').click(function(){
           var subject=$('#subject').val();
           var text=$('#emailText').val();
          
           $.ajax({
               url : "php/care.php",
               method : "post",
               data : {
                   mail : "post",
                   subject,
                   text
               },
               success(data){
                    console.log(data);
               },
               error(xhr,status,msg){
                    console.log(xhr.status);
               }
           })
       })


       ///FILITRIRANJE
       $('body').on('click','.priceFilter',function(){
           var min=$('#min').val();
           var max=$('#max').val();
           var tip=$('#tip').val();
           var korID=$('#kor_id').val();
           //alert(tip);
           $.ajax({
               url : "php/ajax.php",
               method : "post",
               data : {
                   cena : "ok",
                   min,
                   max,
                   tip
               },
               success(data){
                   var x=JSON.parse(data)
                   // console.log(x);
                   var html="";
                for(var i=0;i<x.length;i++){

                    html += '<div class="arc">'
                    html += '<h2>'+x[i].ime+'</h2>'
                    html += '<div class="articlePhoto">'
                    html += '<a class="lightbox" href="'+x[i].slika+'" data-fancybox="group" data-caption="'+x[i].ime+'" > <img src="'+x[i].slika+'" alt="'+x[i].ime+'" width="200px" height="200px"/></a>';
                    html += '</div>';                             
                    html += '<label>'+x[i].cena+'</label>';
                    html += '<a href="#" data-id="'+x[i].id+'" class="articleAjax">More about product</a>';
                    html += '<input type="button" name="card" data-id="'+ x[i].id +'" data-user="'+korID +'" value="add to card" class="addToCard"/>';              
                }                
                    html += '</div> ';
                    $('.pagination').hide();
                    $('.articles').html(html);
                },
               error(xhr,status,msg){
                    console.log(xhr.status);
               }
           })
       })

       //PRETRAGA
       $(".pretrazi").keyup(function(){
            var tekst=$(this).val();
            var tip=$("#pretragaTip").val();
            var idKor=$("#idKOr").val();
          //  alert(tip);
           // alert(tekst);           
            $.ajax({
                url : "php/ajax.php",
                method : "post",
                data : {
                    pretraga : "ok",
                    tekst,
                    tip
                },
                success(data){
                    var x=JSON.parse(data)
                    console.log(x);
                   var html="";
                for(var i=0;i<x.length;i++){

                    html += '<div class="arc">';
                    html += '<h2>'+x[i].ime+'</h2>';
                    html += '<div class="articlePhoto">';
                    html += '<a class="lightbox" href="'+x[i].slika+'" data-fancybox="group" data-caption="'+x[i].ime+'" > <img src="'+x[i].slika+'" alt="'+x[i].ime+'" width="200px" height="200px"/></a>';
                    html += '</div>';                             
                    html += '<label>'+x[i].cena+'</label>';
                    html += '<a href="#" data-id="'+x[i].id+'" class="articleAjax">More about product</a>';
                    html += '<input type="button" name="card"data-id="'+ x[i].id+'" data-user="'+idKor+'" value="add to card" class="addToCard"/>';              
                }                
                    html += '</div> ';
                    $('.pagination').hide();
                    $('.articles').html(html);
                },
                error(xhr,status,msg){

                }
            })        
       })

  //DODAVANJE ARTIKLA U KORPU
    $('body').on('click','.addToCard',function(){
        var proizvodID=$(this).data('id');
        var userID=$(this).data('user');
            $.ajax({
                url : "php/ajax.php",
                method : "post",
                data :{
                    card : "ok",
                    proizvodID,
                    userID
                },
                success(data){
                    alert(data);
                },error(xhr,status,msg){
                    console.log(xhr.status);
                }
            })
    })
    //BRISANJE ARTIKLA IZ KORPE
    $('.brisi').click(function(){
        var idPorudzbine=$(this).data('id');
        $.ajax({
            url : "php/ajax.php",
            method : "post",
            data : {
                brisi : "ok",
                idPorudzbine
            },
            success(data){
               if(data){
                   alert("You have successfully removed the product from the cart");
                location.reload();
               }
            },
            error(xhr,status,msg){
                console.log(xhr.status);
            }
        })
    })
    //KONACNA KUPOVINA PROIZVODA
    $(document).on('click','.kupi',function(){
        var korID=$(this).data('korisnik');
        var proID=$(this).data('proizvod');
        var Cena=$(this).data('cena');
        var porudzbina=$(this).attr('data-porudzbina');
        alert(porudzbina);
        $.ajax({
            url : "php/ajax.php",
            method : "post",
            data : {
                kupi : "ok",
                korID,
                proID,
                Cena,
                porudzbina
            },
            success(data){              
               location.reload();
            },
            error(xhr,status,msg){
                console.log(xhr.status);
            }
        })
    })
    //MORE ABOUT PRODUCT
$('body').on('click','.articleAjax',function(){
    var idProizvoda=$(this).data('id');
    $.ajax({
        url : "php/ajax.php",
        method : "post",
        data : {
            more : "ok",
            idProizvoda
        },
        success(data){
            var proizvod=JSON.parse(data);
            var html ='';
            html +='<div class="more">';
                html +='<div class="imgMore">';
                    html +='<img src="'+proizvod.slika +'" alt="'+ proizvod.ime+'" width="300px" height="400px">';
                html +='</div>';
                html +='<div class="productMore">';
                    html +='<h2 class="productName">'+proizvod.ime+'</h2>';
                    html +='<p>'+proizvod.opis+'</p>';
                    html += '<div class="priceSize">';
                        html +='<label> Price:'+proizvod.cena+'</label>';
                        html +='<label>Size:'+proizvod.velicina+'</label>';
                    html +='</div>';
                html +='</div>';
            html +='</div>';
            $('.pagination').hide();
            $('.articles').html(html);
        },
        error(xhr,status,msg){
            console.log(xhr.status);
        }
    })
})

    /*****************ADMIN AJAX*********************/
//DODAVANJE KORISNIKA
$('body').on('click','.submitEnter',function(){
    var ime=$('#name').val();
    var korisnicko_ime=$('#username').val();
    var email=$('#email').val();
    var password=$('#password').val();
    var aktivan=$('#active').val();
    var uloga=$('#role').val();

    //provera regularnim izrazima
    var regName= /^[A-Z][a-z]{2,12}$/;        
    var regUsername=/^\w{4,20}$/;
    var regEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var regPass=/^[A-z0-9]{5,20}\W?[A-z0-9]{0,20}$/;

    var errors=[];
    if(!regName.test(ime)){
        errors.push("name is not good");
        $('#name').css("border-color","red");
    }else{
        $('#name').css("border-color","green");
    }       
    //checking username
    if(!regUsername.test(korisnicko_ime)){
        errors.push("username is not good");
        $('#username').css("border-color","red");
    }else{
        $('#username').css("border-color","green");
    }
    //checking email
    if(!regEmail.test(email)){
        errors.push("email is not good");
        $('#email').css("border-color","red");
    }else{
        $('#email').css("border-color","green");
    }
    //checking password
    if(!regPass.test(password)){
        errors.push("password is not good");
        $('#password').css("border-color","red");
    }else{
        $('#pass').css("border-color","green");
    }
    if(uloga ==='0'){
        errors.push("you need to choose a role for user");
        $('#role').css("border-color","red");
    }else{
        $('#role').css("border-color","green");
    }
    if(errors.length > 0){
        alert(errors);
    }else{
        $.ajax({
            url : "php/ajax.php",
            method : "post",
            data : {
                unos : "ok",
                ime,
                korisnicko_ime,
                email,
                password,
                aktivan,
                uloga
            },
            success(data){
                alert(data);   
                window.location.href= "http://localhost:8080/site/index.php?id=12";        
            },
            error(xhr,status,msg){
                console.log(xhr.status);
            }
        })
    }
   

    
})
//BRISANJE KORISNIKA
$('body').on('click','.deleteUser',function(){
        var id=$(this).data('id');
       // alert(id);
       $.ajax({
           url : "php/ajax.php",
           method : "post",
           data : {
               brisanjeKorisnika : "ok",
               id
           },
           success(data){
                console.log(data);
                alert(data);
                location.reload();
           },
           error(xhr,status,msg){
            console.log(xhr.status);
           }
       })
})
//UPDATE KORISNIKA
$('body').on('click','.updateUser',function(){
    var id=$(this).data('id');
    //alert(id);
    $.ajax({
        url : "php/ajax.php",
        method : "post",
        data : {
            updateUser : "ok",
            id
        },
        success(data){
             var x=JSON.parse(data);        
            var korisnickiPodaci=JSON.parse(x[0]);
            var ulogePodaci=x[1];
           // console.log(ulogePodaci);
            html ='';           
            html +='<form>';

           html += '<div class="form-group">'; 
           html += ' <label>First name</label>';
           html += ' <input type="text" class="form-control"  value="'+ korisnickiPodaci.ime+'" id="name" /> ';
           html += '</div>'; 
            
           html += '<div class="form-group">'; 
           html += ' <label>Username</label>';
           html += ' <input type="text" class="form-control" value="'+ korisnickiPodaci.korisnicko_ime+'"  id="username" /> ';
           html += '</div>'; 
 
           html += '<div class="form-group">'; 
           html += ' <label>Email address</label>';
           html += ' <input type="text" class="form-control" value="'+ korisnickiPodaci.email+'" id="email" /> ';
           html += '</div>'; 
            
           html += '<div class="form-group">'; 
           html += ' <label>Active:</label>';
           html += ' <select id="active" class="form-control">'                    
                if(korisnickiPodaci.aktivan == 1){
                    html += '<option value="1" selected >Active</option>';
                    html += '<option value="0">Inactive</option>'
                    }else{
                        html += '<option value="1" >Active</option>';
                        html += '<option value="0" selected>Inactive</option>'
                    }
           html += '</select> ';
           html += '</div>';  
           html += '<div class="form-group">'; 
           html += ' <label>Role</label>';
           html += ' <select id="role" class="form-control">'
                   for(var i=0;i<ulogePodaci.length;i++){
                        if(korisnickiPodaci.uloga_id == ulogePodaci[i].id){
                            html += '<option value="'+ulogePodaci[i].id+'" selected>'+ ulogePodaci[i].naziv+'</option>'; 
                        }
                            html += '<option value="'+ulogePodaci[i].id +'">'+ulogePodaci[i].naziv +'</option>';                          
                    }
           html += '</select> ';
           html += '</div>'; 
           html += '<input type="button" value="submit" data-id="'+korisnickiPodaci.id+'" class="editData btn btn-primary"/> ';
           html +='</form>';            
           $('.enterUser').html(html);
        },
        error(xhr,status,msg){
            console.log(xhr.status);
        }
    })
})

//UNOSENJE IZMENJENIH PODATAKA
$('body').on('click',".editData",function(){
    var id=$(this).data('id');
    var ime=$('#name').val();
    var korisnickoIme=$('#username').val();
    var email=$('#email').val();
    var aktivan=$('#active').val();
    var uloga=$('#role').val();

    //provera regularin izrazima
    $.ajax({
        url : "php/ajax.php",
        method : "post",
        data : {
            izmene : "ok",
            id,
            ime,
            korisnickoIme,
            email,
            aktivan,
            uloga
        },
        success(data){
            alert(data);
        },
        error(xhr,status,msg){
            console.log(xhr.status);
        }
    })
})
//BRISANJE PROIZVODA
$('body').on('click','.deleteProduct',function(){
    var id=$(this).data('id');
    $.ajax({
        url : "php/ajax.php",
        method : "post",
        data : {
            brisanje : "ok",
            id
        },
        success(data){
            console.log(data);
            alert(data);
            location.reload();
        },
        error(xgr,status,msg){
            console.log(xhr.status);
        }
    })
})

//UPDATE PROIZVODA
$('body').on('click','.updateProduct',function(){
    var id=$(this).data('id');

    $.ajax({
        url : "php/ajax.php",
        method : "post",
        data : {
            proizvod : "ok",
            id
        },
        success(data){            
            var b=JSON.parse(data);
            var html = '';
            var tip={mc:"mans shoes",zc:"women shoes",o:"suit",h:"dress"};
            var html ='';
            html += '<form action="index.php?id=12" method="POST" enctype="multipart/form-data">';
 
            html += '<div class="form-group">'; 
            html += ' <label>Product name:</label>';
            html += ' <input type="text" class="form-control" value="'+ b.ime+'"   name="ime" /> ';
            html += '</div>'; 
            
            html += '<div class="form-group">'; 
            html += ' <label>Describe:</label>';
            html += ' <textarea class="form-control" name="opis">'+ b.opis+'</textarea>';
            html += '</div>'; 
 
            html += '<div class="form-group">'; 
            html += ' <label>Upload photo:</label>';
            html += ' <input type="file" class="form-control" name="slika" /> ';
            html += '</div>'; 
 
            html += '<div class="form-group">'; 
            html += ' <label>Price:</label>';
            html += ' <input type="text" class="form-control" value="'+ b.cena+'"  name="cena" /> ';
            html += '</div>'; 
 
            html += '<div class="form-group">'; 
            html += ' <label>Type:</label>';
            html += ' <select name="tip" class="form-control"> ';
                    for(x in tip){
                       if(b.tip == x){
                           html += '<option value="'+x+'" selected>'+tip[x]+'</option>';
                       } 
                       html += '<option value="'+x+'">'+tip[x]+'</option>';
                    }                           
            html +=  '</select> ';
            html +='</div>'; 
 
            html += '<div class="form-group">'; 
            html += ' <label>Size:</label>';
            html += ' <input type="text" class="form-control" value="'+ b.velicina +'"  name="velicina" /> ';
            html += '</div>'; 
 
            html += '<div class="form-group">';
            html += '<input type="hidden" value="'+b.id+'" name="skriveno"/>';            
            html += '<input type="submit" value="submit" name="updateProduct" class="btn btn-primary"/>';
            html += '</div>'; 
            html += '</form>';
            $('.enterUser').html(html);
        },
        error(xhr,status,msg){
            console.log(xhr.status);
        }
    })
})
$('body').on('change','.ddlPitanja',function(){
    var idPitanja=$(this).val();
    var id=$(this).data('id');
   //alert(id);
    //alert(idPitanja);
    $.ajax({
        url : "php/ajax.php",
        method: "post",
        data : {
            pitanjeLista : "ok",
            idPitanja
        },
        success(data){           
            var x=JSON.parse(data);
            console.log(x);
            var html = '';
            html += '<form class="ajaxAnswer">';
                for(var i=0 ;i<x.length;i++)
                    html += '<input type="radio" name="odg" value="'+x[i].id+'"/>'+x[i].tekst+'</br>';  
                html += '<input type="button" class="answerSubmit btn btn-success" data-pitanje="'+idPitanja+'" data-id="'+id+'" value="submit"/>'               
            html += '</form>';
            $('.notice').hide();
            $('.answer').html(html);
        },
        error(xhr,status,msg){
            console.log(xhr.status);
        }
    })
})
//UPISIVANJE ODGOVORA
$('body').on('click','.answerSubmit',function(){
    var idUser=$(this).data('id');
    var idOdgovora=$('input[name=odg]:checked').val();
    var idPitanja=$(this).data('pitanje');
   // alert(radio);
   $.ajax({
       url : "php/ajax.php",
       method : "post",
       data : {
           konacan : "ok",
           idUser,
           idOdgovora,
           idPitanja
       },
       success(data){
            alert(data);
            
       },
       error(xhr,status,msg){
        console.log(xhr.status);
       }
   })
})

});
