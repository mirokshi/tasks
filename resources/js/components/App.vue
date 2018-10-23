<script>
export default {
  el: '#app',
  name: 'App',
  data: ()({

    drawer: null,
    items: [
      {icon: 'contacts', text: 'Contacts'},
      {icon: 'history', text: 'Frequently contacted'},
      {
        icon: 'keyboard_arrow_up',
        'icon-alt': 'keyboard_arrow_down',
        text: 'Labels',
        model: true,
        children: [
          {icon: 'add', text: 'Create label'}
        ]
      }
    ]

}),

  props:
  {
    source: String
  }
}
</script>
