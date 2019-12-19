// sharing
var VK = {}, ODKL = {};
VK.Share = {};

$(function () {
    (function () {
        // sticky sidebar articles
        var isMob = false;
        makeAnchorLinks();

        if($('.article-nav').length){
            var stop;
            if($('.news.readAlso').length){
                stop = $(document).height() - $('.news.readAlso').offset().top + 100;
            }else if($('.colorBlock.map').length){
                stop = $(document).height() - $('.colorBlock.map').offset().top + 120;
            }else{
                return false;
            }
            stick();
            $(window).on('resize', function () {
                if($(window).width() <= 767){
                    isMob = true;
                }
                if($(window).width() > 767){
                    if(isMob){
                        isMob = false;
                        $('.article-nav').unstick();
                        stick();
                    }
                }
            });
        }

        function stick(){
            $('.article-nav').sticky({
                topSpacing: 54,
                bottomSpacing: stop
            });
        }

        // генерация ссылок на статье в сайдбаре
        function makeAnchorLinks(){
            "use strict";
            var $headers = $('.full_news').find('.news_text').find('h2'),
                $menu =$('#articleMenu').find('ul');

            $headers.each(function (n) {
                $(this).attr('id',n);
                $menu.append('<li><a href="#'+n+'">'+$(this).html()+'</a></li>')

            })
            
        }
        // function offsetAnchor() {
        //     if (location.hash.length !== 0) {
        //         window.scrollTo(window.scrollX, window.scrollY - 80);
        //     }
        // }

        $(document).on('click', 'a[href^="#"]', function(event) {
            event.preventDefault();
            var top = $($(this).attr('href')).offset().top;
            $('body,html').animate({scrollTop: top-80}, 100);
        });
    })();

    //  ul padded from image
    (function () {
        "use strict";
        var $img = $('.full_news').find('.news_img'),
            $firstList = $('.full_news').find('.news_text').find('ul').eq(0),
            $firstQuote = $('.full_news').find('.news_text').find('p.atText').eq(0),
            active = $('.full_news').length;

        var rtime;
        var timeout = false;
        var delta = 200;
        $(window).resize(function() {
            rtime = new Date();
            if (timeout === false) {
                timeout = true;
                setTimeout(resizeend, delta);
            }
        });
        function resizeend() {
            if (new Date() - rtime < delta) {
                setTimeout(resizeend, delta);
            } else {
                timeout = false;
                if(active){
                    onEdge();
                }
            }
        }

        function onEdge(){
            if($firstList){
                var $firstLi = $firstList.children('li:first-child'),
                    imgEnd = parseInt($img.css('height'))+$img.offset().top;

                if( $firstLi.offset().top <= imgEnd && parseInt($firstLi.css('height'))+$firstLi.offset().top > imgEnd ){
                    $firstList.addClass('edge');
                }else{
                    $firstList.removeClass('edge');
                }
            }
        }
        $(document).ready(function () {
            try {
                if ($firstList.offset().top <= parseInt($img.css('height')) + $img.offset().top) {
                    $firstList.addClass('padded');
                }
                if ($firstQuote.offset().top <= parseInt($img.css('height')) + $img.offset().top) {
                    $firstQuote.addClass('padded');
                }
                if(active){
                    onEdge();
                }
            } catch (e) {}
        });
        if($('.full_news').find('table').length){
            $('.full_news').find('table').wrap("<div class='scroller'></div>");
        }
    })();

    // sharing again
    (function () {
        "use strict";
        var index = "1",
            uid = "mainpage",
            url = window.location.href.replace(window.location.hash, "");
            // url = "http://www.yandex.ru";
        
        $("body").append("<script src='https://vk.com/share.php?act=count&index=" + index + "&url=" + url + "'></script>");
        $.getJSON('https://connect.ok.ru/dk?st.cmd=extLike&uid=' + uid  + '&ref=' + encodeURIComponent(url) + '&callback=?', function(e) {});

        VK.Share.count = function(index, count) {
            $('.sharing').find('.vk').find('span').text(count);
        }
        ODKL.updateCount = function(uid, count) {
            $('.sharing').find('.ok').find('span').text(count);
        }
        $.get("https://graph.facebook.com/" + url, {}, function(data) {
            $('.sharing').find('.fb').find('span').text(data.share.share_count);
        }, 'json');

    })();

    $('.js-submit').on('click', function (e) {
        e.preventDefault();
        $(this).closest('form').submit();
    });

    $('#form').on('submit', function (e) {
        "use strict";
        var $this = $(this),
            $check = $this.find('input.sign'),
            $cont = $this.find('.check-services');
        if ($check.is(':checked')) {
            $cont.removeClass('checkError');
        } else {
            e.preventDefault();
            $cont.addClass('checkError');
        }
    });
    $('input[class="sign"]').on('change', function () {
        "use strict";
        if ($(this).is(':checked')) {
            $('.check-services').removeClass('checkError');
        }
    });

    if ($('.main_header')) {
        $('body').on('click', '.notEmpty', function () {
            "use strict";
            var $this = $(this),
                $topThis = $this.offset().top;
            $('body, html').animate({scrollTop: $topThis}, 500);
        });
    }

    /* cart	*/
    $('.nav .last').on('click', function (e) {
        e.preventDefault();
    });
    if ($('.countTov').find('i').html() === '0' || $('.countTov').find('i').html() === '') {
        $('.nav a.last, .cartToMobile').removeClass('notEmpty');
    } else {
        $('.nav a.last, .cartToMobile').addClass('notEmpty');
    }
    if ($('.nav a.last').hasClass('active')) {
    } else {
        $('body').on('click', '.notEmpty, .cartModal .close, .continue, .cartModal .button_link--default a', function (e) {
            $('.cartModal').fadeToggle(300);
        });
    }
    /*if(window.location.pathname == '/card'){}else{
     $('body').on('click', '.notEmpty, .cartModal .close, .continue, .cartModal .button_link--default a', function(e){
     $('.cartModal').fadeToggle(300);
     });
     }*/
    function footerDown() {
        "use strict";
        var $footer = $('.page_cart .footer'),
            $footerH = $footer.outerHeight();
        $('.footer_down-wrap').css({'padding-bottom': $footerH + 'px'});
        $footer.css({'margin-top': -$footerH + 'px'});
    }

    $(window).on('resize', function () {
        footerDown();
    });
    footerDown();
    /* cart end	*/
    if ($('.main_header').length > 0) {
        /*setTimeout(function(){
         $('.main_header--fon').css({transform: 'scale(1)'});
         }, 100);*/
        /*$(window).scroll(function(){
         if($(window).scrollTop() > 1)
         $('.main_header--fon').css({transform: 'scale(1.1)'});
         else
         $('.main_header--fon').css({transform: 'scale(1)'});
         });*/
        $('.main_header-slider').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 200,
            fade: false,
            autoplay: true,
            autoplaySpeed: 50000,
            cssEase: 'linear'
        });
    }
    $('.js-select-loc').on('change', function () {
        window.location.href = this.value;
    });

    $('.openSub').on('click', function () {
        $('.openSub').not(this).closest('li').removeClass("active");
        $('.openSub').not(this).siblings('ul').slideUp(500);
        $(this).closest('li').toggleClass("active");
        $(this).siblings('ul').stop().slideToggle(500);
    });
    $('.sidebar_nav li.active').children('ul').addClass('active');
    $('.objects').on('click', function () {
        $(this).toggleClass('active');
        $(this).closest('.addr_on_map').toggleClass('active');
    });
    if ($(window).width() <= 768) {
        $('.objects').removeClass('active');
        $('.addr_on_map').removeClass('active');
    }

    $('.modal_Form').each(function(){
        $(this).validate({
            rules: {
                phone: "required",
                message: "required"
            },
            messages: {
                phone: "Обязательное поле.",
                message: "Обязательное поле."
            }
        });
    });

    $('.static_Form').each(function() {
        $(this).validate({
            rules: {
                phone: "required",
                message: "required"
            },
            messages: {
                phone: "Обязательное поле.",
                message: "Обязательное поле."
            }
        });
    });

    $('.aggregator-vacancy').each(function(){
        "use strict";
        $(this).validate({
            rules: {
                name: "required",
                phone: "required",
                email: "required",
                password: "required"
            },
            messages: {
                name: "Обязательное поле 'ФИО'.",
                phone: "Обязательное поле 'Телефон'.",
                email: "Обязательное поле 'E-mail'.",
                password: "Обязательное поле 'Пароль'."
            }
        });
    });

    /*
     $('.button_link').each(function(){
     $(this).append('<i></i>');
     });*/
    /*$('.nav a').each(function(){
     $(this).append('<i></i>');
     });
     */
    $('.full_news .news_text').prepend("<aside class='imitation_img'></aside>");
    imitation();
    map();
    $('.tab_item span').on('click', function () {
        var $this = $(this);
        $this.addClass('active').siblings().removeClass('active');
        $('.tab_cont div[data-cont="' + $this.data('item') + '"]').addClass('active').siblings().removeClass('active');
    });
    $('.select_item select').on('change', function () {
        var $this = $(this),
            $thisData = $this.val();
        $('.tab_cont div').each(function () {
            var $el = $(this),
                $elData = $el.data('cont');
            if ($thisData == $elData) {
                $this.add($el).addClass('active').siblings().removeClass('active');
            }
        });
    });
    $('.miniatures_img img').on('click', function () {
        var $this = $(this),
            $src = $this.attr('src'),
            $data = $this.data('src');
        $this.closest('.product_full-desc').find('.fancybox').attr('href', $data);
        $this.closest('.product_full-desc').find('.prod_main-img').attr('src', $src);
    });
    $(".fancybox").fancybox(
        {
            "padding": 0,
            "imageScale": false,
            "zoomOpacity": false,
            "zoomSpeedIn": 1000,
            "zoomSpeedOut": 1000,
            "zoomSpeedChange": 1000,
            "frameWidth": 700,
            "frameHeight": 600,
            "overlayShow": true,
            "overlayOpacity": 0.8,
            "hideOnContentClick": false,
            "centerOnScroll": false
        });
    $('.position_nav button').on('click', function () {
        $(this).next().stop().slideToggle(500);
    });
    $(document).click(function(event) {
        if(!$(event.target).closest('.position_nav button').length) {
            if($('.position_nav button').is(":visible")) {
                $('.nav').slideUp(400);
            }
        }
    });
    // scroll To map hide
    // $('.where_buy, .js-office').click(function () {
    //     if(location.pathname != '/card') {
    //         $('body, html').animate({scrollTop: $('.map').offset().top - 52}, 500);
    //         $('.nav').slideUp(400);
    //     } else {
    //         location.href = "/contacts#map";
    //     }
    // });

    $('.formLog-select').find('option[value="' + location.pathname + '"]').attr('selected', 'selected');

});
$(window).on('resize', function () {
    imitation();
    map();
    if ($(window).width() <= 768) {
        $('.objects').removeClass('active');
        $('.addr_on_map').removeClass('active');
    }
});
function map() {
    var $windW = $(window).width(),
        $windH = $(window).height();

    if ($windW <= 768) {
        $('#map').height($windH - 100);
    } else if ($windW > 768) {
        $('#map').height(750);
    }
}
/* Скрипт для новостей */
function imitation() {
    var $img = $('.news_img'),
        $imgH = $img.height() + 15,
        $imgW = $img.width(),
        $leftBlockW = $('.full_news .lefter').innerWidth(),
        $imitW = $imgW - $leftBlockW;
    $('.imitation_img').css({height: $imgH + 'px', width: $imitW + 'px'});
}
/* Скрипт для новостей END */

$(window).scroll(function () {
    if ($(window).scrollTop() > ($('.header').offset().top))
        $(".position_nav").addClass('fixed');
    else
        $(".position_nav").removeClass('fixed');
});
if ($('.select_item').length > 0) {
    $(window).scroll(function () {
        if ($(window).scrollTop() > ($('.select_item').offset().top - 54) && $(window).scrollTop() < ($('.colorBlock.map').offset().top - 54))
            $(".select_item select").addClass('fixed');
        else
            $(".select_item select").removeClass('fixed');
    });
}

$(document).ready(function () {
    $(".modal").on('click', function () {
        $('.modal_Form').find('[name="ya-target"]').val($(this).data('ya-target'));
    }).magnificPopup({type: "inline", preloader: !1});
    $('.modal_Form, .static_Form').ajaxForm();
    $('.js-ajax-form').ajaxForm();

    $('.js-ajax-form').on('submit', function(){
        "use strict";
        if($(this).has('data-content') || $(this).has('data-title')){
            $('.success-block').html('<h4>' + $(this).data('title') + '</h4><div>' + $(this).data('content') + '</div>');
        }
    });

    $('.addPromocode input').on('focus', function(){
        $(this).select();
    });
});

var gmap;

$(document).ready(function () {
    var $ctrl = $('#map_controls'),
        $c = $ctrl.find('[name="city"]'),
        $d = $ctrl.find('[name="area"]'),
        $s = $ctrl.find('[name="metro"]'),
        cities,
        $tmp = $('#shop-tpl'),
        $shopTpl = $tmp.clone();

    $tmp.remove();

    function refresh_shop_selector(shops) {
        $('#objects_count').html(shops.length);
        var cont = $('#objects_block');
        cont.empty();
        $(shops).each(function (i, el) {
            var $el = $shopTpl.clone(),
                $info;
            $el.attr('id', null);
            $el.find('.object_title').html(el.name);
            $el.find('.object_desc').html(el.description);
            $el.find('.object_addr span').html(el.address);
            $el.find('.object_tel').html(el.phone);
            $el.find('.object_tel').attr('href', 'tel:' + el.phone);
            $el.find('.object_site').html(el.url.host);
            $el.find('.object_site').attr('href', el.website);
            $el.data('latitude', el.latitude);
            $el.data('longitude', el.longitude);
            $el.show();
            cont.append($el);
        });
    }

    function create_map_ballons(shops) {
        $(shops).each(function (i, el) {
            var $info = el.name + '<br>' + el.description + '<br>' + el.address + '<br>' + el.phone + '<br>' + '<a href="' + el.website + '">' + el.website + '</a>';
            var marker = new google.maps.Marker({
                icon: '/img/mark.png',
                position: new google.maps.LatLng(el.latitude, el.longitude),
                map: gmap,
                title: el.name,
                desc: el.description,
                tel: el.phone,
                // email: el.email,
                web: el.website
            });

            var infowindow = new google.maps.InfoWindow();

            google.maps.event.addListener(marker, 'click', function () {
                for (var m in gmap.windows) {
                    if (gmap.windows.hasOwnProperty(m)) {
                        gmap.windows[m].close();
                    }
                }
                infowindow.open(map, this);

            });

            google.maps.event.addListener(gmap, 'mousedown', function (event) {
                this.setOptions({'scrollwheel': true});
            });

            infowindow.setContent($info);

            gmap.windows.push(infowindow);
        });
    }

    function build_selectors(ind) {
        var $or = $('.map_or');

        if (ind == '-1') {
            load_shops(refresh_shop_selector);
            $d.empty();
            $s.empty();

            $d.hide();
            $s.hide();
            $or.hide();

            gmap.jumpTo(53.99743212637354, 57.83338759155275, 5);
            return;
        } else {
            load_shops(refresh_shop_selector, cities[ind].id);
        }

        $d.empty();
        $s.empty();

        $d.hide();
        $s.hide();
        $or.hide();

        if (cities[ind].districts.length) {
            $d.show();
        }

        if (cities[ind].subways.length) {
            $s.show();
        }

        if (cities[ind].districts.length && cities[ind].subways.length){
            $or.show();
        }

        $d.append('<option value="-1">Район</option>');
        $(cities[ind].districts).each(function (i, el) {
            $d.append('<option value="' + i + '" data-latitude="' + el.latitude + '" data-longitude="' + el.longitude + '" data-zoom="13">' + el.name + '</option>');
        });

        $s.append('<option value="-1">Станция метро</option>');
        $(cities[ind].subways).each(function (i, el) {
            $s.append('<option value="' + i + '" data-latitude="' + el.latitude + '" data-longitude="' + el.longitude + '" data-id="' + el.id + '" data-zoom="14">' + el.name + '</option>');
        });
    }

    function load_shops(callback, id) {
        var data = {};
        if (typeof id != 'undefined') {
            data['city'] = id;
        }
        $.ajax({
            url: $('#map').data('url'),
            data: data,
            success: function (response) {
                callback(response);
            },
            dataType: 'json'
        });
    }


    window.addEventListener('load', function () {
        $.get($ctrl.data('url'), function (response) {
            cities = response;
            $c.empty();

            $c.append('<option value="-1"  data-latitude="" data-longitude="" data-zoom="5">Выберете город</option>');
            $(response).each(function (i, el) {
                $c.append('<option value="' + i + '" data-latitude="' + el.latitude + '" data-longitude="' + el.longitude + '" data-zoom="12">' + el.name + '</option>');
            });

            $c.val(-1);


            load_shops(create_map_ballons);
            build_selectors(-1);
        }, 'json');
    });

    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(53.99743212637354, 57.83338759155275),//Центр России
            zoom: 5,
            zoomControl: true,
            disableDoubleClickZoom: false,
            mapTypeControl: false,
            scaleControl: false,
            scrollwheel: false,
            panControl: false,
            streetViewControl: false,
            draggable: true,
            overviewMapControl: false,
            overviewMapControlOptions: {
                opened: false
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
                {"featureType": "all", "elementType": "all", "stylers": [{"saturation": -100}, {"gamma": 1}]},
                {"featureType": "all", "elementType": "labels.text.stroke", "stylers": [{"visibility": "off"}]},
                {
                    "featureType": "administrative.neighborhood",
                    "elementType": "labels.text.fill",
                    "stylers": [{"color": "#333333"}]
                },
                {"featureType": "poi.business", "elementType": "labels.text", "stylers": [{"visibility": "off"}]},
                {"featureType": "poi.business", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]},
                {
                    "featureType": "poi.place_of_worship",
                    "elementType": "labels.text",
                    "stylers": [{"visibility": "off"}]
                },
                {
                    "featureType": "poi.place_of_worship",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                },
                {"featureType": "road", "elementType": "geometry", "stylers": [{"visibility": "simplified"}]},
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{"visibility": "on"}, {"color": "#fdc513"}]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{"visibility": "on"}, {"color": "#000000"}]
                },
                {"featureType": "road.arterial", "elementType": "geometry.fill", "stylers": [{"color": "#fdc513"}]},
                {
                    "featureType": "road.local",
                    "elementType": "labels.text",
                    "stylers": [{"color": "#333333"}, {"weight": 0.5}]
                },
                {
                    "featureType": "transit.station",
                    "elementType": "labels.icon",
                    "stylers": [{"saturation": 50}, {"gamma": 1}]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [{"visibility": "on"}, {"hue": "#50a5d1"}, {"saturation": 50}]
                }
            ]
        };
        var mapElement = document.getElementById('map');
        gmap = new google.maps.Map(mapElement, mapOptions);
        gmap.windows = [];
        gmap.jumpTo = function (lat, long, zoom) {
            this.panTo(new google.maps.LatLng(lat, long));
            this.setZoom(zoom);
        };
        $('#objects_block').on('click', '.object_addr', function (e) {
            e.preventDefault();
            var $el = $(this).closest('figure');
            gmap.jumpTo($el.data('latitude'), $el.data('longitude'), 16);
        });
        $ctrl.on('change', 'select', function () {
            var $el = $(this).find('option:selected');
            if ($el.val() != -1) {
                gmap.jumpTo($el.data('latitude'), $el.data('longitude'), $el.data('zoom'));
            }
        });

        $ctrl.on('change', 'select[name="area"]', function () {
            $ctrl.find('select[name="metro"]').val(-1);
        });

        $ctrl.on('change', 'select[name="metro"]', function () {
            $ctrl.find('select[name="area"]').val(-1);
        });

        $ctrl.on('change', 'select[name="city"]', function () {
            build_selectors($(this).val());
        });
        var $office = $('.js-office'),
            $office_info = $('.footer_addr');

        var marker = new google.maps.Marker({
            icon: '/img/office.png',
            position: new google.maps.LatLng($office.data('latitude'), $office.data('longitude')),
            map: gmap,
            title: $office_info.find('h5').html(),
            tel: $office_info.find('.contact_tel').html(),
            email: $office_info.find('.contact_email').html()
        });

        // comment script if map is hidden
        // $office.on('click', function () {
        //     gmap.jumpTo($(this).data('latitude'), $(this).data('longitude'), 16);
        // });
    }
});
$(function () {
    if (window.location.hash && window.location.hash != "#map") {
        try{
            $('[data-item="' + window.location.hash.substring(1) + '"]').trigger('click');
            $('body, html').animate({scrollTop: $('.tab_item').offset().top - 52}, 300);
        } catch(err){}
    }
});



$(document).on('ready', function () {
    $('.partners').find('figure').waypoint(function (dir) {
        if (dir === 'down')
            $(this.element)
                .removeClass('fadeOut')
                .addClass('fadeIn');
        else
            $(this.element)
                .removeClass('fadeIn')
                .addClass('fadeOut');
    }, {
        offset: '85%'
    });
    $('.box').waypoint(function (dir) {
        if (dir === 'down')
            $(this.element)
                .removeClass('fadeOutDown')
                .addClass('fadeInUp');
        else
            $(this.element)
                .removeClass('fadeInUp')
                .addClass('fadeOutDown');
    }, {
        offset: '85%'
    });
    $('.box').waypoint(function (dir) {
        if (dir === 'down')
            $(this.element)
                .removeClass('fadeInUp')
                .addClass('fadeOutDown');
        else
            $(this.element)
                .removeClass('fadeOutDown')
                .addClass('fadeInUp');
    }, {
        offset: 50
    });

    $('.people').waypoint(function (dir) {
        if (dir === 'down')
            $(this.element)
                .removeClass('fadeOutDownP')
                .addClass('fadeInUpP');
        else
            $(this.element)
                .removeClass('fadeInUpP')
                .addClass('fadeOutDownP');
    }, {
        offset: '75%'
    });
    $('.people').waypoint(function (dir) {
        if (dir === 'down')
            $(this.element)
                .removeClass('fadeInUpP')
                .addClass('fadeOutDownP');
        else
            $(this.element)
                .removeClass('fadeOutDownP')
                .addClass('fadeInUpP');
    }, {
        offset: -50
    });
    $('.colorBlock.sert.onMain').waypoint(function (dir) {
        var $imgW = $('.colorBlock.sert.onMain img').width() / 2,
            $winW = $('.wrapper').width() / 2,
            $raz = $winW - $imgW;
        if (dir === 'down') {
            $('.colorBlock.sert.onMain img').animate({
                left: "50"
            }, 400);
            $('.colorBlock.sert.onMain .righter')
                .removeClass('fadeOutRight')
                .addClass('fadeInRight');
            $('.righter .text-desc')
                .removeClass('fadeOutRight')
                .addClass('fadeInRight');
        }
        else {
            setTimeout(function () {
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
    }, {
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

$(window).load(function () {
    if ($('.news').length > 0) {
        $('.news .group').masonry({
            itemSelector: '.item_el'
        });
        $('.el_news').waypoint(function (dir) {
            if (dir === 'down')
                $(this.element)
                    .removeClass('fadeOutDownP')
                    .addClass('fadeInUpP');
            else
                $(this.element)
                    .removeClass('fadeInUpP')
                    .addClass('fadeOutDownP');
        }, {
            offset: '90%'
        });
    }
});
// $(function(){
//     window.setTimeout(function(){
//
//     }, 100);
// });
$(document).ready(function () {
    $(".section_Input input[type='tel']").inputmask("+7(999)999-99-99");

    $('.js-push-form').on('click', function (e) {
        e.preventDefault();
        var $this = $(this),
            $parent = $this.closest('.formLog');
        if ($parent.hasClass('active')) {
            $parent.animate({
                opacity: 0,
                left: '-1000px'
            }, 500);
            $parent.siblings().animate({
                left: 0,
                opacity: 1
            }, 500);
            setTimeout(function () {
                $parent.removeClass('active').siblings().fadeIn(500);
            }, 500);
            setTimeout(function () {
                $parent.siblings().addClass('active');
            }, 1000);
        }
    });

    /*$('.lk-nav a').on('click', function(e){
     e.preventDefault();
     var $this = $(this),
     $pos = $this.position(),
     $link = $this.attr('href');
     console.log($link);
     $this.addClass('active').siblings().removeClass('active');
     $('.select_item--lk').animate({
     top: $pos.top
     }, 200);
     if($this.data('lk') === 'lk') {
     function loadContent(urlload, cont) {
     $.ajax({
     url: urlload,
     cache: false,
     beforeSend: function() { $(cont).html('Loading content, please wait...'); },
     success: function(html) { $(cont).hide(); $(cont).html(html); $(cont).show('slow'); }
     });
     }
     loadContent($link, '.lk-content');
     }
     });*/
});

/*
 function browse() {
 var uploader = new plupload.Uploader({
 browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
 url: 'upload.php',
 filters : [
 {title : "Image files", extensions : "jpg,gif,png"},
 {title : "Zip files", extensions : "zip,avi"}
 ],
 rename: false,
 sortable: false,
 dragdrop: false,
 max_file_size : '10mb'
 });
 uploader.init();
 uploader.bind('FilesAdded', function (up, files) {
 var html = '',
 file = document.getElementById('filelist'),
 el = document.querySelector('.ko2');
 plupload.each(files, function (file) {
 html += '<li data-elem="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <span class="removeFile" data-remove="' + file.id + '"><i class="fa fa-times" aria-hidden="true"></i></span></li>';
 });
 file.innerHTML += html;
 lenEl = file.getElementsByTagName('li').length;
 recount();
 if(lenEl >= 1) {
 el.classList.add('active');
 }
 });
 uploader.bind('Error', function (up, err) {
 document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
 });
 $('body').on('click', '.removeFile', function(){
 $('#filelist li[data-elem="'+ $(this).data('remove') +'"]').detach();
 lenEl = $('#filelist').find('li').length;
 recount();
 if($('#filelist').find('li').length === 0 && !check_site($('.site-information'))) $('.ko2').removeClass('active')
 });
 }
 browse();
 */

/* INPUT FILE */
$(document).ready(function () {
    $('.file').change(function () {
        var $this = $(this),
            $parent = $this.closest('.addFile'),
            $someUp = $this.next('.inputFontStyle'),
            $nameFile = $parent.find('.namefile'),
            $sector = $parent.find('.namefile span'),
            $del = $parent.find('.namefile i'),
            $urlFile = $parent.find('.inputInputStyle');
        $this.each(function () {
            var name = this.value;
            reWin = /.*\\(.*)/;
            var fileTitle = name.replace(reWin, "$1");
            reUnix = /.*\/(.*)/;
            fileTitle = fileTitle.replace(reUnix, "$1");
            $nameFile.show().children('span').html(fileTitle);
            $someUp.hide();
            if ($sector.html() === '') {
                $nameFile.hide();
                $someUp.show();
                $urlFile.val('');
            }
            $del.on('click', function () {
                $sector.html('');
                $nameFile.hide();
                $someUp.show();
                $urlFile.val('');
            });
        });
    });
});
/* INPUT FILE END*/
$(function () {
    "use strict";
    if ($('.lk_radio--group input.period-time').attr('checked') == 'checked') {
        $('.period').show();
    }

    $('.lk_radio--group input').on('change', function () {
        var $this = $(this);
        if ($this.hasClass('period-time')) {
            $('.period').show();
        } else {
            $('.period').hide();
        }
    });
});

$('.tabs span').on('click', function () {
    var $this = $(this),
        $attr = $this.data('tab'),
        $parent = $this.closest('.tabLogin'),
        $cont = $('.tabsCont');
    if ($this.hasClass('active')) {
        $parent.removeClass('active');
        $this.removeClass('active');
        $cont.find('.tabForm[data-cont=' + $attr + ']').slideUp(300);
    } else {
        $parent.addClass('active');
        $this.addClass('active').siblings().removeClass('active');
        $cont.find('.tabForm').stop().slideUp(300);
        $cont.find('.tabForm[data-cont=' + $attr + ']').stop().slideDown(300);
    }
});
//console.log($elemWidth);
/* Анимация корзины */
document.addEventListener("DOMContentLoaded", animCart);

function animCart() {
    "use strict";
    var $el = document.querySelectorAll('.buy');
    // var $animate = false;
    // console.log($animate);
    for (var i = 0; i < $el.length; i++) {
        var $elem = $el[i];
        $elem.onclick = function () {
            var $elem = this;
            if (window.innerWidth > 640) {
                // Вычисление ширины/высоты и позиции эл.
                var $elemTop = $elem.getBoundingClientRect().top,
                    $elemLeft = $elem.getBoundingClientRect().left,
                    $elemWidth = $elem.offsetWidth,
                    $elemHight = $elem.offsetHeight;
                // Создание нового элемента
                var $ghostEl = document.createElement('div'),
                    $style = $ghostEl.style;
                $style.width = $elemWidth + 'px';
                $style.height = $elemHight + 'px';
                $style.top = $elemTop + 'px';
                $style.left = $elemLeft + 'px';
                $ghostEl.className = 'ghostElement';
                document.body.appendChild($ghostEl);
                // Позиция корзины
                var $cart = document.querySelector('.countTov'),
                    $cartTop = $cart.getBoundingClientRect().top,
                    $cartLeft = $cart.getBoundingClientRect().left,
                    $cartWidth = $cart.offsetWidth,
                    $cartHight = $cart.offsetHeight;
                // if($cart.style.display != 'none') $animate = true;
                // console.log($animate);
                // Анимация элемента
                $($ghostEl).animate({
                    left: $cartLeft + 'px',
                    top: $cartTop + 'px',
                    opacity: .25,
                    //'border-radius': '50%',
                    width: $cartWidth + 'px',
                    height: $cartHight + 'px'
                }, 500);
                setTimeout(function () {
                    document.body.removeChild($ghostEl);
                    $cart.classList.add("shadow");
                }, 500);
                setTimeout(function () {
                    $cart.classList.remove("shadow");
                }, 1300);
            }
        };
    }
}
/* Анимация корзины end*/
$(document).on('ready', function () {
    "use strict";
    $('.period input[type="text"]').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD',
            daysOfWeek: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            firstDay: 1
        }
    });
});

$(function(){
    $('.product-image-main').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.product-images-nav'
    }).init(function(){
        $('.product-images .product-image-main div').show();
        $('.product-images .product-images-nav div').show();
    });

    $('.product-images-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        centerPadding: '0px',
        asNavFor: '.product-image-main',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
    });

});