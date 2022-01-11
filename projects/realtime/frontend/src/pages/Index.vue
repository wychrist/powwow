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
import { Model as SetupModel } from '../models/Setup'
import { useRouter } from 'vue-router'

export default defineComponent({
  name: 'PageIndex',
  components: {
    RegisterApplication,
    Applications
  },
  setup() {
    const  router  = useRouter()
    if (!SetupModel.isSetup()) {
      router.replace({
        name: 'setup'
      })
      .catch((error) => {
        console.log('could not redirect', error)
      })
    }
    const applications = ref<IApplication[]>(Model.all())

    return {
      applications
    }
  }
});
</script>
