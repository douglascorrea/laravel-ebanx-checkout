
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

$('.btn-add-to-cart').click((e) => {
    e.preventDefault();
    let l = Ladda.create(e.delegateTarget);
    l.start();
    setTimeout(() => { l.stop(); }, 2000);
});
