<template slot="prepend-inner">
    <v-menu
        v-model="menu"
        top
        offset-y
        slider-color="green"
        :close-on-content-click="false"
    >

        <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon flat>
                <v-icon class="grey--text">insert_emoticon</v-icon>
            </v-btn>
        </template>
        <v-card flat>
            <v-tabs v-model="tabs">
                <v-tab
                    href="#tab1"
                >
                    <v-icon>face</v-icon>
                </v-tab>
                <v-tab
                    href="#tab2"
                >
                    <v-icon>home</v-icon>
                </v-tab>
                <v-tab
                    href="#tab3"
                >
                    <v-icon>alarm</v-icon>
                </v-tab>
                <v-tab
                    href="#tab4"
                >
                    <v-icon>build</v-icon>
                </v-tab>
                <v-tab
                    href="#tab5"
                >
                    <v-icon>done</v-icon>
                </v-tab>
                <v-tab
                    href="#tab6"
                >
                    <v-icon>help</v-icon>
                </v-tab>
                <v-tab
                    href="#tab7"
                >
                    <v-icon>list</v-icon>
                </v-tab>
                <v-tab
                    href="#tab8"
                >
                    <v-icon>lock</v-icon>
                </v-tab>
                <v-tab
                    href="#tab9"
                >
                    <v-icon>print</v-icon>
                </v-tab>
            </v-tabs>
            <v-text-field
                placeholder="Buscar emoji"
                class="mx-3"
            >
            </v-text-field>
            <v-tabs-items v-model="tabs">
                <v-tab-item
                    value="tab1"
                >
                    <v-card flat>
                        <v-card-text>
                            <h2>Gay</h2>
                            {{ text2}}
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item
                    value="tab2"
                >
                    <v-card flat>
                        <v-card-text>
                            <h2>Marica</h2>
                            <v-container fluid grid-list-xs scrollable>
                                <v-layout row wrap>
                                    <v-flex
                                        v-for="i in 40"
                                        :key="i"
                                        xs4
                                    >
                                        <img
                                            :src="`https://randomuser.me/api/portraits/men/${i + 20}.jpg`"
                                            alt="lorem"
                                            class="image"
                                            height="80px"
                                            width="80px"
                                        >
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item
                    value="tab3"
                >
                    <v-card flat>
                        <v-card-text>
                            <h2>Homo</h2>
                            {{ text3}}
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item
                    value="tab4"
                >
                    <v-card flat>
                        <v-card-text>
                            <h2>jajajja</h2>
                            {{ text3}}
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item
                    value="tab5"
                >
                    <v-card flat>
                        <v-card-text>
                            <h2>jujuj</h2>
                            {{ text3}}
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item
                    value="tab6"
                >
                    <v-card flat>
                        <v-card-text>
                            <h2>jojojo</h2>
                            {{ text3}}
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item
                    value="tab7"
                >
                    <v-card flat>
                        <v-card-text>
                            <h2>jijij</h2>
                            {{ text3}}
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item
                    value="tab8"
                >
                    <v-card flat>
                        <v-card-text>
                            <h2>jejeje</h2>
                            {{ text3}}
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item
                    value="tab9"
                >
                    <v-card flat>
                        <v-card-text>
                            <h2>jajaj</h2>
                            {{ text3}}
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs-items>
        </v-card>
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
