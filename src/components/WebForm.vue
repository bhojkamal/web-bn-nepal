<template>
  <div :class="myClass">
    <p>Hello World</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      myClass: 'dark-theme',
    }
  }, 
  methods: {
    // Make 3 POST requests at the same time which need to be resolved all at the same time
    saveData(){
     axios.all([
        axios.post(`/my-url`, {
          myVar1: 'myValue'
        }), 
        axios.post(`/my-url2`, {
          myVar2: 'myValue'
        }),
        axios.post(`/my-url3`, {
          myVar3: 'myValue'
        }),
      ])
      .then(axios.spread((data1, data2, data3) => {
        // output of req.
        console.log('data1:', data1, 'data2:', data2, 'data3:', data3 )
      }))
      .catch(error => {
        console.log(error)
         // Manage errors if found any
      })
    }
  }

}
</script>

<style scoped>
.dark-theme {
  background-color:lightslategrey
}
</style>