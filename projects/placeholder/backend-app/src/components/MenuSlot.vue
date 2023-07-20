<template>
  <q-expansion-item
      v-if="menu.children.length != 0"
      expand-separator
      :icon="icon_level(menu.icon,level)"
      :label="menu.label"
      :model-value="menu.active || menu.hasActiveChild"
      :group="group_name(menu.parentID,level)"
      :class="inset_class(menu.parentID, level, menu.active, menu.hasActiveChild)"
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
      style="border-left: {{level * 3}}px solid black"
      :class="inset_class(menu.parentID, level, menu.active, menu.hasActiveChild)"
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
      },
      inset_class (parentID: number | null, level: number, active: boolean, activeChild: boolean): string {
        let str
        if (level === 0 || parentID === null) {
          str = ''.concat(active ? 'menu-item-active' : '').concat(activeChild ? 'menu-item-inset-active' : '')
        } else {
          level %= 9
          str = 'menu-item-inset-'.concat(level.toString()).concat(active ? ' menu-item-active' : '')// .concat(activeChild ? ' menu-item-inset-active' : '')
        }
        console.log(str)
        return str
      }
    }
  }
})
</script>

<style>
.menu-item-inset-1 {
  border-left: 3px solid black;
  background-color: rgb(244, 244, 244)
}
.menu-item-inset-2 {
  border-left: 3px solid rgb(12, 12, 12);
  background-color: rgb(232, 232, 232)
}
.menu-item-inset-3 {
  border-left: 3px solid rgb(24, 24, 24);
  background-color: rgb(220, 220, 220)
}
.menu-item-inset-4 {
  border-left: 3px solid rgb(36, 36, 36);
  background-color: rgb(208, 208, 208)
}
.menu-item-inset-5 {
  border-left: 3px solid rgb(48, 48, 48);
  background-color: rgb(196, 196, 196)
}
.menu-item-inset-6 {
  border-left: 3px solid rgb(60, 60, 60);
  background-color: rgb(184, 184, 184)
}
.menu-item-inset-7 {
  border-left: 3px solid rgb(72, 72, 72);
  background-color: rgb(172, 172, 172)
}
.menu-item-inset-8 {
  border-left: 3px solid rgb(84, 84, 84);
  background-color: rgb(160, 160, 160)
}
.menu-item-active{
  background-color: #87a8d4 !important;
}
.menu-item-inset-active{
  border-right: 3px solid #87a8d4 !important;
}
</style>
