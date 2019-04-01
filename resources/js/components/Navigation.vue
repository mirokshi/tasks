
<template>
    <v-navigation-drawer
        v-model="dataDrawer"
        fixed
        app
        clipped
        v-touch="{ left: () => dataDrawer =true, right: () => dataDrawer = false}"
    >
        <v-list dense>
            <template v-for="item in items">
                <v-layout
                    v-if="item.heading"
                    :key="item.heading"
                    row
                    align-center
                >
                    <v-flex xs6>
                        <v-subheader v-if="item.heading">
                            {{ item.heading }}
                        </v-subheader>
                    </v-flex>
                    <v-flex xs6 class="text-xs-center">
                        <a href="#!" class="body-2 black--text">EDIT</a>
                    </v-flex>
                </v-layout>
                <v-list-group
                    v-else-if="item.children"
                    v-model="item.model"
                    :key="item.text"
                    :prepend-icon="item.model ? item.icon : item['icon-alt']"
                    append-icon=""
                >
                    <v-list-tile slot="activator" :href="item.url">
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile
                        v-for="(child, i) in item.children"
                        :key="i"
                        :href="child.url"
                        :style="selectedStyle(child)"
                    >
                        <v-list-tile-action v-if="child.icon">
                            <v-icon color="primary lighten-3">{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title class="grey--text text--darken-4">
                                {{ child.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-list-tile v-else :key="item.text" :href="item.url"
                             :style="selectedStyle(item)"
                             >
                    <v-list-tile-action>
                        <v-icon color="primary lighten-3">{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title class="grey--text text--darken-4">
                            {{ item.text }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
  name: 'Navigation',
  data () {
    return {
      dataDrawer: this.drawer,
      icons: [
        { nombre: 'home', color: 'red', value: 'home' },
        { nombre: 'tasks', color: 'red', value: 'build' },
        { nombre: 'tasks_vue', color: 'red', value: 'build' },
        { nombre: 'tasques', color: 'red', value: 'build' },
        { nombre: 'tags', color: 'red', value: 'build' },
        { nombre: 'contact', color: 'red', value: 'build' },
        { nombre: 'about', color: 'red', value: 'build' },
        { nombre: 'cahngelog', color: 'red', value: 'build' },
        { nombre: 'notifications', color: 'red', value: 'build' }
      ],
      items: [
        { icon: 'home', text: 'Home', url: '/' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Tasques',
          model: false,
          children: [
            { icon: 'build', text: 'Tasques amb PHP', url: '/tasks' },
            { icon: 'build', text: 'Tasques tailwind', url: '/tasks_vue' },
            { icon: 'build', text: 'Tasques', url: '/tasques' },
            { icon: 'build', text: 'Tags', url: '/tags' }
          ]
        },
        { icon: 'help', text: 'Contact', url: '/contact' },
        { icon: 'public', text: 'About', url: '/about' },
        { icon: 'assessment', text: 'Changelog', url: '/changelog' },
        { icon: 'notifications', text: 'Notifications', url: '/notifications' },
        { icon: 'weekend', text: 'Mobile', url: '/mobile' },
        { icon: 'contact_mail', text: 'NewsLetters', url: '/newsletters' },
        { icon: 'timer', text: 'Clock', url: '/clock' },
        { icon: 'chat', text: 'Chat', url: '/chat' },
        { icon: 'pool', text: 'Users', url: '/users' }
      ]
    }
  },
  props: {
    drawer: {
      Type: Boolean,
      default: false
    }
  },
  watch: {
    dataDrawer (drawer) {
      this.$emit('input', drawer)
    },
    drawer (drawer) {
      this.dataDrawer = drawer
    }
  },
  model: {
    prop: 'drawer',
    event: 'input'
  },
  methods: {
    isSelectedItem (item) {
      const currentPath = window.location.pathname
      return currentPath === item.url
      // const selected = this.items.indexOf(this.items.find(item => item.url === currentPath))
      // this.items[selected].selected = true
    },
    selectedStyle (item) {
      if (this.isSelectedItem(item)) {
        return {
          'border-right': '5px solid #F0B429',
          'background-color': '#c3f8ec',
          'font-size': '1em'
        }
      }
    }
  }
}
</script>
