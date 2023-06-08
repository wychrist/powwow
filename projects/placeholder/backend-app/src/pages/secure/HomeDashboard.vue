<template>
  <div>
    Dashboard
  </div>
</template>

<script lang="ts">
import { useUserStore } from 'src/stores/user-store'
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'HomeDashboard'
})
</script>

<script lang="ts" setup>
const user = useUserStore()

  ; (async () => {
  const response = await user.fetchMe()
})()
</script>
