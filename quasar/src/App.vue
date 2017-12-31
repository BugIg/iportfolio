<template>
  <!-- Don't drop "q-app" class -->
  <div id="q-app">
    <q-layout>
      <app-header slot="header"></app-header>
      <!-- Navigation Tabs
      <q-tabs slot="navigation">
        <q-route-tab slot="title" icon="view_quilt" to="/layout/about" replace hide="icon" label="About" />
        <q-route-tab slot="title" icon="view_day" to="/layout/toolbar" replace hide="icon" label="Toolbar" />
        <q-route-tab slot="title" icon="view_day" to="/layout/tabs" replace label="Tabs" />
        <q-route-tab slot="title" icon="input" to="/layout/drawer" replace label="Drawer" />
      </q-tabs>
      -->

      <!-- Left Side Panel
      <div slot="left">
        <q-list no-border link inset-delimiter>
          <q-list-header>Essential Links</q-list-header>
          <q-item>
            <q-item-side icon="school" />
            <q-item-main label="Docs" sublabel="quasar-framework.org" />
          </q-item>
          <q-item>
            <q-item-side icon="record_voice_over" />
            <q-item-main label="Forum" sublabel="forum.quasar-framework.org" />
          </q-item>
          <q-item>
            <q-item-side icon="chat" />
            <q-item-main label="Gitter Channel" sublabel="Quasar Lobby" />
          </q-item>
          <q-item>
            <q-item-side icon="rss feed" />
            <q-item-main label="Twitter" sublabel="@quasarframework" />
          </q-item>
        </q-list>
      </div>
      -->

      <!-- Right Side Panel
      <div slot="right">
        ...
      </div>
      -->

      <router-view />

      <app-footer slot="footer"></app-footer>
      <!-- Footer

      -->
    </q-layout>
  </div>
</template>

<script>
/*
 * Root component
 */
import layoutStore from './layout-store'
import AppHeader from '@/shared/Header'
import AppFooter from '@/shared/Footer'

export default {
  components: {
    AppHeader,
    AppFooter
  },
  data () {
    return {
      layoutStore
    }
  }
}
</script>

<style></style>
