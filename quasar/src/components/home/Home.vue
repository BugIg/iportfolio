<template>
    <!-- if you want automatic padding use "layout-padding" class -->
    <div class="layout-padding">
        <ul class="nav navbar-nav">
          <li>
            <router-link to="/">Home</router-link>
          </li>
          <li v-if="!checkLogin">
            <router-link to="/login" v-if="!checkLogin">Login</router-link>
          </li>
          <li v-if="!checkLogin">
            <router-link to="/signup" v-if="!checkLogin">Sign Up</router-link>
          </li>
          <li v-if="checkLogin">
            <router-link to="/portfolio" v-if="checkLogin">Portfolio</router-link>
          </li>
        </ul>
    </div>
</template>

<script>
export default {
  data () {
    return {
      message: 'Header'
    }
  },
  methods: {
    logout: function () {
      var app = this
      localStorage.removeItem('lbUser')
      app.$router.push({ name: 'login' })
      app.$store.state.isLoggedIn = false
    }
  },
  computed: {
    checkLogin () {
      return this.$store.state.isLoggedIn
    }
  }
}
</script>

<style>
</style>
