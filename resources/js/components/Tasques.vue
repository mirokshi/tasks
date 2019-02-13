<template><span>
        <span v-if="dataTasks.length > 0">
        <tasks-list :users="users" :uri="uri" :tasks="dataTasks" :tags="tags"></tasks-list>
        <tasks-create :users="users" :uri="uri" @created="add" ></tasks-create>
        </span>
    <span v-else>
            <v-container grid-list-md text-xs-center>
                <v-layout row wrap>
                  <v-flex xs12 md6 offset-md3 class="mt-3">
                      <div class="grey lighten-3" style="width: 240px;height: 240px;padding: 60px;border-radius: 50%;display: inline-flex;">
                            <svg :style="'width:120px;height:120px;fill: ' + this.$vuetify.theme.primary.base + ';'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6.47 9.8A5 5 0 0 1 .2 3.22l3.95 3.95 2.82-2.83L3.03.41a5 5 0 0 1 6.4 6.68l10 10-2.83 2.83L6.47 9.8z"/></svg>
                      </div>
                  </v-flex>
                  <v-flex xs12 md4 offset-md4 class="mt-3">
                      <h1 class="display-1 grey--text text--darken-2"><strong>Uups!</strong> No hi ha cap incidència... teniu el luxe 😛 de poder ser els primers en:</h1>
                  </v-flex>
                </v-layout>
              </v-container>
        </span>
    </span>
</template>

<script>
import TasksCreate from './TasksCreate'
import TasksList from './TasksList'
export default {
  name: 'Tasques',
  components: {
    'tasks-list': TasksList,
    'tasks-create': TasksCreate
  },
  data () {
    return {
      dataTasks: this.tasks
    }
  },
  props: {
    tasks: {
      type: Array,
      required: true
    },
    tags: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    add (task) {
      this.dataTasks.push(task)
    }
  }
}
</script>
