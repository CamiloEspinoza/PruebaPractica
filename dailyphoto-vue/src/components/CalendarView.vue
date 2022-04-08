<!-- This example requires Tailwind CSS v2.0+ -->
<template>
<div class="bg-blue-50 mx-auto px-24 pb-24">
    <!-- Title -->
    <div class="text-gray-900 text-center text-4xl py-12">
      {{ title }} <span class="text-sm">by {{ author }}</span>
    </div>

    <!-- Calendar -->
    <div class="bg-gray-100 rounded-lg shadow-xl overflow-hidden border border-gray-200">

      <!-- Header -->
    <div class="px-7 py-4 border-b border-b-gray-200 flex-1 flex items-center justify-between">
      <!-- Month Name -->
      <span v-text="months[month] + ' ' + year" class="text-xl font-bold text-gray-800" />

      <!-- Month Navigation -->
      <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
        <button @click="backMonth()" type="button" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
          <span class="sr-only">Previous</span>
          <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
        </button>
        <button @click="nextMonth()" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
          <span class="sr-only">Next</span>
          <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
        </button>
      </nav>
    </div>

    <div class="grid grid-cols-7 border-gray-200 border-l">

      <!-- Days of the Week -->
      <div v-for="day in days" :key="day">
        <div class="px-2 py-2 border-r border-b border-gray-200 bg-white">
          <div v-text="day" class="text-gray-600 text-sm tracking-wide font-bold text-center"></div>
        </div>
      </div>

      <!-- First week -->
      <div v-for="day in firstDayOfWeek" :key="day">
        <div class="px-4 pt-2 h-8 sm:h-16 md:h-24 lg:h-32 bg-gray-100 border-r border-b border-gray-200"></div>
      </div>

      <!-- Days --> 
      <div v-for="day in daysInMonth" :key="day">
        <div class="bg-white text-left px-4 pt-2 border-r border-b relative h-8 sm:h-16 md:h-24 lg:h-32">
          <div v-text="day" class="inline-flex w-6 h-6 items-center justify-center cursor-pointer leading-none rounded-full transition ease-in-out duration-100 hover:text-white hover:bg-blue-700" :class="{'bg-blue-700 text-white': day === today.date() && this.month === today.month() }"></div>
          <img v-if="getImageDay(day)" :src="getImageDay(day)" class="mt-2 rounded-sm h-full mx-auto" :alt="day" />
        </div>
      </div>
    </div>

    </div>
  </div>
</template>

<script>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
import moment from 'moment'
import axios from 'axios'

export default {
  components: {
    ChevronLeftIcon,
    ChevronRightIcon
  },

  props: {
    title: {
      type: String,
      default: 'Calendar'
    },
    author: {
      type: String,
      default: 'Ricardo Valenzuela'
    },
  },

  data() {
    return {
      months: moment.months(),
      today: moment(),
      month: "",
      year: "",
      days: moment.weekdaysShort(),
      firstDayOfWeek: "",
      daysInMonth: "",
      daysImages: [],
    };
  },

  methods: {

    orderDays() {
      this.firstDayOfWeek = moment(`${this.year}-${this.month + 1}-01`, 'YYYY-MM-DD').day();
      this.daysInMonth = moment(`${this.year}-${this.month + 1}`, "YYYY-MM").daysInMonth();

      axios.get(`http://prueba.biz/api/dias?inicio=${this.year}-${this.month + 1}-01&fin=${this.year}-${this.month + 1}-${this.daysInMonth}`)
        .then(response => {
          this.daysImages = response.data 
        })
    },

    nextMonth()
    {
      this.month = this.month < 11 ? this.month + 1 : 0;
      this.year = this.month === 0 ? this.year + 1 : this.year;
    },

    backMonth()
    {
      this.month = this.month > 0 ? this.month - 1 : 11;
      this.year = this.month === 11 ? this.year - 1 : this.year;
    },

    getImageDay(day)
    {
      let monthFormat = this.month < 10 ? '0' + (this.month + 1) : this.month + 1;
      let dayFormat = day < 10 ? '0' + day : day;

      let result = this.daysImages.filter(fecha => fecha.fecha === this.year + '-' + monthFormat + '-' + dayFormat)
      return result.length > 0 ? result[0].imagenes : ''
    }

  },

  watch: {
    month: function() {
      this.orderDays()
    },
  },

  mounted() {
    this.year = this.today.year()
    this.month = this.today.month()
  }
}
</script>