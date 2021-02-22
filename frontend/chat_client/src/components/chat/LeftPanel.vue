<template>
  <div>
      <q-input dark dense standout="bg-accent text-white" placeholder="Search..." class="q-ma-sm">
      <template v-slot:prepend>
        <q-icon name="search"></q-icon>
      </template>
    </q-input>
    <q-tabs
      dense
      class="bg-accent q-mx-sm"
      align="justify"
    >
      <q-tab class="text-white" icon="meeting_room" name="rooms" label="Rooms"/>
      <q-tab class="text-white" icon="message" name="dms" label="Messages" />
    </q-tabs>

    <div class="stick-bottom bg-primary justify" style="height: 56px; width: 100%">
      <q-btn-group spread>
        <q-btn class="text-white text-caption" stack icon="add_circle_outline" flat label="friend/room"></q-btn>
        <q-btn class="text-white text-caption" stack icon="account_circle" flat label="Profile"></q-btn>
        <q-btn class="text-white text-caption" stack icon="settings" flat label="Settings"></q-btn>
      </q-btn-group>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>
.stick-bottom {
  position:absolute;
  bottom: 0;
}
</style>
