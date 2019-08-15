Vue.component('Calendario',{
    template: //html
    `
    <div>
        </VCalendar>
    </div>
    `
})
<script>
import VCalendar from 'v-calendar';
export default {
  data() {
    return {
      attrs: [
        {
          key: 'today',
          highlight: {
            backgroundColor: '#ff8080',
            // Other properties are available too, like `height` & `borderRadius`
          },
          dates: new Date(2019, 0, 1)
        }
      ],
    };
  },
};
</script>