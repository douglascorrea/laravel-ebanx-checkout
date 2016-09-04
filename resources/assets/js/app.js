
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

$('.btn-add-to-cart').click((e) => {
    e.preventDefault();
    const elem = e.delegateTarget;
    const l = Ladda.create(e.delegateTarget);
    const addUrl = $(elem).attr('href');
    l.start();
    $.ajax(addUrl)
        .done((resp) => {
            $('#navbar-cart-count').text(resp.qty);
            l.stop();
        });
});
