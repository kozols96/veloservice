<template>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <router-link
                        to="/"
                        class="navbar-brand"
                    >
                        Home
                    </router-link>
                    <router-link
                        to="/sign-up"
                        class="navbar-brand"
                    >
                        Sign Up
                    </router-link>
                </div>
                <div class="col-12">

                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Navbar"
})
</script>

<style scoped>

</style>
