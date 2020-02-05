import 'es6-promise/auto';
import axios from 'axios';
import './bootstrap';
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import App from './pages/App';
import auth from './auth';
import router from './router';
// Resource, TODO revisar su posible uso
import Resource from 'vue-resource';
// I18n
import I18n from 'vue-i18n';
import { messages } from './messages';
// Vuetify
import Vuetify from 'vuetify';
import vuetifyapp from './plugins/vuetify';
// Cookies
import VueCookies from 'vue-cookies';
// Validate
import Vuelidate from 'vuelidate'


// Set Vue globally
window.Vue = Vue;

// Set Vue router
Vue.router = router;
Vue.use(VueRouter);
Vue.use(VueCookies);
Vue.use(Vuetify);
//Vue.use(Resource);
Vue.use(I18n);

// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = `${process.env.MIX_API_URL}`;
Vue.use(VueAuth, auth);

Vue.use(Vuelidate);

// I18n
const i18n = new I18n({
  locale: 'es', // set locale
  messages: messages, // set locale messages
});

const app = new Vue({
  el: '#app',
  i18n,
  router,
  vuetify: vuetifyapp,
  render: a => a(App)
});
