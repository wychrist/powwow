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
      :width="370"
      :breakpoint="600"
      bordered
      :mini-to-overlay="drawOverlay"
      persistent

      style="overflow-x: hidden!important;"
    >
      <q-list>
        <q-item
          header
          clickable
          tag="a"
          to=""
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

        <q-expansion-item
          expand-separator
          icon="img:/img/avatar1.png"
          label="John Doe"
          group="main_menu"
        >
          <q-item
            clickable
            tag="a"
            target="_blank"
            href="#"
            :active=true
            active-class="menu-item-active"
            class="menu-item-inset-1"
          >
            <q-item-section
              avatar
            >
              <q-icon name="person" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Profile</q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            clickable
            @click="onLogout"
            class="menu-item-inset-1"
          >
              <q-item-section
                avatar
              >
                <q-icon name="logout"/>
              </q-item-section>
              <q-item-section>
                <q-item-label>Logout</q-item-label>
              </q-item-section>
          </q-item>
        </q-expansion-item>

        <q-separator />

        <MainMenu
          v-for="MenuItem in MenuData"
          :key="MenuItem.id"
          :menu="MenuItem"
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
import MainMenu from 'src/components/MenuSlot.vue'
import { MenuItem } from 'src/composibles/main_menu_composible'
import { useAuthStore } from 'src/stores/auth-store'
import { useRouter } from 'vue-router'
import { useQuasar } from 'quasar'
import { useLogout } from 'src/composibles/login_composible'
import '@quasar/extras/fontawesome-v5'

const MenuData: Array<MenuItem> = [
  {
    id: 1,
    label: 'Docs',
    // link: 'https://quasar.dev',
    icon: 'school',
    active: false,
    hasActiveChild: true,
    children: [
      {
        id: 11,
        label: 'Docs',
        link: 'https://quasar.dev',
        icon: 'school',
        active: false,
        hasActiveChild: false,
        children: [],
        parentID: null
      },
      {
        id: 12,
        label: 'Github',
        link: 'https://github.com/wychrist',
        icon: 'fa-brands fa-github',
        active: false,
        hasActiveChild: true,
        children: [
          {
            id: 121,
            label: 'Sub 1.2.1',
            link: 'https://github.com/wychrist',
            icon: undefined,
            active: false,
            hasActiveChild: true,
            children: [
              {
                id: 1211,
                label: 'Sub 1.2.1.1',
                link: 'https://github.com/wychrist',
                icon: undefined,
                active: false,
                hasActiveChild: true,
                children: [
                  {
                    id: 12111,
                    label: 'Sub 1.2.1.1.1',
                    link: 'https://github.com/wychrist',
                    icon: undefined,
                    active: false,
                    hasActiveChild: true,
                    children: [
                      {
                        id: 121111,
                        label: 'Sub 1.2.1.1.1.1',
                        link: 'https://github.com/wychrist',
                        icon: undefined,
                        active: false,
                        hasActiveChild: true,
                        children: [
                          {
                            id: 1211111,
                            label: 'Sub 1.2.1.1.1.1.1',
                            link: 'https://github.com/wychrist',
                            icon: undefined,
                            active: false,
                            hasActiveChild: false,
                            children: [
                              {
                                id: 12111111,
                                label: 'Sub 1.2.1.1.1.1.1.1',
                                link: 'https://github.com/wychrist',
                                icon: undefined,
                                active: false,
                                hasActiveChild: false,
                                children: [],
                                parentID: 1211111
                              }
                            ],
                            parentID: 121111
                          },
                          {
                            id: 1211112,
                            label: 'Sub 1.2.1.1.1.1.2',
                            link: 'https://github.com/wychrist',
                            icon: undefined,
                            active: true,
                            hasActiveChild: false,
                            children: [],
                            parentID: 121111
                          }
                        ],
                        parentID: 12111
                      },
                      {
                        id: 121112,
                        label: 'Sub 1.2.1.1.2',
                        link: 'https://github.com/wychrist',
                        icon: undefined,
                        active: false,
                        hasActiveChild: false,
                        children: [],
                        parentID: 12111
                      }
                    ],
                    parentID: 1211
                  }
                ],
                parentID: 121
              }
            ],
            parentID: 12
          }
        ],
        parentID: 1
      }
    ],
    parentID: null
  },
  {
    id: 2,
    label: 'Top 2',
    // link: 'https://quasar.dev',
    icon: undefined,
    active: false,
    hasActiveChild: false,
    children: [
      {
        id: 21,
        label: 'Mid 2.1',
        link: 'https://quasar.dev',
        icon: undefined,
        active: false,
        hasActiveChild: false,
        children: [],
        parentID: 2
      },
      {
        id: 22,
        label: 'Mid 2.2',
        link: 'https://github.com/wychrist',
        icon: 'fa-brands fa-github',
        active: false,
        hasActiveChild: false,
        children: [
          {
            id: 221,
            label: 'Sub 2.2.1',
            link: 'https://github.com/wychrist',
            icon: undefined,
            active: false,
            hasActiveChild: false,
            children: [
              {
                id: 2211,
                label: 'Sub 2.2.1.1',
                link: 'https://github.com/wychrist',
                icon: undefined,
                active: false,
                hasActiveChild: false,
                children: [],
                parentID: 221
              }
            ],
            parentID: 22
          }
        ],
        parentID: 2
      }
    ],
    parentID: null
  },
  {
    id: 3,
    label: 'Top 3',
    link: 'https://github.com/wychrist',
    icon: undefined,
    active: false,
    hasActiveChild: false,
    children: [],
    parentID: null
  }
  //,
  /* {
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
  } */
]

export default defineComponent({
  name: 'MainLayout',

  components: {
    MainMenu
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
    const { logout } = useLogout()

    $q.loading.show()

    const onLogout = () => {
      logout().then(() => {
        router.replace({ name: 'login-form' })
      })
    }

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
      MenuData,
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
            if ($q.platform.is.mobile) { // Skip mini state if mobile as mini will not function on mobile
              leftDrawerOpen.value = false
              miniState.value = false
              drawOverlay.value = false
              drawState.value = 2
            } else {
              leftDrawerOpen.value = true
              miniState.value = true
              drawOverlay.value = true
            }
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
      show,
      // fabGithub,
      onLogout
    }
  }
})
</script>

<style>

</style>
