<template>
  <q-page class="row">
    <div class="col-12">
        <application-test :app="app"></application-test>
    </div>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import ApplicationTest from '../components/ApplicationTest.vue'
import { useRoute } from 'vue-router'
import { IApplication, Model } from '../models/Application'

export default defineComponent({
  components: {
    ApplicationTest
  },
  setup() {
    const route = useRoute()
    const app = ref<IApplication>(Model.getById(route.params.id as string) as IApplication)

    return {
      app
    }
  }
})
</script>
