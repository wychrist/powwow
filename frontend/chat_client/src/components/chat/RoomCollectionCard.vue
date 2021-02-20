<template>
    <q-list borderedseparator>
        <room-card clickable v-ripple v-for="aRoom in rooms" :key="aRoom.id" :room="aRoom">
        </room-card>
    </q-list>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import RoomCard from './RoomCard.vue'

export default defineComponent({
    name:'RoomCollectionCard',
    props: {
        rooms: Array
    },
    components: {
        RoomCard
    }
})
</script>
