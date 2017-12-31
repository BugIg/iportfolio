<template>
  <div class="layout-padding docs-input row justify-center ">
    <div style="width: 400px; max-width: 90vw;">
      
      <q-field icon="mail" :error="$v.credentials.email.$error" error-label="Please type a valid email" count>
        <q-input type="email" float-label="Email" v-model.trim="credentials.email" @blur="$v.credentials.email.$touch" />
      </q-field>
      
      <q-field icon="lock" :error="$v.credentials.password.$error" error-label="Please type a password" count>
        <q-input type="password" float-label="Password" v-model.trim="credentials.password" @blur="$v.credentials.password.$touch()" />
      </q-field>

      <q-btn color="secondary" class="full-width" @click="loginUser">Login</q-btn>
    
    </div>
  </div>
</template>
<script>
import { required, email } from 'vuelidate/lib/validators'
import loginService from './loginService.js'

export default {
  data () {
    return {
      credentials: {
        email: 'igor.mozzhakov@gmail.com',
        password: 'f66ff0b4f'
      }
    }
  },
  validations: {
    credentials: {
      email: { required, email },
      password: { required }
    }
  },
  methods: {
    loginUser: function () {
      const authUser = {}
      var app = this
      loginService.login(this.credentials)
        .then(function (res) {
          console.log(res)
          if (res.status === 'ok') {
            authUser.data = res.data
            authUser.token = res.token
            app.$store.state.isLoggedIn = true
            window.localStorage.setItem('lbUser', JSON.stringify(authUser))
            if (authUser.data.name === 'Admin') {
              app.$router.push('/')
            }
            else {
              app.$router.push('/')
            }
          }
          else {
            app.$store.state.isLoggedIn = false
          }
        })
        .catch(function (err) {
          console.log(err)
        })
    },
    loginAuth: function () {
      var app = this
      const status = JSON.parse(window.localStorage.getItem('lbUser'))
      if (status === null || status === undefined) {
        app.$router.push('/login')
      }
      else if (status.data.name === 'Admin') {
        app.$router.push('/')
      }
      else {
        app.$router.push('/')
      }
    }
  },
  created: function () {
    this.loginAuth()
  }
}
</script>

<style>
  @import './login.scss';
</style>
