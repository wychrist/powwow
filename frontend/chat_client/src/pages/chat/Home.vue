<template>
     <q-page>
       <chat-body></chat-body>
     </q-page>
</template>

<script>
import ChatBody from 'components/chat/ChatMain.vue'

export default {
    name: 'ChatHomePage',
    components: {
      ChatBody
    },
    setup() {
      return {}
    }
}
</script>
