require('./bootstrap');

const axios = require('axios');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import VueSweetalert2 from "vue-sweetalert2"

window.Vue = require('vue');
Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'sweetalert2/dist/sweetalert2.min.css'

import '../sass/app.scss'

Vue.use(VueSweetalert2);

//ADMIN*********************************************************
import AdminLeftBar from './components/admin/AdminLeftBar'
import LeftBarLinks from "./components/admin/LeftBarLinks"
import DataCard from "./components/admin/DataCard"
import List from "./components/admin/List"
import UserManage from "./components/admin/UserManage"
import UserCreateForm from "./components/admin/UserCreateForm"
import UserList from "./components/admin/UserList"
import ValidationErrors from "./components/admin/ValidationErrors"

Vue.component('admin-left-bar', AdminLeftBar);
Vue.component('left-bar-links', LeftBarLinks);
Vue.component('data-card', DataCard);
Vue.component('list', List);
Vue.component('user-manage', UserManage);
Vue.component('user-create-form', UserCreateForm);
Vue.component('user-list', UserList);
Vue.component('validation-errors', ValidationErrors);


const app = new Vue({
    el: '#app',
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
