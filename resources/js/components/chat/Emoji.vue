<template>
    <div class="text-xs-center">
        <v-menu
            v-model="menu"
            top
            offset-y
            slider-color="green"
            :close-on-content-click="false"
        >
            <template v-slot:activator="{ on }">
                <v-btn
                    icon
                    flat
                    v-on="on"
                >
                    <v-icon>insert_emoticon</v-icon>
                </v-btn>
            </template>
            <VEmojiPicker :pack="pack" @select="selectEmoji" labelSearch="Buscar" />
            <!--<v-card>-->
            <!--<v-tabs-->
                <!--v-model="tabs"-->
                <!--class="mx-3 mr-3 ml-3"-->
                <!--grow>-->
                <!--<v-tab-->
                    <!--v-for="n in 9"-->
                    <!--:key="n"-->
                <!--&gt;-->
                    <!--<v-icon>public</v-icon>-->
                <!--</v-tab>-->
            <!--</v-tabs>-->
            <!--<v-text-field-->
                <!--placeholder="Buscar emoji"-->
                <!--class="mx-3"-->
            <!--&gt;-->
            <!--</v-text-field>-->
            <!--<v-tabs-items v-model="tabs">-->
            <!--</v-tabs-items>-->
            <!--</v-card>-->
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
      tabs: '',
      pack: packData,
      dataEmoji: this.emoji
    }
  },
  props: {
    emoji: {
      type: String,
      required: false
    }
  },
  methods: {
    selectEmoji (emoji) {
      console.log(emoji)
        console.log("emoji.emoji");
        console.log(emoji.emoji)
        this.dataEmoji = emoji.emoji
        console.log("dataEmoji");
        console.log(this.dataEmoji)
    }
  }
}
</script>

<style scoped>

</style>
