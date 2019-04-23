<template>
    <div class="text-xs-center">
        <v-expand-transition>
            <div v-show="expand">
                <v-layout row>
                    <v-flex xs12 sm6 offset-sm3>
                        <v-card>
                            <v-img
                                src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
                                height="200px"
                            >
                            </v-img>

                            <v-card-title primary-title>
                                <div>
                                    <div class="headline">Top western road trips</div>
                                    <span class="grey--text">1,000 miles of wonder</span>
                                </div>
                            </v-card-title>

                            <v-card-actions>
                                <v-btn flat>Share</v-btn>
                                <v-btn flat color="purple">Explore</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn icon @click="show = !show">
                                    <v-icon>{{ show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
                                </v-btn>
                            </v-card-actions>

                            <v-slide-y-transition>
                                <v-card-text v-show="show">
                                    Lore Ipsum
                                </v-card-text>
                            </v-slide-y-transition>
                        </v-card>
                    </v-flex>
                </v-layout>
            </div>
        </v-expand-transition>
        <v-layout justify-space-around>
            <v-btn
                icon
                flat
                @click="expand = !expand"
            ><v-icon>public</v-icon></v-btn>
        </v-layout>
    </div>
</template>

<script>
export default {
  name: 'Emoji',
  data () {
    return {
      dialog: false,
      expand: false
    }
  }
}
</script>

<style scoped>

</style>
