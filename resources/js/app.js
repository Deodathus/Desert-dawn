
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

$(document).ready(function () {

    // change shop content
    function changeShopContent(id, div) {
        $.get($('.shop-container').data('change-shop-url'), {
            type:id,
        }, function (data) {
            div.html(data);
            div.fadeIn();
        });
    }

    // selling item
    function sellItem(url) {
        $.get(url, function(data) {
            $('.shop-content').html(data);
            setTimeout(updateUserBar, 300);
            $('.user-bar').fadeOut();
        });

        return true;
    }

    // buying items
    function buyItem(url, itemId) {
        $.get(url, {
            id:itemId
        }, function (data) {
            if (data === true) {
                $('.myH1').html('Success');
            } else {
                $('.myH1').html('Error');
            }
        });
    }

    // click ivent that changes shop content
    $('.shop-links').click(function () {
        let shopContent = $('.shop-content');
        shopContent.fadeOut();
        setTimeout(changeShopContent,  300, $(this).data('shop-id'), shopContent);
    });

    // changing userbar after selling items
    function updateUserBar() {
        let div = $('.user-bar');
        let link = div.data('update-user-bar-url');
        $.get(link, function (data) {
            div.fadeIn();
            div.html(data);
        });
    }

    // click event for selling items
    $('body').on('click', '.item-sell',  function () {
        let link = $(this).data('item-selling-url');
        if (setTimeout(sellItem, 500, link)) {
            $('#response').html('Sucess');
        }
    });
});
