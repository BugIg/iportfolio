<template>
  <!-- Don't drop "q-app" class -->
  <div id="q-app">
      <router-view />
  </div>
</template>

<script>
/*
 * Root component
 */
import AppIndex from '@/Index'

export default {
  components: {
    AppIndex
  },
  data () {
    return {
    }
  }
}
</script>

<style></style>
