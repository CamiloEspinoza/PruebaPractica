require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router';
import Home from './components/Home.vue';

//Componente Raiz
Vue.component('App', require('./components/App.vue'))
Vue.use(VueRouter);

const routes = [
    { 
        path: '/',
        component: Home,
        name: 'Home' 
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

// const app = new Vue().$mount('#app')
const app = new Vue({
  el: '#app',
  router
});