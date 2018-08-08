require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import VueMaterial from 'vue-material';
import 'vue-material/dist/vue-material.min.css';
import * as VueGoogleMaps from 'vue2-google-maps';

import { library } from '@fortawesome/fontawesome-svg-core';
import {
  faFacebook,
  faTwitter,
  faInstagram,
  faYoutube
} from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faFacebook, faTwitter, faInstagram, faYoutube);

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.use(VueMaterial);
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyB8bkyHJdZvsl28PTSS1YQeLkEp-NhI3Bc',
    libraries: 'places'
  }
});

Vue.component('search', require('./components/Search.vue'));

const app = new Vue({
  el: '#app'
});
