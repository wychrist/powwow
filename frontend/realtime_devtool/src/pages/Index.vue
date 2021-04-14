<template>
  <q-page class="row">
    <div class="col-12">
      <applications v-if="applications.length"></applications>
      <register-application v-else></register-application>
    </div>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { IApplication, Model } from '../models/Application'
import RegisterApplication from '../components/RegisterApplication.vue'
import Applications from '../components/Applications.vue'

export default defineComponent({
  name: 'PageIndex',
  components: {
    RegisterApplication,
    Applications
  },
  setup() {
    const applications = ref<IApplication[]>(Model.all())

    return {
      applications
    }
  }
});
</script>
