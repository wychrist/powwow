<template>
     <q-page>
       <chat-body></chat-body>
     </q-page>
</template>

<script>
import ChatBody from 'components/messenger/ChatBody.vue'

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
