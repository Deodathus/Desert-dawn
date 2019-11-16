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

//UTIL-COMPONENTS***********************************************
import DataCard from "./components/utils/DataCard"
import List from "./components/utils/List"
import Collapse from "./components/utils/Collapse"
import ValidationErrors from "./components/utils/ValidationErrors"
import EditItem from "./components/utils/EditItem"
import DeleteItem from "./components/utils/DeleteItem"

Vue.component('collapse', Collapse);
Vue.component('validation-errors', ValidationErrors);
Vue.component('data-card', DataCard);
Vue.component('list', List);
Vue.component('edit-item', EditItem);
Vue.component('delete-item', DeleteItem);

//ADMIN*********************************************************
import AdminLeftBar from './components/admin/AdminLeftBar'
import LeftBarLinks from "./components/admin/LeftBarLinks"
import MainLink from "./components/admin/MainLink"

Vue.component('admin-left-bar', AdminLeftBar);
Vue.component('left-bar-links', LeftBarLinks);
Vue.component('main-link', MainLink);

//USER**********************************************************
import UserManage from "./components/admin/user/UserManage"
import UserCreateForm from "./components/admin/user/UserCreateForm"
import UserList from "./components/admin/user/UserList"
import UserManageAll from "./components/admin/user/UserManageAll"
import UserManageAllForm from "./components/admin/user/UserManageAllForm"

Vue.component('user-manage', UserManage);
Vue.component('user-create-form', UserCreateForm);
Vue.component('user-list', UserList);
Vue.component('user-manage-all', UserManageAll);
Vue.component('user-manage-all-form', UserManageAllForm);

//BOSS**********************************************************
import BossManage from "./components/admin/boss/BossManage"
import BossCreateForm from "./components/admin/boss/BossCreateForm"

Vue.component('boss-manage', BossManage);
Vue.component('boss-create-form', BossCreateForm);

//**************************************************************


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
