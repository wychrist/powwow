<template>
    <q-item>
        <q-item-section>{{ room.label }}</q-item-section>
        <q-item-section avatar>
          <q-badge color="blue">
              {{room.total_online}}
          </q-badge>
        </q-item-section>
    </q-item>
</template>

<script>
export default {
    name: 'RoomCard',
    props: {
        room: Object
    }
}
</script>