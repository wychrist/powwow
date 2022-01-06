<template>
  <q-page class="row items-center justify-evenly">
    <div>
       {{ messages }}
    </div>
    <hr />
    <q-input v-model="newMessage" @keyup="doSend">
    </q-input>
  </q-page>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'PageIndex',
  setup() {
    return {
    };
  }
});
</script>
