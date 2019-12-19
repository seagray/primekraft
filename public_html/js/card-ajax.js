//-1 товар
$('.fa.fa-minus.minus.js-minus').on('click', function (e) {

    var id = this.id;
    var count = parseInt($('.product_count.' + id).val()) - 1;

    if (count < 1) {
        return;
    }

    // if(count < 0){
    //     return false;
    // }

    $('.product_count.' + id).val(count);


    $.get('/card/change/' + this.id + '/' + count, function (data) {
        cart_item_refresh(id, count);
    }, 'json');
});

//+1 товар
$('.fa.fa-plus.plus.js-plus').on('click', function (e) {

    var id = this.id;
    var count = parseInt($('.product_count.' + id).val()) + 1;

    if (count > 999) {
        return;
    }

    $('.product_count.' + id).val(count);

    $.get('/card/change/' + this.id + '/' + count, function (data) {
        cart_item_refresh(id, count);
    }, 'json');
});

$('.cartModal .product_count').on('change', function () {
    "use strict";
    var id = this.id,
        count = parseInt($('.product_count.' + id).val());
    count = count > 999 ? 999 : count;
    count = count < 1 ? 1 : count;

    $('.product_count.' + id).val(count);

    $.get('/card/change/' + this.id + '/' + count, function (data) {
        cart_item_refresh(id, count);
    }, 'json');
});

function cart_item_refresh(item_id, count) {
    if (count == 0) {
        $('.card,.cart').find('[data-item="' + item_id + '"]').remove();
    }
    $.get('/card-data', function (data) {
        var sum = parseFloat($('.price_' + item_id).html()) * parseInt(count);
        var discount = 0;

        if (data.items[item_id] && (data.items[item_id]['discount'] > 0)) {
            sum = sum - data.items[item_id]['discount'];
            discount = data.items[item_id]['discount'];
        }
        cart_count(data.count);

        $('.count_popup').html(data.count);
        $('.popup_sum').html(data.sum);
        $('#total').html(data.total);
        $('#sum').html(data.sum);
        $('.popup_sum_product_' + item_id).html(sum);
        $('.discount_' + item_id).html(discount);
        $('#discount').html(data.discount);
    }, 'json');
}

$('.js-del').on('click', function (e) {
    e.preventDefault();

    var id = $(this).data('id');

    $.get('/card/' + id, function (data) {
        cart_item_refresh(id, 0);
        if ($('.product_count').length == 0) {
            document.location.reload();
        }
    });
});
