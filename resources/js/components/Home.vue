<template>
    <div class="home">
        <h1>Prueba Práctica</h1>
        <div class="row">
            <div class="col-calendar">
                <Calendario></Calendario>
            </div>
            <div class="col-list">
                <ul>
                    <li v-for="(date, index) in fechasSeleccionadas" :key="index">
                        {{ date.date }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import EventBus from '../EventBus';
import Calendario from './Calendario';

export default {
    components: {Calendario},
    data() {
        return {
            fechasSeleccionadas: [],
        }
    },
    mounted(){
        EventBus.$on('dateSelected', (date) => {
            this.agregarFecha(date);
        });
    },
    methods: {
        agregarFecha(date) {
            this.fechasSeleccionadas.push(date);
        },
    },
}
</script>

<style scoped lang="scss">
.home {
    background-color: #eeee;
    width: 800px;
    margin: auto;
    padding: 10px;
}
.row{
    display: flex;
    flex-direction: row;
}
.col-calendar{
    flex: 1;
}
.col-list{
    width: 200px;
    border: solid 1px red;
}
</style>
