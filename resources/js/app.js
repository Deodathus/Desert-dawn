require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

window.Vue = require('vue');
Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import '../sass/app.scss'

//ADMIN*********************************************************
import AdminLeftBar from './components/admin/AdminLeftBar'

Vue.component('admin-left-bar', AdminLeftBar);


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
