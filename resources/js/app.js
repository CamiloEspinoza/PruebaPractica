require('./bootstrap')
import Vue from 'vue'

//Componente Raiz
Vue.component('App', require('./components/App.vue'))
Vue.component('Home', require('./components/Home.vue'))
Vue.component('Calendario', require('./components/Calendario.vue'))

const Home = { path: '/', component: Home }


const app = new Vue(Home).$mount('#app')
