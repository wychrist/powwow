<template>
     <q-page>
       <chat-body></chat-body>
     </q-page>
</template>

<script>
import ChatBody from 'components/chat/ChatBody.vue'

export default {
    name: 'ChatIndexPage',
    components: {
      ChatBody
    },
    setup() {
      return {}
    }
}
</script>
