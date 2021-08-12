<template>
    <navbar />
    <router-view />
</template>

<script lang="ts">
import { defineComponent } from 'vue'

import Navbar from './components/Navbar/Navbar.vue'

export default defineComponent({
  name: 'App',
  components: {
    Navbar
  }
})

</script>

<style scoped>

</style>
