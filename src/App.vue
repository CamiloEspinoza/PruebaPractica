<template>
  <div id="app">
    <v-calendar :data="days"></v-calendar>
  </div>
</template>

<script>
import axios from "axios";
import VCalendar from "./components/Calendar/Calendar.vue";
export default {
  name: "App",
  data() {
    return {
      days: [],
    };
  },
  created() {
    const now = new Date();
    var start = new Date(now.getFullYear(), now.getMonth(), 1);
    var end = new Date(now.getFullYear(), now.getMonth() + 1, 0);

    const month =
      start.getMonth() < 9 ? `0${start.getMonth()}` : start.getMonth();

    const url = `http://127.0.0.1:8000/api/dias?start=${start.getFullYear()}-${month}-01&end=${end.getFullYear()}-${month}-${end.getDate()}`;
    axios.get(url).then((res) => {
      this.days = res.data.result;
    });
  },
  components: {
    VCalendar,
  },
};
</script>


