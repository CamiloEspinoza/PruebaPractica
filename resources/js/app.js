require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router'
import VCalendar from 'v-calendar';


Vue.use(VueRouter)
//Componente Raiz
Vue.component('App', require('./components/App.vue'))
Vue.component('Home', require('./components/Home.vue'));



// Register component(s)
Vue.component('VCalendar', require('./components/Calendario.vue'));

import Home from './components/Home'
import App from './components/App'

const routes = [
    { path: '/', component: Home }
  ]

const router = new VueRouter({
    routes // short for routes: routes
  }) 

  new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App, Home, VCalendar}
  })



