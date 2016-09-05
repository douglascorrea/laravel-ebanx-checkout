
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
$(() => {
    $('a[title]').tooltip();

    $('ul.nav li').on('click', function(e) {
        if ($(this).hasClass('disabled')) {
            e.preventDefault();
            return false;
        }
    });

    $('.btn-add-to-cart').click((e) => {
        fromClickEventToUpdateQtyNavbar(e);
    });

    $('#empty-cart').click((e) => {
        fromClickEventToUpdateQtyNavbar(e); 
    });
    $('.remove-item').click((e) => {
        fromClickToRemoveFromCart(e); 
    });

    $('#update-cart').click((e) => {
        updateCart(e); 
    });

    $('#registration-form #country').change((e) => {

        const country = $(e.delegateTarget).val(); 
        switch(country) {
        case 'br':
            $('.brazil').show();
            break;
        case 'mx':
            $('.brazil').hide();
            break;
        }
        checkRequired();
        removePaymentMethodsAndCards(country);

    });

    $('#registration-form input').keyup(function() {
        checkRequired();
    });

    $('#payment-method-form #payment_method').change((e) => {

        const payment_method = $(e.delegateTarget).val(); 
        if(payment_method == 'credit-card' || payment_method == 'debit-card') {
            $('#credit_card_payment').removeClass('hide');
        } else {
            $('#credit_card_payment').addClass('hide');
        }

    });


    $('#goto_registration').click((e) => {
        const gotoRegistration = $('#checkout_process a[href="#registration"]');
        gotoRegistration.parent().removeClass('disabled');
        gotoRegistration.tab('show');
    });

    $.validate({
        form: '#registration-form, #payment-method-form',
        modules: 'date, brazil, security, logic',
        onSuccess: function($form) {
            if($form.attr('id') == 'payment-method-form') {
                console.log('entrou');
                $('#payment-error').addClass('hide');
                const data = JSON.stringify( $('form').serializeArray());
                const url = '/checkout/payment';
                const l = Ladda.create( document.querySelector('#confirm_payment'));
                l.start();
                $.post(url, {'data': data })
                    .done((resp) => {
                        console.log(resp);
                        l.stop();
                        let no_error = true;
                        if(resp.status == 'ERROR') {
                            $('#payment-error').removeClass('hide');
                            $('#payment-error-message').text(resp.status_message);
                            no_error = false;
                        }
                        if(resp.status == 'SUCCESS' && resp.payment.transaction_status && resp.payment.transaction_status.code == 'NOK'){
                            $('#payment-error').removeClass('hide');
                            $('#payment-error-message').text(resp.payment.transaction_status.description);
                            no_error = false;
                        }

                        if(no_error) {
                            if($('#registration-form #country').val() == 'mx') {
                                $('.final-espanol').removeClass('hide');
                            } else {
                                $('.final-portugues').removeClass('hide');
                            }

                            if(resp.payment.payment_type_code == 'oxxo' || resp.payment.payment_type_code == 'boleto') {
                                $('.boleto-message').removeClass('hide');
                                if(resp.payment.payment_type_code == 'oxxo') {
                                    console.log(resp.payment.oxxo_url);
                                    $('a#url-oxxo').attr('href', resp.payment.oxxo_url);
                                }
                                if(resp.payment.payment_type_code == 'boleto') {
                                    console.log(resp.payment.boleto_url);
                                    $('a#url-boleto').attr('href', resp.payment.boleto_url);
                                }
                            } else {
                                $('.credit-card-message').removeClass('hide');
                            }
                            $('#checkout_process a[href="#order_confirmed"]').parent().removeClass('disabled');
                            $('#checkout_process a[href="#order_confirmed"]').tab('show');
                        }
                    });
                
            }
            if($form.attr('id') == 'registration-form' ) {
                console.log('entrou');
                $('#checkout_process a[href="#payment"]').parent().removeClass('disabled');
                $('#checkout_process a[href="#payment"]').tab('show');
            }

            return false;
        }
    });

});

function removePaymentMethodsAndCards(country){
    const brazil_payment_methods = [
        {name: "Select", key: ""},
        {name: "Boleto", key: "boleto"},
        {name: "Credit Card", key: "credit-card"}
    ];

    const mexico_payment_methods = [
        {name: "Select", key: ""},
        {name: "Oxxo", key: "oxxo"},
        {name: "Credit Card", key: "credit-card"},
        {name: "Debit Card", key: "debit-card"}
    ];

    const brazil_cards = [
        {name: "Select", key: ""},
        {name: "American Express", key: "amex"},
        {name: "Aura", key: "aura"},
        {name: "Diners", key: "diners"},
        {name: "Discover", key: "discover"},
        {name: "Elo", key: "elo"},
        {name: "Hipercard", key: "hipercard"},
        {name: "Mastercard", key: "mastercard"},
        {name: "Visa", key: "visa"}
    ];

    const mexico_cards = [
        {name: "American Express", key: "amex"},
        {name: "Carnet", key: "carnet"},
        {name: "Oxxo", key: "oxxo"},
        {name: "Mastercard", key: "mastercard"},
        {name: "Visa", key: "visa"}
    ];
    $('#payment-method-form #credit_card').html('');
    $('#payment-method-form #payment_method').html('');
    switch(country) {
    case 'br':
        

        brazil_cards.forEach(function(card) {   
            $('#payment-method-form #credit_card')
                .append($("<option></option>")
                        .attr("value",card.key)
                        .text(card.name)); 
        });

        brazil_payment_methods.forEach(function(card) {   
            $('#payment-method-form #payment_method')
                .append($("<option></option>")
                        .attr("value",card.key)
                        .text(card.name)); 
        });

        break;
    case 'mx':
        mexico_cards.forEach(function(card) {   
            $('#payment-method-form #credit_card')
                .append($("<option></option>")
                        .attr("value",card.key)
                        .text(card.name)); 
        });

        mexico_payment_methods.forEach(function(card) {   
            $('#payment-method-form #payment_method')
                .append($("<option></option>")
                        .attr("value",card.key)
                        .text(card.name)); 
        });


        break;


    }
}


function checkRequired() {
    let empty = false;
    $('#registration-form input').each(function() {
        if ($(this).val() == '') {
            if(!($('#registration-form #country').val() == 'mx' && $(this).parents('.form-group').hasClass('brazil'))) {
                empty = true;
            }
        }
    });

    if (empty) {
        $('#goto_payment').attr('disabled', 'disabled'); 
    } else {
        $('#goto_payment').removeAttr('disabled'); 
    }

}

function updateCart(e) {
    const url = getUrlFromEventClick(e);
    const items = getCartData();
    const l = Ladda.create(e.delegateTarget);
    l.start();
    $.post(url, { 'items' : items})
        .done((resp) => {
            l.stop();
            $('#cart-total').text(resp.total); 
        });
}

function getCartData() {
    let items = $('.cart-item');
    items = $.makeArray(items);
    return items.reduce((acc, elem) => {
        const cartItem = {
            rowId: $(elem).attr('id'),
            qty: $(elem).find('.cart-qty').val()
        };
        acc.push(cartItem);
        return acc;
    }, []);

}

function fromClickToRemoveFromCart(e) {
    const url = getUrlFromEventClick(e);
    const rowId = url.split('/').pop();
    fromClickEventToAjax(e, (resp) => {
        $('#' + rowId).remove();
        $('#cart-total').text(resp.total); 
    });
}

function updateNavbarQtyFromCartResponse(resp) {
    const productsOnCart = _.values(resp);
    const qty = productsOnCart.reduce((acc, elem) => {
        return acc + elem.qty;
    },0);
    $('#navbar-cart-count').text(qty);
}

function fromClickEventToAjax(e, ajaxDone, useLadda = true) {
    e.preventDefault();
    const url = getUrlFromEventClick(e);
    
    const l = Ladda.create(e.delegateTarget);
    if(useLadda) {
        l.start();
    }
    $.ajax(url)
        .done((resp) => {
            if(useLadda) l.stop();
            ajaxDone(resp); 
        });
}

function fromClickEventToUpdateQtyNavbar(e) {
    fromClickEventToAjax(e, (resp) => {
        updateNavbarQtyFromCartResponse(resp);
    });
}

function getUrlFromEventClick(e) {
    const elem = e.delegateTarget;
    const url = $(elem).attr('href');
    return url; 
}
