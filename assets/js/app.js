/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

// assets/js/app.js
import Vue from 'vue';
import PaymentSearch from './components/PaymentSearch'
import Pagination from './components/Pagination'
import SearchExporter from './components/SearchExporter'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios);

/**
 * Create a fresh Vue Application instance
 */

window.onload = function () {
  new Vue({
    el: '#app',
    components: {PaymentSearch, Pagination, SearchExporter}
  });
}