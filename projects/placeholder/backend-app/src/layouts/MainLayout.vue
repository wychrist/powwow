<template>
  <q-layout view="hHh lpR lFf" v-if="show">
    <q-header elevated>
      <q-toolbar class="bg-primary">
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
          class=""
        />

        <q-toolbar-title>
          <q-btn class="text-h6 no-margin no-padding" flat to="/">Wyreema Christians Inc.</q-btn>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"

      :mini="miniState"
      @mouseover="$event => toggleDrawMini(false)"
      @mouseout="$event => toggleDrawMini(true)"
      :width="350"
      :breakpoint="600"
      bordered
      :overlay="drawOverlay"
    >
      <q-list>
        <q-item
          header
          clickable
          tag="a"
          target="_blank"
          href="#"
         >
            <q-item-section
              avatar
            >
              <q-icon name="img:/img/logo.png"/>
            </q-item-section>
            <q-item-section>
              <q-item-label class="text-h5">Wyreema Christians Inc.</q-item-label>
            </q-item-section>
        </q-item>

        <q-separator />

        <q-item
          clickable
          tag="a"
          target="_blank"
          href="#"
        >
            <q-item-section
              avatar
            >
              <q-icon name="img:/img/avatar1.png"/>
            </q-item-section>
            <q-item-section>
              <q-item-label>John Doe</q-item-label>
            </q-item-section>
        </q-item>

        <q-separator />

        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import EssentialLink from 'components/EssentialLink.vue'
import { useAuthStore } from 'src/stores/auth-store'
import { useRouter } from 'vue-router'
import { useQuasar } from 'quasar'

const linksList = [
  {
    title: 'Docs',
    caption: 'quasar.dev',
    icon: 'school',
    link: 'https://quasar.dev'
  },
  {
    title: 'Github',
    caption: 'github.com/quasarframework',
    icon: 'code',
    link: 'https://github.com/quasarframework'
  },
  {
    title: 'Discord Chat Channel',
    caption: 'chat.quasar.dev',
    icon: 'chat',
    link: 'https://chat.quasar.dev'
  },
  {
    title: 'Forum',
    caption: 'forum.quasar.dev',
    icon: 'record_voice_over',
    link: 'https://forum.quasar.dev'
  },
  {
    title: 'Twitter',
    caption: '@quasarframework',
    icon: 'rss_feed',
    link: 'https://twitter.quasar.dev'
  },
  {
    title: 'Facebook',
    caption: '@QuasarFramework',
    icon: 'public',
    link: 'https://facebook.quasar.dev'
  },
  {
    title: 'Quasar Awesome',
    caption: 'Community Quasar projects',
    icon: 'favourite',
    link: 'https://awesome.quasar.dev'
  }
]

export default defineComponent({
  name: 'MainLayout',

  components: {
    EssentialLink
  },

  setup () {
    const leftDrawerOpen = ref(true)
    const router = useRouter()
    const auth = useAuthStore()
    const $q = useQuasar()
    const show = ref(false)
    const drawState = ref(0)
    const miniState = ref(false)
    const drawOverlay = ref(false)

    $q.loading.show()

    ;(async () => {
      const data = await auth.check()
      if (!data.success) {
        router.replace({ name: 'login-form' })
      } else {
        show.value = true
      }
      $q.loading.hide()
    })()

    return {
      essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer () {
        drawState.value++
        if (drawState.value >= 3) {
          drawState.value = 0
        }
        switch (drawState.value) {
          case 0:
            leftDrawerOpen.value = true
            miniState.value = false
            drawOverlay.value = false
            break
          case 1:
            leftDrawerOpen.value = true
            miniState.value = true
            drawOverlay.value = true
            break
          case 2:
            leftDrawerOpen.value = false
            miniState.value = false
            drawOverlay.value = false
            break
          default:
            break
        }
      },
      toggleDrawMini (request : boolean) {
        if (drawOverlay.value) {
          miniState.value = request
        }
      },
      miniState,
      drawOverlay,
      show
    }
  }
})
</script>
