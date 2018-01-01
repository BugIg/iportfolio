<template>
  <div class="layout-padding docs-input row justify-center ">
    <div style="width: 400px; max-width: 90vw;">
      
      <q-field icon="account box" :error="$v.credentials.name.$error" error-label="Please type a name" count>
        <q-input type="text" float-label="Name" v-model.trim="credentials.name" @blur="$v.credentials.name.$touch" />
      </q-field>

      <q-field icon="mail" :error="$v.credentials.email.$error" error-label="Please type a valid email" count>
        <q-input type="email" float-label="Email" v-model.trim="credentials.email" @blur="$v.credentials.email.$touch" />
      </q-field>
      
      <q-field icon="lock" :error="$v.credentials.password.$error" error-label="Please type a password" count>
        <q-input type="password" float-label="Password" v-model.trim="credentials.password" @blur="$v.credentials.password.$touch()" />
      </q-field>

      <q-btn color="secondary" class="full-width" @click="signupUser">Sign Up</q-btn>
    
    </div>
  </div>
</template>
<script>
import { required, email } from 'vuelidate/lib/validators'
import signupService from './signupService.js'

export default {
  data () {
    return {
      credentials: {
        name: 'Name',
        email: 'name@gmail.com',
        password: 'f66ff0b4f'
      }
    }
  },
  validations: {
    credentials: {
      name: { required },
      email: { required, email },
      password: { required }
    }
  },
  methods: {
    signupUser: function () {
      var app = this
      signupService.signup(this.credentials)
        .then(function (res) {
          if (res.status === 'ok') {
            app.$router.push('login')
          }
          else {
            // show error
          }
        })
        .catch(function (err) {
          console.log(err)
        })
    }
  }
}
</script>

<style>
  @import './signup.scss';
</style>
