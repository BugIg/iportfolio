<template>
  <div>
     <q-btn color="primary" @click="open = true" label="Open" />
    <q-modal v-model="open">
      <q-btn color="primary" @click="open = false" label="Close" />
    </q-modal>
  </div>
</template>

<script>
export default {
  data () {
    return {
      open: false
    }
  }
}
</script>

<style>
</style>
