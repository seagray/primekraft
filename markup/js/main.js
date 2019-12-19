$(document).ready(function() {
    if($('.main_header').length > 0){
        setTimeout(function(){
            $('.main_header--fon').css({transform: 'scale(1)'});
        }, 100);
        /*$(window).scroll(function(){
            if($(window).scrollTop() > 1)
                $('.main_header--fon').css({transform: 'scale(1.1)'});
            else
                $('.main_header--fon').css({transform: 'scale(1)'});
        });*/
    };
    $('.openSub').on('click', function(){
        $('.openSub').not(this).closest('li').removeClass("active");
        $('.openSub').not(this).siblings('ul').slideUp(500);
        $(this).closest('li').toggleClass("active");
        $(this).siblings('ul').stop().slideToggle(500);
    });
    $('.objects').on('click', function(){
        $(this).toggleClass('active');
        $(this).closest('.addr_on_map').toggleClass('active');
        $(this).next('.objects_block-wrap').slideToggle(500);
    });

    $(".modal_Form").validate({
        rules: {
            tel: "required",
            msg: "required"
        },
        messages: {
            tel: "Обязательное поле.",
            msg: "Обязательное поле."
        }
    });
    $(".static_Form").validate({
        rules: {
            tel: "required",
            msg: "required"
        },
        messages: {
            tel: "Обязательное поле.",
            msg: "Обязательное поле."
        }
    });
    $('.button_link').each(function(){
        $(this).append('<i></i>');
    });
    $('.nav a').each(function(){
        $(this).append('<i></i>');
    });
    $('.full_news .news_text').prepend("<aside class='imitation_img'></aside>");
    imitation();
    map();
    $('.tab_item span').on('click', function(){
        var $this = $(this);
        $this.addClass('active').siblings().removeClass('active');
        $('.tab_cont div[data-cont="'+$this.data('item')+'"]').addClass('active').siblings().removeClass('active');
    });
    $('.select_item select').on('change', function(){
        var $this = $(this),
            $thisData = $this.val();
        $('.tab_cont div').each(function(){
            var $el = $(this),
                $elData = $el.data('cont');
            if($thisData == $elData){
                $this.add($el).addClass('active').siblings().removeClass('active');
            }
        });
    });
    $('.miniatures_img img').on('click', function(){
        var $this = $(this),
            $src = $this.attr('src'),
            $data = $this.data('src');
        $this.closest('.product_full-desc').find('.fancybox').attr('href', $data);
        $this.closest('.product_full-desc').find('.prod_main-img').attr('src', $src);
    });
    $(".fancybox").fancybox(
        {
          "padding" : 0,
          "imageScale" : false,
			"zoomOpacity" : false,
			"zoomSpeedIn" : 1000,
			"zoomSpeedOut" : 1000,
			"zoomSpeedChange" : 1000,
			"frameWidth" : 700,
			"frameHeight" : 600,
			"overlayShow" : true,
			"overlayOpacity" : 0.8,
			"hideOnContentClick" :false,
			"centerOnScroll" : false
    });
    $('.position_nav button').on('click', function(){
        $(this).next().stop().slideToggle(500);
    });
    $('.where_buy').click(function() {
        $('body, html').animate({scrollTop: $('.map').offset().top-52}, 500);
    });
});
$(window).on('resize', function(){
    imitation();
    map();
});
function map(){
    var $windW = $(window).width(),
        $windH = $(window).height();
    if($windW <= 768){
        var $mapH = $('#map').height($windH - 100);
    }else if($windW > 768){
        var $mapH = $('#map').height(750);
    }
}
 /* Скрипт для новостей */
function imitation(){
    var $imgH = $('.news_img').height() + 15,
        $imgW = $('.news_img').width(),
        $leftBlockW = $('.full_news .lefter').innerWidth(),
        $imitW = $imgW - $leftBlockW;
    $('.imitation_img').css({height: $imgH + 'px', width: $imitW + 'px'});
}
 /* Скрипт для новостей END */

$(window).scroll(function(){
    if($(window).scrollTop() > ($('.header').offset().top))
        $(".position_nav").addClass('fixed');
    else
        $(".position_nav").removeClass('fixed');
});
if($('.select_item').length > 0){
    $(window).scroll(function(){
        if($(window).scrollTop() > ($('.select_item').offset().top - 54) && $(window).scrollTop() < ($('.comments').offset().top - 54))
            $(".select_item select").addClass('fixed');
        else
            $(".select_item select").removeClass('fixed');
    });
}

$(document).ready(function() {
    var modal_fon = $('.modal_Section, .modal_Fon'),
        modal = $('.modal'),
		body = $('body'),
		close = $('.modal_Close, .modal_Fon'),
        modal = $('.popup');
     $(document).on('click', '.modal', function(event){
         event.preventDefault();
         var div = $(this).attr('href');
		 body.addClass('open');
         modal_fon.fadeIn(400,
             function(){
                 $(div)
                     .css('display', 'block')
                     .animate({opacity: 1}, 400);
         });
     });
     close.click( function(){
            modal
             .animate({opacity: 0}, 400,
                 function(){
                     $(this).css('display', 'none');
                     modal_fon.fadeOut(400);
                 }
             );
            function remove(){
                body.removeClass('open');
            }
			setTimeout(remove, 470);
     });
    $(document).on('submit', '.modal_Form', function(event) {
        if ($(this).valid()) {
            $.ajax({
                url: '/mailer/sendmessage.php',
                beforeSend: function (xhr) {
                            var token = $('meta[name="csrf_token"]').attr('content');

                            if (token) {
                                  return xhr.setRequestHeader('X-XSRF-TOKEN', token);
                            }
                      },
                type: 'POST',
                data: $('.modal_Form').serialize(),
                success: function(data) {
                    modal
                    .animate({opacity: 0}, 200,
                        function(){
                            $(this).css('display', 'none');
                         }
                     );
                    $('.success-block').html(data);
					setTimeout("$('.success-block').fadeIn()", 400);
					setTimeout(function(){
						$('.success-block').fadeOut(400);
						modal_fon.fadeOut(400);
					}, 4000);
                    $('.modal_Form').find('input, textarea').val('');
                    function remove(){
                        body.removeClass('open');
                    }
                    setTimeout(remove, 4070);
                },
                error: function(data) {
					modal
                    .animate({opacity: 0}, 200,
                        function(){
                            $(this).css('display', 'none');
                         }
                     );
                    setTimeout("$('.error-block').fadeIn()", 400);
                    setTimeout(function(){
						$('.error-block').fadeOut(400);
						modal_fon.fadeOut(400);
					},4000);
                    function remove(){
                        body.removeClass('open');
                    }
                    setTimeout(remove, 4070);
                }
            });
        }
        event.preventDefault();
    });
});
$(document).ready(function() {
    google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(59.96747,30.344867),
            zoom: 12,
            zoomControl: false,
            disableDoubleClickZoom: false,
            mapTypeControl: false,
            scaleControl: false,
            scrollwheel: false,
            panControl: false,
            streetViewControl: false,
            draggable : true,
            overviewMapControl: false,
            overviewMapControlOptions: {
                opened: false,
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: undefined,
        }
        var mapElement = document.getElementById('map');
        map = new google.maps.Map(mapElement, mapOptions);
        var locations = [
['FitnessBar.ru', 'Магазин спортивного питания', 'undefined', 'undefined', 'undefined', 59.970311, 30.341470999999956, 'https://mapbuildr.com/assets/img/markers/solid-pin-blue.png'],['РЭМ-СПОРТ', 'Магазин спортивного питания', 'undefined', 'undefined', 'undefined', 59.9710311, 30.30639730000007, 'https://mapbuildr.com/assets/img/markers/solid-pin-blue.png'],['Мускул', 'Магазин спортивного питания', 'undefined', 'undefined', 'undefined', 59.93538700000001, 30.328303000000005, 'https://mapbuildr.com/assets/img/markers/solid-pin-blue.png']
        ];
        for (i = 0; i < locations.length; i++) {
            if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
            if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
            if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
           if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
           if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
            marker = new google.maps.Marker({
                icon: markericon,
                position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                map: map,
                title: locations[i][0],
                desc: description,
                tel: telephone,
                email: email,
                web: web
            });
            link = '';
        }
    }
});
$(function(){
    if (window.location.hash) {
        $('[data-item="'+window.location.hash.substring(1)+'"]').trigger('click');
        $('body, html').animate({scrollTop: $('.tab_item').offset().top-52}, 300);
    }
});

$(document).on('ready', function(){
    $('.box').waypoint(function(dir){
        if(dir === 'down')
            $(this.element)
                .removeClass('fadeOutDown')
                .addClass('fadeInUp');
        else
            $(this.element)
                .removeClass('fadeInUp')
                .addClass('fadeOutDown');
    },{
        offset: '85%'
    });
    $('.box').waypoint(function(dir){
        if(dir === 'down')
            $(this.element)
                .removeClass('fadeInUp')
                .addClass('fadeOutDown');
        else
            $(this.element)
                .removeClass('fadeOutDown')
                .addClass('fadeInUp');
    },{
        offset: 50
    });

    $('.people').waypoint(function(dir){
        if(dir === 'down')
            $(this.element)
                .removeClass('fadeOutDownP')
                .addClass('fadeInUpP');
        else
            $(this.element)
                .removeClass('fadeInUpP')
                .addClass('fadeOutDownP');
    },{
        offset: '75%'
    });
    $('.people').waypoint(function(dir){
        if(dir === 'down')
            $(this.element)
                .removeClass('fadeInUpP')
                .addClass('fadeOutDownP');
        else
            $(this.element)
                .removeClass('fadeOutDownP')
                .addClass('fadeInUpP');
    },{
        offset: -50
    });
    $('.colorBlock.sert.onMain').waypoint(function(dir){
        var $imgW = $('.colorBlock.sert.onMain img').width() / 2,
            $winW = $('.wrapper').width() / 2,
            $raz = $winW - $imgW;
        if(dir === 'down'){
            $('.colorBlock.sert.onMain img').animate({
                left: "0"
            }, 400);
            $('.colorBlock.sert.onMain .righter')
                .removeClass('fadeOutRight')
                .addClass('fadeInRight');
            $('.righter .text-desc')
                .removeClass('fadeOutRight')
                .addClass('fadeInRight');
        }
        else{
            setTimeout(function(){
                $('.colorBlock.sert.onMain img').animate({
                    left: $raz
                }, 400);
            }, 200);
            $('.colorBlock.sert.onMain .righter')
                .removeClass('fadeInRight')
                .addClass('fadeOutRight');
            $('.righter .text-desc')
                .removeClass('fadeInRight')
                .addClass('fadeOutRight');
        }
    },{
        offset: '70%'
    });

    /*$('.main_header').waypoint(function(dir){
        if(dir === 'down'){
            $('body, html').stop().animate({scrollTop: $('.header').offset().top}, 500);
        }else{
            $('body, html').stop().animate({scrollTop: 0}, 500);
        }
    },{
        offset: -10
    });
    $('.header').waypoint(function(dir){
        if(dir === 'up'){
            $('body, html').stop().animate({scrollTop: 0}, 500);
        }
    },{
        offset: 0
    });*/
});
/*
$(document).ready(function(){
    $('div[data-type="background"]').each(function(){
        var $bgobj = $(this);
        $(window).scroll(function() {
            var win = $(window).scrollTop();
            var yPos = -(win / $bgobj.data('speed'));
            var coords = '50% '+ yPos + 'px';
            $bgobj.css({ 'background-position': coords });
        });
    });
});
*/

$(window).load(function() {
    if($('.news').length > 0){
        $('.news .group').masonry({
            itemSelector: '.item_el'
        });
    }
});