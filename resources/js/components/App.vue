<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      drawer: null,
      drawerRight: null,
      items: [
        { icon: 'home', text: 'Welcome', url: '/' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Tasks',
          model: true,
          children: [
            { icon: 'build', text: 'Tasks  PHP', url: '/tasks' },
            { icon: 'build', text: 'Tasks TailWind ', url: '/tasks_vue' },
            { icon: 'build', text: 'Tasques ', url: '/tasques' }
          ]
        },
        { icon: 'help', text: 'Contact', url: '/contact' },
        { icon: 'public', text: 'About', url: '/about' }
      ]
    }
  },
  methods: {
    impersonate($user) {
      if ($user) {
        window.location.href = '/impersonate/take/' + $user
      }
    }
  },

  props:
  {
    source: String
  }
}
</script>
