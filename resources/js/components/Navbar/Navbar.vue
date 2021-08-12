<template>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <router-link
                        to="/"
                        class="navbar-brand"
                    >
                        Galvenā lapa
                    </router-link>
                    <router-link
                        to="/sign-up"
                        class="navbar-brand"
                    >
                        Reģistrēšanās
                    </router-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Navbar',
  computed: {

  }
})
</script>

<style scoped>

</style>
