<template>
    <span>
        <v-data-iterator class="hidden-lg-and-up"
                         :items="dataTasks"
                         :search="search"
                         no-results-text="No se ha encontrado ninguna coincidencia"
                         no-data-text="No hay datos disponibles"
                         rows-per-page-text="Treas por pagina"
                         :rows-per-page-items="[5,10,25,50,100,{'text':'Todos','value':-1}]"
                         :loading="loading"
                         :pagination.sync="pagination"
                         content-tag="v-layout"
                         row
                         wrap
        >
                <v-flex
                    slot="item"
                    slot-scope="{item:task}"
                    xs12
                    sm6
                    md4
                    lg3
                    class="pb-2"
                >
                <v-card

                    class="mx-auto"
                    color="primary lighten-5"
                    dark
                    v-touch={" left: () => call('delete', task)"}
                >
    <v-card-title>
      <v-icon
          large
          left
      >
     assignment
      </v-icon>
      <span class="subheading font-weight-light text-uppercase grey--text">{{task.name}}</span>
    </v-card-title>

    <v-card-actions>
      <v-list-tile class="grow">
        <v-list-tile-avatar color="grey darken-3">
              <img class="elevation-6" v-if="task.user_gravatar" :src="task.user_gravatar" alt="avatar">
                                <img class="elevation-6" v-else src="https://www.gravatar.com/avatar/" alt="avatar">
        </v-list-tile-avatar>
            <tasks-tags :task="task" :task-tags="task.tags" :tags="tags" @change="refresh(false)"></tasks-tags>
        <v-layout
            align-center
            justify-end
        >
            <v-dialog v-if="dialog" v-model="dialog" @keydown.esc.stop.prevent="dialog=false">
          <task-destroy :task="task" @removed="removeTask" :uri="uri"></task-destroy>
                </v-dialog>
          <task-update :users="users" :task="task" @updated="updateTask" :uri="uri"></task-update>
            <share-task :task="task" :menu="true"></share-task>
        </v-layout>
      </v-list-tile>
    </v-card-actions>
  </v-card>
                </v-flex>
            </v-data-iterator>
    </span>
</template>
<script>
import TasksTags from './tasks/TasksTags'
import TaskDestroy from './tasks/TaskDestroy'
import TaskUpdate from './tasks/TaskUpdate'
import EventBus from './../eventBus'
import ShareTask from './tasks/ShareTask'

export default {
  name: 'DataIterator',
  components: {
    'tasks-tags': TasksTags,
    'task-destroy': TaskDestroy,
    'task-update': TaskUpdate,
    'share-task': ShareTask
  },
  data () {
    return {
      loading: false,
      search: '',
      dialog: false,
      dataTasks: this.tasks,
      pagination: {
        rowsPerPage: 25
      }
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
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    },
    updateTask (task) {
      this.refresh()
    },
    call (action, object) {
      EventBus.$emit('touch-' + action, object)
    }
  }
}
</script>
