require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import VueMaterial from 'vue-material';
import 'vue-material/dist/vue-material.min.css';

Vue.use(VueMaterial);
Vue.component('search', require('./components/Search.vue'));

const app = new Vue({
  el: '#app'
});
