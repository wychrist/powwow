
<template>
  <div class="q-pa-md">
    <q-table
      title="Treats"
      :rows="rows"
      :columns="columns"
      row-key="id"
    >
    <template v-slot:body="props">
        <q-tr :props="props">
          <q-td key="id" :props="props">
            {{ props.row.id}}
          </q-td>
          <q-td key="name" :props="props">
              {{ props.row.name}}
          </q-td>
          <q-td key="domain" :props="props">
              {{ props.row.domain}}
          </q-td>
          <q-td key="actions" :props="props">
              <q-btn flat icon="delete" text-color="red"></q-btn>
              <q-btn flat icon="edit" text-color="green"></q-btn>
              <q-btn flat icon="bug_report" text-color="primary" :to="{name: 'test_ui', params: { id: props.row.id }}"></q-btn>
          </q-td>
        </q-tr>
    </template>
    </q-table>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { IApplication, Model } from '../models/Application'

export default defineComponent({
  setup() {
   return {
     columns,
     rows
   }
  },
})

const rows = ref<Array<IApplication>>(Model.all())

const columns = [
  { name: 'id', align: 'left', label: 'Id', field: 'id', sortable: true },
  { name: 'name', align: 'left', label: 'Name', field: 'name', sortable: true },
  { name: 'domain', align: 'left', label: 'Domain', field: 'domain', sortable: true },
  {
    name: 'actions',
    align: 'right',
    label: 'Actions',
      field () {
        return 'list of actions'
      },
    sortable: true
  },
]
</script>
