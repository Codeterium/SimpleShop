/**
 * Кастомный скрипт для магазина
 * @author codeterium
 */

/**
 * Добавление товара в корзину по id
 * @param {integer} id
 */
function addToCart(id) {
    $.ajax({
        type: 'POST',
        async: false,
        url: '/cart/add/' + id + '/',
        dataType: 'json',
        success: function (data) {
            if (data['result']) {
                $('#cartCount').html(data['count']);
                $('#addToCart' + id).addClass('d-none');
                $('#removeFromCart' + id).removeClass('d-none');
            }
        },
        error: function (exception) {
            console.log('Exeption:' + exception);
        }
    });
}

/**
 * Удаление товара из корзины по id
 * @param {integer} id
 */
function removeFromCart(id) {
    $.ajax({
        type: 'POST',
        async: false,
        url: '/cart/delete/' + id + '/',
        dataType: 'json',
        success: function (data) {
            if (data['result']) {
                $('#cartCount').html(data['count']);
                $('#addToCart' + id).removeClass('d-none');
                $('#removeFromCart' + id).addClass('d-none');
            }
        },
        error: function (exception) {
            console.log('Exeption:' + exception);
        }
    });
}

/**
 * Оплата заказа
 */
function orderPay(){
    $('#orderPreview').hide('slow');
    $('#orderResult').hide().html('<span class="p-2 my-2 bg-info text-white">Производится оплата...</span>').show('slow');

    setTimeout(function(){
        $.ajax({
            type: 'POST',
            async: false,
            url: '/cart/pay/',
            dataType: 'json',
            success: function (data) {
                if (data['result']) {
                    $('#cartCount').html(data['count']);
                    $('#orderPreview').html('');
                    $('#orderResult').hide().html('<span class="p-2 my-2 bg-success text-white">Ваш заказ успешно оплачен</span><hr><a href="/" title="На главную" class="btn btn-xs btn-info">На главную</a>').show('slow');
                };
                console.log(data);
            },
            error: function (exception) {
                console.log('Exeption:' + exception);

                $('#orderPreview').show('slow')
                $('#orderResult').hide().html('<span class="p-2 my-2 bg-danger text-white">Ошибка</span>').show('slow');
            }
        });
    }, 2000);
}

/**
 * Документ загружен
 */
$(document).ready(function () {
    console.log("ready!");
});