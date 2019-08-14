require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router';

//Componente Raiz
Vue.component('App', require('./components/App.vue'))
Vue.component('Calendario', require('./components/Calendario.vue'))

Vue.use(VueRouter);

const routes = [
    { 
        path: '/',
        component: require('./components/Home.vue'),
        name: 'Home' 
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
  el: '#app',
  router
});