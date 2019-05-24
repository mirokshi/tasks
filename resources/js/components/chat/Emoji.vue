<template>
    <div class="text-xs-center">
        <v-menu
            v-model="menu"
            top
            offset-y
            slider-color="green"
            :close-on-content-click="false"
            @keydown.esc="menu=false"
        >
            <template v-slot:activator="{ on }">
                <v-btn
                    icon
                    flat
                    color="green"
                    v-on="on"
                >
                    <v-icon>insert_emoticon</v-icon>
                </v-btn>
            </template>
            <!--yarn add v-emChat.vue
ChatChannel.vue
ChatChannels.vue
ChatMessageAdd.vueoji-picker-->
            <VEmojiPicker :pack="pack" @select="selectEmoji" labelSearch="Buscar" />
        </v-menu>
    </div>
</template>

<script>
import VEmojiPicker from 'v-emoji-picker'
import packData from 'v-emoji-picker/data/emojis.json'
export default {
  name: 'Emoji',
  components: {
    VEmojiPicker
  },
  data () {
    return {
      menu: false,
      pack: packData,
      dataEmoji: []
    }
  },
  props: ['value'],
  methods: {
    selectEmoji (emoji) {
      this.dataEmoji += emoji.emoji
      console.log(this.dataEmoji)
      this.$emit('input', this.dataEmoji)
    }
  }
}
</script>

<style scoped>

</style>
