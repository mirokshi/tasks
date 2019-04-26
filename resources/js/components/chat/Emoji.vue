<template>
    <div class="text-xs-center">
        <v-menu
            v-model="menu"
            open-on-hover
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
            <v-card>
            <v-tabs
                v-model="tabs"
                class="mx-3 mr-3 ml-3"
                grow>
                <v-tab
                    v-for="n in 9"
                    :key="n"
                >
                    <v-icon>public</v-icon>
                </v-tab>
            </v-tabs>
            <v-text-field
                placeholder="Buscar emoji"
                class="mx-3"
            >
            </v-text-field>
            <v-tabs-items v-model="tabs">
            </v-tabs-items>
            </v-card>
        </v-menu>
    </div>
</template>

<script>
export default {
  name: 'Emoji',
  data () {
    return {
      menu: false,
      tabs: ''
    }
  }
}
</script>

<style scoped>

</style>
