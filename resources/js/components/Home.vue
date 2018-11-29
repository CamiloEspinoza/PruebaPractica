<template>
    <div class="home">
        <h1>Prueba Práctica</h1>
        <div class="row">
            <div class="col-calendar">
                <Calendario></Calendario>
            </div>
            <div class="col-list">
                <p><b>Fechas Seleccionadas</b></p>
                <ul>
                    <li v-for="(date, index) in fechasSeleccionadas" :key="index">
                        {{ date }}
                    </li>
                </ul>
                <button @click.prevent="store()" :disabled="fechasSeleccionadas.length == 0">Guardar</button>
                <button @click.prevent="clear()" :disabled="fechasSeleccionadas.length == 0">Limpiar</button>
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
            let rs = this.fechasSeleccionadas.filter((sdate) => {
                return sdate == date;
            });

            if(rs.length == 0){
                this.fechasSeleccionadas.push(date);
            }

            this.fechasSeleccionadas.sort();
        },
        store(){
            axios.post('/api/store', {dates: this.fechasSeleccionadas})
                .then((rs) => {
                    alert("Fechas guardada en el archivo " + rs.data.file);
                });
        },
        clear(){
            this.fechasSeleccionadas = [];   
        }
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
    text-align: center;
}
</style>
