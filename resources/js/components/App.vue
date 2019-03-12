<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      drawer: false,
      drawerRight: false,
      loginForm: false,
      registerForm: false
    }
  },
  created () {
    if (window.localStorage.getItem('PRIMARY_COLOR_KEY')) this.$vuetify.theme.primary = window.localStorage.getItem('PRIMARY_COLOR_KEY')
  }
}
//   methods: {
//     impersonate(user) {
//       if (user) {
//         window.location.href = '/impersonate/take/' + user
//       }
//     }
//   }
// }
</script>
