require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import App from './components/App';
import Calendario from './components/Calendario';
import Home from './components/Home';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        }
    ],
});



Vue.component('App', require('./components/App.vue'));
Vue.component('Calendario', require('./components/Calendario.vue'));
Vue.component('Home', require('./components/Home.vue'));


const app = new Vue().$mount('#app');
