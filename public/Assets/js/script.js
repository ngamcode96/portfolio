$(document).ready(function(){


    $(".btn-show").click(function(e){
       
        var ref = $(this).attr('ref');

        var project_content = $(".project-content");
        
        $.ajax({
            type: "GET",
            url: "https://amadoungam.herokuapp.com/realisation/"+ ref +"/show",
            success: function(data){
                

                if(data.result == 1){
                    
                    var scroll = $(window).scrollTop();

                    var content = '<div class="p-header" style="margin:10px; width: 120px">';
                    if(data.imageLink != null){
                        content = content + '<div style="float:left; margin:-10px"><img src="uploads/images/'+ data.imageLink + '" style="width:80px" /></div>';
                    }
                    content = content + '<div style="width: 850px;margin-top: 18px;margin-left: 92px; color: #1a2352;">';
                    content = content + '<h2>'+ data.title +' <a href="'+ data.websiteLink +'" target="_blank" class="btn-visite" id="btn-visite">Visiter le site</a></h2>';
                    content = content + '<p><i class="fab fa-github"></i><a href="' + data.githubLink + '" target="_blank" style="color:#333">Voir le code source </a></p>';
                    content = content + ' </div> </div>';

                
                    content = content + '<div style="float:left; margin:20px"><img src="uploads/images/'+ data.id +'.png" alt="image " style="width:100%" /></div>';
                    content = content + '<div style="margin:10px; width:97%;color: #1a2352;"><h4>Description</h4><p>' + data.description + '</p></div>';
                    
                    $(".pro-opa").show();
                    $(".project-content").css({'top' : scroll + 'px'});
                    $(".project").html(content);
                    
                    project_content.fadeIn(1000);
                }else{
                    alert("Une erreur est survenue!")
                }
            }
        })
    })

    $(".card").click(function(e){
        
        var ref = $(this).attr('ref');

        var project_content = $(".project-content");
        
        $.ajax({
            type: "GET",
            url: "https://amadoungam.herokuapp.com/realisation/"+ ref +"/show",
            success: function(data){
                

                if(data.result == 1){

                    var scroll = $(window).scrollTop();
                    
                    
                    var content = '<div class="p-header" style="margin:10px; width: 120px">';
                    if(data.imageLink != null){
                        content = content + '<div style="float:left; margin:-10px"><img src="uploads/images/'+ data.imageLink + '" style="width:80px" /></div>';
                    }
                    content = content + '<div style="width: 850px;margin-top: 18px;margin-left: 92px; color: #1a2352;">';
                    content = content + '<h2>'+ data.title +' <a href="'+ data.websiteLink +'" target="_blank" class="btn-visite" id="btn-visite">Visiter le site</a></h2>';
                    content = content + '<p><i class="fab fa-github"></i><a href="' + data.githubLink + '" target="_blank" style="color:#333">Voir le code source </a></p>';
                    content = content + ' </div> </div>';

                
                    content = content + '<div style="float:left; margin:20px"><img src="uploads/images/'+ data.id +'.png" alt="image " style="width:100%" /></div>';
                    content = content + '<div style="margin:10px; width:97%;color: #1a2352;"><h4>Description</h4><p>' + data.description + '</p></div>';

                    $(".pro-opa").show();
                    $(".project-content").css({'top' : scroll + 'px'});
                    $(".project").html(content);
                    
                    project_content.fadeIn(1000);
                }else{
                    alert("Une erreur est survenue!")
                }
            }
        })
    })

    $(".pro-opa").click(function(){
        $(".pro-opa").hide();
        $(".project-content").fadeOut(1000);
    })

    $(".close-project").click(function(){
        $(".pro-opa").hide();
        $(".project-content").fadeOut(1000);
    })
   
    $("#image_1").fadeIn(1000);
    $('.scroll-up-btn').removeClass("show");


    $(".menu-btn").click(function(){
        $('.menu-btn').attr('class', 'menu-btn');
        $(this).addClass('li-active');
    });

    $("#alert_close").click(function(){
        $(".alert-success").fadeOut(1500);
    });
    $(window).scroll(function(){
        // sticky navbar on scroll script
        if(this.scrollY > 20){
            $('.navbar').addClass("sticky");
        }else{
            $('.navbar').removeClass("sticky");
        }
        
        // scroll-up button show/hide script
        if(this.scrollY > 500){
            $('.scroll-up-btn').addClass("show");
            $('.scroll-down-btn').removeClass("show");

        }else{
            $('.scroll-up-btn').removeClass("show");
            $('.scroll-down-btn').addClass("show");
        }

        
    });

    // slide-up script
    $('.scroll-up-btn').click(function(){
        $('html').animate({scrollTop: 0});
        // removing smooth scroll on slide-up button click
        $('html').css("scrollBehavior", "auto");
    });

    $('.scroll-down-btn').click(function(){
        $('html').animate({scrollTop: 550});
        // removing smooth scroll on slide-up button click
        $('html').css("scrollBehavior", "auto");
    });

    $('.navbar .menu li a').click(function(){
        // applying again smooth scroll on menu items click
        $('html').css("scrollBehavior", "smooth");
    });

    // toggle menu/navbar script
    $('.menu-btn').click(function(){
        $('.navbar .menu').toggleClass("active");
        $('.menu-btn i').toggleClass("active");
    });

    // typing text animation script
    var typed = new Typed(".typing", {
        strings: ["Je suis ?? la recherche d'un stage", "conventionn?? de fin d'??tudes", "A partir du 16 mai 2022"],
        typeSpeed: 70,
        backSpeed: 30,
        loop: true
    });


    // owl carousel script
    $('.carousel').owlCarousel({
        margin: 20,
        loop: true,
        autoplay: true,
        autoplayTimeOut: 2000,
        autoplayHoverPause: true,
        responsive: {
            0:{
                items: 1,
                nav: false
            },
            600:{
                items: 2,
                nav: false
            },
            1000:{
                items: 3,
                nav: false
            }
        }
    });

 
});