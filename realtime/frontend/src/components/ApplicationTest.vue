<template>
 <div class="row items-center justify-evenly">
   <q-card flat bordered class="col-6">
      <q-card-section>
        <div class="text-h6">Test application: {{ app.name }}</div>
      </q-card-section>

      <q-card-section class="q-pt-none">
        <q-input outlined v-model="model.channel" label="Channel" class="q-mb-md"></q-input>
        <q-input outlined v-model="model.event" label="Event" class="q-mb-md"></q-input>
        <q-input outlined v-model="model.socket_id" label="Socket Id" class="q-mb-md"></q-input>
        <q-input type="textarea" outlined v-model="model.data" label="Key" class="q-mb-md"></q-input>
      </q-card-section>

      <q-separator inset />

      <q-card-actions align="right">
        <q-btn dense @click="clearInput">Clear</q-btn>
        <q-btn color="primary" dense @click="makeRequest">Send</q-btn>
      </q-card-actions>

      <q-card-section class="q-pt-none">
        <q-input type="textarea" outlined v-model="result" label="Key" class="q-mb-md"></q-input>
      </q-card-section>
   </q-card>
 </div>
</template>

<script lang="ts">
import { defineComponent, PropType, ref } from 'vue'
import { IApplication } from '../models/Application'
import { useAxios } from '../boot/axios'

export default defineComponent({
  props: {
    app: Object as  PropType<IApplication | null>
  },
  setup(props) {
    const model = ref<IChannelData>({
      channel: '',
      event: '',
      socket_id: '',
      data: ''
    })
    const result = ref<string>('')

    const makeRequest = () => {
      doPost(model.value, props.app as IApplication, (response: string) => {
        result.value  = response
      })
    }

    const clearInput = () => {
      model.value.data = ''
    }
    return {
      makeRequest,
      clearInput,
      model,
      result
    }
  }
})

interface IChannelData {
  channel: string,
  event: string,
  socket_id?: string,
  data: string
}

const api = useAxios().create({
  baseURL: 'http://192.168.20.20:3000/api/',
  headers: {
    'Accept': 'application/json',
    'Authorization': 'Bearer thisiswrong',
    'Content-Type': 'application/json'
    }
})

const doPost = (data: IChannelData, app: IApplication, callback: (res: string) => void) => {
  api.post(`app/${app.key}/trigger`, data)
    .then((result) => {
      callback(JSON.stringify(result.data))
  })
  .catch((error) => {
    callback(JSON.stringify(error))
  })
}

</script>
