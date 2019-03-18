<template>
    <span>
        <v-btn icon flat @click="dialog = true">
            <v-icon>insert_emoticon</v-icon>
        </v-btn>
        <v-menu
            offset-x
            bottom
            v-model="dialog">
            <v-list>

            </v-list>
        </v-menu>
    </span>
</template>

<script>
export default {
  name: 'Emoji',
  data () {
    return {
      dialog: false
    }
  }
}
</script>

<style scoped>

</style>
