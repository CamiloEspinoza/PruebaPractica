<template>
  <div class="calendar">
    <div class="calendar-header">
      <button @click="previousMonth">&lt;</button>
      <span>{{ this.thisMonth }}</span>
      <button @click="nextMonth">&gt;</button>
    </div>
    <div v-if="isLoading">loading...</div>
    <div class="calendar-body" v-else>
      <div class="weeks">
        <div
          class="week"
          v-for="(weekDay, index) in weekDays"
          :key="`w-${index}`"
        >
          {{ weekDay }}
        </div>
      </div>
      <div class="events-wrapper">
        <div class="event-days">
          <div
            class="event-day"
            v-for="(emptyCell, index) in emptyFirstDayCell"
            :key="`fd-${index}`"
          ></div>
          <div
            class="event-day"
            v-for="(day, index) in lastDay"
            :key="`d-${index}`"
          >
            <span class="event-day-number">{{ day }}</span>

            <img width="85px" :src="getImage(day)" alt="" />
          </div>
          <div
            class="event-day"
            v-for="(emptyCell, index) in emptyLastDayCell"
            :key="`ld-${index}`"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import axios from "axios";
moment.locale("es");

export default {
  name: "VCalendar",
  props: {
    data: [Array],
  },
  setup() {},
  data() {
    return {
      months: moment().months(),
      today: moment().format("D"),

      thisMonth: moment().format("MMMM"),
      thisMonthNumber: moment().format("MM"),
      thisYear: moment().format("YYYY"),
      weekDays: moment.weekdays(),
      firstDay: parseInt(moment().startOf("month").format("D")),
      lastDay: parseInt(moment().endOf("month").format("D")),
      firstWeekDay: moment().startOf("month").format("dddd"),

      isLoading: false,
      counter: 0,
    };
  },
  computed: {
    // with 30 days - 0
    // with 31 days - 6
    emptyLastDayCell() {
      if (this.firstWeekDay === "domingo") return 4;
      if (this.firstWeekDay === "martes" && this.lastDay === 31) return 2;
      if (this.firstWeekDay === "martes" && this.lastDay === 28) return 5;
      if (this.firstWeekDay === "miércoles") return 2;
      if (this.firstWeekDay === "jueves") return 1;
      if (this.firstWeekDay === "viernes" && this.lastDay === 30) return 0;
      if (this.firstWeekDay === "viernes" && this.lastDay === 31) return 6;
      if (this.firstWeekDay === "sábado" && this.lastDay === 31) return 5;
      return 34 - this.lastDay;
    },
    emptyFirstDayCell() {
      if (this.firstWeekDay === "lunes") return 1;
      if (this.firstWeekDay === "martes") return 2;
      if (this.firstWeekDay === "miércoles") return 3;
      if (this.firstWeekDay === "jueves") return 4;
      if (this.firstWeekDay === "viernes") return 5;
      if (this.firstWeekDay === "sábado") return 6;
      if (this.firstWeekDay === "domingo") return 7;
      return 0;
    },
  },
  methods: {
    async previousMonth() {
      this.toggleLoading();
      this.counter--;
      this.thisMonth = moment().add(this.counter, "months").format("MMMM");
      this.thisMonthNumber = moment().add(this.counter, "months").format("MM");
      this.lastDay = parseInt(
        moment().add(this.counter, "months").endOf("month").format("D")
      );
      this.thisYear = moment().add(this.counter, "months").format("YYYY");
      this.firstWeekDay = moment()
        .add(this.counter, "months")
        .startOf("month")
        .format("dddd");

      await this.fetchImages();

      this.toggleLoading();
    },
    async nextMonth() {
      this.toggleLoading();
      this.counter++;
      this.thisMonth = moment().add(this.counter, "months").format("MMMM");
      this.thisMonthNumber = moment().add(this.counter, "months").format("MM");
      this.lastDay = parseInt(
        moment().add(this.counter, "months").endOf("month").format("D")
      );
      this.thisYear = moment().add(this.counter, "months").format("YYYY");
      this.firstWeekDay = moment()
        .add(this.counter, "months")
        .startOf("month")
        .format("dddd");
      await this.fetchImages();
      this.toggleLoading();
    },

    getImage(day) {
      return this.data[day - 1]?.imagenes;
    },

    toggleLoading() {
      this.isLoading = !this.isLoading;
    },

    async fetchImages() {
      const url = `http://127.0.0.1:8000/api/dias?start=${this.thisYear}-${this.thisMonthNumber}-01&end=${this.thisYear}-${this.thisMonthNumber}-${this.lastDay}`;
      axios.get(url).then((res) => {
        this.days = res.data.result;
      });
    },
  },
};
</script>