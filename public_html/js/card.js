$( document ).ready(function() {

      get_card();

    //Добавление в корзину
    $('.button_link.buy').on('click',function(e){
        $.get('/card/'+this.id+'/1', function(data){
            $('.total').html(data.total);
            $('.sum').html(data.sum);
            get_card();
        },'json');
    });

    //Изменение кол-ва товара
    $('.count').on('change',function(e){
        $.get('/card/change/'+this.id+'/'+this.value, function(data){
            $('.total').html(data.total);
            $('.sum').html(data.sum);
        },'json');
    });

    //Удаление элемента из корзины
    $('.remove').on('click',function(e){
        var id = this.id;

        e.preventDefault();
        var params = {};
        params[$('meta[name="csrf-param"]').attr('content')] = $('meta[name="csrf-token"]').attr('content');

        $.post( '/card/'+id, params)
            .done(function( data ) {
                data = JSON.parse(data);
                $('.row_'+id).remove();
                $('.total').html(data.total);
                $('.sum').html(data.sum);
                $('.discount').html(data.discount);
            });
    });

    //чистка корзины
    $('.clear').on('click',function(e){
        e.preventDefault();

        $.get('/card-clear', function(data){
            $('table').remove();
            $('.total').html('0');
            $('.sum').html('0');
            $('.discount').html('0');
        },'json');
    });

    function refreshDeliveryInfo() {
        $.get('/card/info', {}, function(data){
            var $pay_on_delivery = $('.js-pay_on_delivery'),
                $inpPrice = $('input[name="delivery_price"]');

            if (data.delivery.price === false || isNaN(data.delivery.price) || data.delivery.price == null) {
                $inpPrice.val("Не удалось рассчитать стоимость доставки");
            } else if(data.delivery.price == '0') {
                $inpPrice.val("Доставка бесплатная");
            } else {
                $inpPrice.val("Доставка: " + data.delivery.price + " рублей");
            }

            if (data.delivery.can_payment_on_delivery) {
                $pay_on_delivery.show();
            } else {
                $.post( '/order/field', {"name": "pay_on_delivery", "value": 0});
                $('.js-pay-online').prop("checked", true);
                $pay_on_delivery.find('input[name="pay_on_delivery"]').prop("checked", false);
                $pay_on_delivery.hide();
            }
        }, 'json');
    }

    $("#form").change(function(e) {
        var name = e.target.name,
            $input = $('#form').find('[name="' + name + '"]'),
            value = e.target.value,
            params = {};

        params[$('meta[name="csrf-param"]').attr('content')] = $('meta[name="csrf-token"]').attr('content');
        params["name"] = name;
        params["value"] = value;

        $.post('/order/field', params).done(function( data ) {
            data = JSON.parse(data);
            if (data.success) {
                $input.addClass('success').removeClass('error');
                refreshDeliveryInfo();
            } else {
                $input.removeClass('success');
                if ($input.val().length > 0) {
                    $input.addClass('error');
                }
                refreshDeliveryInfo();
            }
        });
    });


    $('#apply_discount').on('click',function(e){
        e.preventDefault();
        var $this = $(this);
        var $codeInput = $('input.code');

        if ($codeInput.val().length > 0 && $codeInput.hasClass('success')) {
            $.get('/card-sum', function (data) {
                $('#total').html(data.total);
                $('#sum').html(data.sum);
                $('#discount').html(data.discount);

                if (data.discount > 0) {
                    $this.hide();
                    $codeInput.attr('readonly', 'readonly');
                }

                $.get('/card-data', function (data) {

                    $.each(data.items, function (id, item) {
                        $('.popup_sum_product_' + id).html(item.price * item.count);
                        $('.discount_' + id).html(item.discount);
                    });
                }, 'json');
            }, 'json');
        }
    });

    $.each($('.cartTable .quantity').find('input'), function( key, value ) {

        var obj = $(value);
        obj.on('change',function(e){
            var id = e.currentTarget.id;
            var count = parseInt(obj.val());

            count = parseInt(count);
            if (isNaN(count)) {
                count = 1;
            }

            count = count > 999 ? 999 : count;
            count = count < 1 ? 1 : count;

            $('.product_count.'+id).val(count);

            $.get('/card/change/'+this.id+'/'+count, function(data) {
                cart_item_refresh(id, count);
            },'json');
        });
    });

    $('.quantity').find('input').on('onchange',function(e){
        var id = this.id;
        var count = parseInt(this.val());
        return;
    });

});

function cart_count(count){
    var el = $('.js-count');
    if (count > 999) {
        el.html('999+');
    } else {
        el.html(count);
    }
    if (count > 0) {
        el.closest('a').addClass('notEmpty');
    } else {
        el.closest('a').removeClass('notEmpty');
        $('.cartModal').fadeOut();
    }
}

/**
 * Обновление корзины в меню
 */
function get_card(){

    $.get('/card-ajax', function(data){
        $('.card').html(data);
        var countEl = $('.js-count');

        $.get('/card-data', function(data){
            if (data.count > 0) {
                countEl.closest('a').addClass('notEmpty');
            } else {
                countEl.closest('a').removeClass('notEmpty');
            }
            cart_count(data.count);
        },'json');
    });
}
