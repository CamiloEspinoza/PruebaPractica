<template>
    <table class="calendar">
        <thead>
            <tr>
                <th class="dirArrow">
                    <a href="#" @click.prevent="getPrevMonth()">&larr;</a>
                </th>
                <th colspan="5">
                    {{ (selectedMonth) ? selectedMonth.name + ' ' + selectedYear : '' }}
                </th>
                <th class="dirArrow">
                    <a href="#" @click.prevent="getNextMonth()">&rarr;</a>
                </th>
            </tr>
            <tr>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sábado</th>
                <th>Domingo</th>
            </tr>
        </thead>
        <tbody>
            <template v-if="weeks.length > 0">
                <tr v-for="(week, indexX) in weeks" :key="indexX">
                    <td v-if="indexX == 0" :colspan="weekdayForFirstDate">&nbsp;</td>

                    <td v-for="(date, indexY) in week" :key="indexY">
                        <a href="#" @click.prevent="selectDate(date)">
                            {{ moment(date.date).date() }}
                        </a>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</template>
<script>
import EventBus from '../EventBus';
import moment from 'moment';

export default {
    mounted(){
        this.getDias();
    },
    data(){
        return {
            selectedMonth: null,
            selectedYear: null,
            moment: moment,
            weeks: []
        };
    },
    methods: {
        getDias(){
            let that = this;
            let month = (that.selectedMonth) ? that.selectedMonth.number : null;
            let year = that.selectedYear;

            axios.post(`/api/getDias`, {month, year})
                .then(rs => {
                    that.selectedMonth = rs.data.month;
                    that.selectedYear = rs.data.year;

                    rs.data.dates.forEach((date) => {
                        if(!that.weeks[date.week - 1]){
                            that.weeks[date.week - 1] = [];
                        }

                        that.weeks[date.week - 1].push(date);
                    });

                    that.$forceUpdate();
                });
        },
        selectDate(date){
            EventBus.$emit('dateSelected', date);
        },
        getPrevMonth(){
            
        },
        getNextMonth(){
            if(this.selectedMonth.number < 12){
                this.selectedMonth.number++;
            }else{
                this.selectedMonth.number = 1;
                this.selectedYear++;
            }

            this.getDias();
        }
    },
    computed: {
        weekdayForFirstDate(){
            if(this.weeks.length == 0){
                return 0;
            }

            return 7 - this.weeks[0].length;
        }
    }
};
</script>
<style>
    .calendar{
        width: 100%;
        border: solid 1px #000;  
    }
    .calendar th{
        text-align: center;
        padding: 5px;
        border-bottom: solid 1px #000;
    }
    .calendar td a{
        display: block;
        width: 100%;
        text-align: center;
        padding: 5px;
    }
    .dirArrow a{
        display: block;
        width: 100%;
        text-align: center;
        padding: 5px;
        text-decoration: none;
    }
</style>