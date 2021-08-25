<template>
<div>
  <h1>This is login page</h1>
  <h2>test</h2>
  <input type="text" v-model="test">
  <button @click="testFunc">表示</button>

  <button @click="fetch">API</button>

  <h3>{{ test }}</h3>


</div>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
  data() {
    return {
      test: null,
    }
  },

  methods: {
    testFunc () {
      console.log(this.test);
    },

    async fetch () {
      const res = await this.$axios.get('/api/test').catch((e) => {
        return e;
      });
      console.log(res)

    },
  }
})
</script>
