<template>
  <div>
     <q-layout>
      <app-header slot="header"></app-header>
      <router-view></router-view>
      <app-footer slot="footer"></app-footer>
    </q-layout>
  </div>
</template>

<script>
/*
 * Root component
 */
import layout from './layout'
import AppHeader from '@admin/Header'
import AppFooter from '@admin/Footer'

export default {
  components: {
    AppHeader,
    AppFooter
  },
  data () {
    return {
      layout
    }
  }
}
</script>

<style></style>
