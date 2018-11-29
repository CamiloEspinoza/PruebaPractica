require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//Componente Raiz
Vue.component('App', require('./components/App.vue'))

import Home from './components/Home';

const router = new VueRouter({
    routes: [
        {
            path: '/', 
            component: Home
        }
    ]
});

const app = new Vue({
    router
}).$mount('#app')
