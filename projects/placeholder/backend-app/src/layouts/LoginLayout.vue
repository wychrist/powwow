<style>
.logo_round{
  border-radius: 50%;
  background-color:white;
  height: 30px !important;;
  width: 30px !important;;
  border-radius:50%;
  box-shadow: 0px 0px 4px 4px #fff;
}
.logo_round_avatar{
  height:50px;
  width:50px;
}
.logo_round_pre_div{
  height: 50px;
}
</style>

<template>
  <q-layout view="lHh lpR lFf">

    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <div class="logo_round_pre_div"></div>
          <q-avatar class="logo_round_avatar">
            <img class="logo_round" src="/img/logo.png">
          </q-avatar>
        <q-toolbar-title>
          <q-btn class="text-h5 no-margin no-padding" flat to="/">Wyreema Christians Inc.</q-btn>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container style='background-image: url("/img/hall_new_angle.JPG"); background-position: center; background-size: cover;'>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'LoginLayout',

  components: {

  },

  setup () {
    return {

    }
  }
})
</script>
