<template>
  <input type="text" v-model="postBody" @change="postPost()"/>
  <ul v-if="errors && errors.length">
    <li v-for="error of errors">
      {{error.message}}
    </li>
  </ul>
</template>

<script>
  
import axios from 'axios';

export default {
  data() {
    return {
      postBody: '',
      errors: []
    }
  },

  // Pushes posts to the server when called.
  postPost() {
    axios.post('/api/getDias', {
      body: this.postBody
    })
    .then(response => {})
    .catch(e => {
      this.errors.push(e)
    })
  }
}
</script>