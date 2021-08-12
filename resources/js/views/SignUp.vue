<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="mt-2">
                        Reģistrēšanās lapa
                    </h1>
                </div>
                <div class="register-form">
                    <div class="col-12 mt-5">
                        <form method="post" novalidate @submit.prevent="">
                            <div class="mb-3">
                                <label class="form-label">
                                    Vārds Uzvārds
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    E-pasta adrese
                                </label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Parole
                                </label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Apstiprināt paroli
                                </label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                >
                            </div>
                            <button type="submit" class="btn btn-dark">Reģistrēties</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, reactive } from 'vue'

export default defineComponent({
  name: 'SignUp',
  setup () {
    const registerUser = {
      name: '',
      email: '',
      password: '',
      passwordConfirmation: ''
    }

    const registerForm = reactive(registerUser)

    return {
      registerForm
    }
  }
})
</script>

<style scoped>

</style>
