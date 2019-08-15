<template>
  <div class="home">
    <h1>Prueba Práctica</h1>
    <p>
      Aquí abajo debe estar el calendario, luego la lista y luego el botón
      guardar.
    </p>

    <Calendario></Calendario>
  </div>
</template>

<script>
import Calendario from './Calendario';

export default {
  components: {Calendario}
  ,
  data() {
    return {
      fechasSeleccionadas: [],
    }
  },
  methods: {
    agregarFecha() {},
  },
}
</script>

<style scoped lang="scss">
.home {
  background-color: #eeee;
}
</style>
