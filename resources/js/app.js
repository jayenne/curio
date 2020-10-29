/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import $ from 'jquery';
window.$ = window.jQuery = $;
//import 'jquery-ui/ui/widgets/draggable.js';

require('./bootstrap');
//require('numeral');
//var $ = require('jquery');
//var Packery = require('packery');
//var InfiniteScroll = require('infinite-scroll');

window.Vue = require('vue');

import Vue from 'vue';

/*
* import and use BoostrapVue
 */
import BootstrapVue from 'bootstrap-vue'; //Importing
Vue.use(BootstrapVue); // Telling Vue to use this in whole application

/* Algolia frontend search */
import VueInstantSearch from 'vue-instantsearch';
Vue.use(VueInstantSearch);
Vue.component('user-search', require('./components/AlgoliaUsersSearch.vue').default);

/*
import isotope from 'vueisotope'
import imagesLoaded from 'vue-images-loaded'
import InfiniteLoading from 'vue-infinite-loading'
import axios from 'axios'
import VuePackeryPlugin from 'vue-packery-plugin'
import VueDraggabillyPlugin from 'vue-packery-draggabilly-plugin'
Vue.use(isotope);
Vue.use(VuePackeryPlugin);
Vue.use(VueDraggabillyPlugin);
Vue.component('post-list-isotope', require('./components/PostListIsotopeComponent.vue').default);
*/


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
       //'navbar': require('./components/NavbarComponent.vue'),
   }
});
