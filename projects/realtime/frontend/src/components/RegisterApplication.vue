<template>
 <div class="row items-center justify-evenly">
   <q-card flat bordered class="col-6">
      <q-card-section>
        <div class="text-h6">Register an application</div>
      </q-card-section>

      <q-card-section class="q-pt-none">
        <q-input outlined v-model="model.id" label="Id" class="q-mb-md"></q-input>
        <q-input outlined v-model="model.name" label="Name" class="q-mb-md"></q-input>
        <q-input outlined v-model="model.domain" label="Domain" class="q-mb-md"></q-input>
        <q-input outlined v-model="model.key" label="Key" class="q-mb-md"></q-input>
        <q-input outlined v-model="model.secret" label="Secret"></q-input>
      </q-card-section>

      <q-separator inset />

      <q-card-actions align="right">
        <q-btn dense>Cancel</q-btn>
        <q-btn color="primary" dense @click="saveApplication">Apply</q-btn>
      </q-card-actions>
    </q-card>
 </div>
</template>


<script lang="ts">
import { defineComponent, ref } from 'vue'
import { IApplication, Model, Application } from '../models/Application'

export default defineComponent({
  setup() {
    const model= ref<IApplication>(new Application())

    const saveApplication = () => {
      Model.save(model.value)
    }

    return {
      model,
      saveApplication
    }
  },
})
</script>
