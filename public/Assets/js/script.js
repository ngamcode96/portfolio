$(document).ready(function(){
   
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
        strings: ["Je suis à la recherche d'un stage", "Durée minimale 1 mois", "A partir du 16 mai 2022"],
        typeSpeed: 70,
        backSpeed: 30,
        loop: true
    });

    var typed = new Typed(".typing-2", {
        strings: ["YouTuber", "Developer", "Blogger", "Designer", "Freelancer"],
        typeSpeed: 100,
        backSpeed: 60,
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