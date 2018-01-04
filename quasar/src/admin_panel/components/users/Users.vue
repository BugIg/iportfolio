<template>
  <!-- if you want automatic padding use "layout-padding" class -->
  <div class="layout-padding">
    <!-- your content -->
   <q-data-table
      :data="table"
      :config="config"
      :columns="columns"
      @refresh="refresh"
      @selection="selection"
      @rowclick="rowClick"
    >
      <template slot="col-message" slot-scope="cell">
        <span class="light-paragraph">{{cell.data}}</span>
      </template>
      <template slot="col-source" slot-scope="cell">
        <div v-if="cell.data === 'Audit'" class="my-label text-white bg-primary">
          Audit
          <q-tooltip>Some data</q-tooltip>
        </div>
        <div v-else class="my-label text-white bg-negative">{{cell.data}}</div>
      </template>

      <template slot="selection" slot-scope="props">
        <q-btn flat color="primary" @click="changeMessage(props)">
          <q-icon name="edit" />
        </q-btn>
        <q-btn flat color="primary" @click="deleteRow(props)">
          <q-icon name="delete" />
        </q-btn>
      </template>
    </q-data-table>

    <q-fixed-position corner="bottom-right" :offset="[62, 62]">
      <q-btn round  color="positive" @click="open = true">
        <q-icon name="add" />
      </q-btn>
    </q-fixed-position>
    
    <user-create></user-create>
  </div>
</template>

<script>

import {
  clone
} from 'quasar'

import UserCreate from './UserCreate.vue'
import table from './table'

export default {
  components: {
    UserCreate
  },
  methods: {
    changeMessage (props) {
      props.rows.forEach(row => {
        row.data.message = 'Gogu'
      })
    },
    deleteRow (props) {
      props.rows.forEach(row => {
        this.table.splice(row.index, 1)
      })
    },
    refresh (done) {
      this.timeout = setTimeout(() => {
        done()
      }, 5000)
    },
    selection (number, rows) {
      console.log(`selected ${number}: ${rows}`)
    },
    rowClick (row) {
      console.log('clicked on a row', row)
    },
    create () {
      this.$router.push({ name: `create` })
    }
  },
  beforeDestroy () {
    clearTimeout(this.timeout)
  },
  data () {
    return {
      table,
      config: {
        title: 'Users',
        refresh: true,
        noHeader: false,
        columnPicker: true,
        leftStickyColumns: 0,
        rightStickyColumns: 2,
        bodyStyle: {
          maxHeight: '1000px'
        },
        rowHeight: '50px',
        responsive: true,
        pagination: {
          rowsPerPage: 50,
          options: [5, 10, 15, 30, 50, 500]
        },
        selection: false
      },
      columns: [
        {
          label: 'Date',
          field: 'isodate',
          width: '140px',
          classes: 'bg-orange-2',
          filter: true,
          sort (a, b) {
            return (new Date(a)) - (new Date(b))
          },
          format (value) {
            return new Date(value).toLocaleString()
          }
        },
        {
          label: 'Service',
          field: 'serviceable',
          format (value) {
            if (value === 'Informational') {
              return '<i class="material-icons text-positive" style="font-size: 22px">info</i>'
            }
            return value
          },
          width: '70px'
        },
        {
          label: 'Time Range',
          field: 'timerange',
          width: '80px',
          sort: true,
          type: 'number'
        },
        {
          label: 'Message',
          field: 'message',
          filter: true,
          sort: true,
          type: 'string',
          width: '500px'
        },
        {
          label: 'Source',
          field: 'source',
          filter: true,
          sort: true,
          type: 'string',
          width: '120px'
        },
        {
          label: 'Log Number',
          field: 'log_number',
          sort: true,
          type: 'string',
          width: '100px'
        }
      ],
      pagination: true,
      rowHeight: 50,
      bodyHeightProp: 'maxHeight',
      bodyHeight: 500
    }
  },
  watch: {
    pagination (value) {
      if (!value) {
        this.oldPagination = clone(this.config.pagination)
        this.config.pagination = false
        return
      }
      this.config.pagination = this.oldPagination
    },
    rowHeight (value) {
      this.config.rowHeight = value + 'px'
    },
    bodyHeight (value) {
      let style = {}
      if (this.bodyHeightProp !== 'auto') {
        style[this.bodyHeightProp] = value + 'px'
      }
      this.config.bodyStyle = style
    },
    bodyHeightProp (value) {
      let style = {}
      if (value !== 'auto') {
        style[value] = this.bodyHeight + 'px'
      }
      this.config.bodyStyle = style
    }
  }
}
</script>
<style>
@media (min-width: 1200px) {
  .layout-padding {
      padding: 1rem 1rem;
      margin: auto;
  }
}
</style>
