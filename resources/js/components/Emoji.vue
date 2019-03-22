<template slot="prepend-inner">
    <v-menu offset-y>
                  <template v-slot:activator="{ on }">
                    <v-btn v-on="on" icon flat>
                      <v-icon>insert_emoticon</v-icon>
                    </v-btn>
                  </template>
                  <v-tabs fixed-tabs>
                    <v-tab>
                      <v-icon>face</v-icon>
                    </v-tab>
                    <v-tab>
                      <v-icon>home</v-icon>
                    </v-tab>
                    <v-tab>
                      <v-icon>face</v-icon>
                    </v-tab>
                    <v-tab>
                      <v-icon>face</v-icon>
                    </v-tab>
                    <v-tab>
                      <v-icon>home</v-icon>
                    </v-tab>
                    <v-tab>
                      <v-icon>face</v-icon>
                    </v-tab>
                    <v-tab>
                      <v-icon>face</v-icon>
                    </v-tab>
                    <v-tab>
                      <v-icon>home</v-icon>
                    </v-tab>
                    <v-tab>
                      <v-icon>face</v-icon>
                    </v-tab>
                  </v-tabs>
                </v-menu>
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
