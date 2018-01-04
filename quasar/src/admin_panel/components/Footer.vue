<template>
    <div>
        <q-toolbar slot="footer">
          <q-tabs position="bottom" align="justify">
            <q-route-tab to="/admin/dashboard" exact default name="dashboard" slot="title" icon="dashboard" label="Dashboard"/>
            <q-route-tab to="/admin/users" exact name="users" slot="title" icon="people" label="Users"/>
            <q-route-tab to="/admin/coins" exact nname="coins" slot="title" icon="local play" label="Coins"/>
            <q-route-tab to="/admin/markets" exact name="markets" slot="title" icon="account balance" label="Markets"/>
            <q-route-tab to="/admin/currencies" exact name="currencies" slot="title" icon="euro symbol" label="Currencies"/>
          </q-tabs>
        </q-toolbar>
    </div>
</template>

<script>
  export default {
    data () {
      return {}
    }
  }
</script>

<style>
</style>