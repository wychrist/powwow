<template>
  <q-expansion-item
      v-if="menu.children.length != 0"
      expand-separator
      :icon="icon_level(menu.icon,level)"
      :label="menu.label"
      :group="group_name(menu.parentID,level)"
    >
    <MainMenu
        v-for="MenuItem in menu.children"
        :key="MenuItem.id"
        :menu="MenuItem"
        :level="level + 1"
      />
  </q-expansion-item>
  <q-item
      v-else
      clickable
      tag="a"
      target="_blank"
      href="#"
    >
      <q-item-section
        avatar
      >
        <q-icon :name="icon_level(menu.icon,level)"/>
      </q-item-section>

      <q-item-section>
        <q-item-label>{{ menu.label }}</q-item-label>
      </q-item-section>
    </q-item>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { MenuItem } from 'src/composibles/main_menu_composible'
import type { PropType } from 'vue'

export default defineComponent({
  name: 'MainMenu',
  props: {
    menu: {
      type: Object as PropType<MenuItem>,
      required: true
    },
    level: {
      type: Number,
      default: 0
    }
  },
  setup () {
    return {
      icon_level (icon: string | undefined, level: number): string {
        if (icon === undefined) {
          level %= 5
          switch (level) {
            case 1:
              return 'fa-regular fa-circle fa-fw'
            case 2:
              return 'fa-solid fa-circle fa-fw'
            case 3:
              return 'fa-regular fa-dot-circle fa-fw'
            case 4:
              return 'fa-solid fa-dot-circle fa-fw'
            default:
              return 'fa-solid fa-question fa-fw'
          }
        } else {
          return icon
        }
      },
      group_name (parentID: number | null, level: number): string {
        let str
        if (level === 0 || parentID === null) {
          str = 'main_menu'
        } else {
          str = 'main_menu-'.concat(level.toString()).concat('-').concat(parentID.toString())
        }
        console.log(str)
        return str
      }
    }
  }
})
</script>
