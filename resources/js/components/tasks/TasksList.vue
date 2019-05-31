<template>
    <span>
        <v-toolbar color="primary lighten-2">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon class="white--text">
                <v-icon>settings</v-icon>
            </v-btn>
            <v-btn icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
                <v-icon>refresh</v-icon>
            </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-title>
                <v-layout row wrap>
                    <v-flex lg3 class="pr-2">
                        <v-select
                            label="Estat"
                            :items="filters"
                            v-model="filter"
                            item-text="name"
                        >
                        </v-select>
                    </v-flex>
                    <v-flex lg4 class="pr-2">
                        <user-select  @refresh="refresh(false)" @cleared="user=null" v-model="user" :users="dataUsers"  label="Filtrar por usuario" class="pr-4"></user-select>
                    </v-flex>
                    <v-flex lg5>
                         <v-text-field
                             append-icon="search"
                             label="Buscar"
                             v-model="search"
                         ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="dataTasks"
                :search="search"
                no-results-text="No se ha encontrado ningún registro"
                no-data-text="No hay datos disponibles"
                rows-per-page-text="Tareas por pagina"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Todos','value':-1}]"
                :loading="loading"
                :pagination.sync="pagination"
                class="hidden-md-and-down"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: task}" v-for="task in filteredTasks">
                    <tr>
                        <td>{{ task.id }}</td>
                        <td>
                            <span :title="task.description">{{ task.name }}</span>
                        </td>
                        <td>
                            <v-avatar :title="task.user_name">
                                <img v-if="task.user_gravatar" :src="task.user_gravatar" alt="avatar">
                                <img v-else src="https://www.gravatar.com/avatar/" alt="avatar">
                            </v-avatar>
                        </td>
                        <td>
                            <toggle :value="task.completed" uri="/api/v1/completed_task" active-text="Completada" unactive-text="Pendiente" :resource="task"></toggle>
                        </td>
                        <td>
                            <tasks-tags :task="task" :task-tags="task.tags" :tags="tags" @change="refresh(false)"></tasks-tags>
                        </td>
                        <td>
                            <span :title="task.created_at_formatted">{{ task.created_at_human}}</span>
                        </td>
                        <td>
                            <span :title="task.updated_at_formatted">{{ task.updated_at_human}}</span>
                        </td>
                        <td>
                            <task-show  :users="users" :task="task"></task-show>
                            <task-update :users="users" :task="task" @updated="updateTask" :uri="uri"></task-update>
                            <task-destroy :task="task" @removed="removeTask" :uri="uri"></task-destroy>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <data-iterator :users="users" :uri="uri" :tags="tags" :tasks="tasks"></data-iterator>
        </v-card>
    </span>
</template>

<script>
import Toggle from '../Toggle'
import TaskDestroy from './TaskDestroy'
import TaskUpdate from './TaskUpdate'
import TaskShow from './TaskShow'
import TasksTags from './TasksTags'
import UserSelect from '../users/UserSelect'
import DataIterator from './DataIterator'

var filters = {
  Todas: function (tasks) {
    return tasks
  },
  Completadas: function (tasks) {
    return tasks.filter(function (task) {
      return task.completed
    })
  },
  Pendientes: function (tasks) {
    return tasks.filter(function (task) {
      return !task.completed
    })
  }
}
export default {
  name: 'TasksList',
  components: {
    'toggle': Toggle,
    'task-destroy': TaskDestroy,
    'task-update': TaskUpdate,
    'task-show': TaskShow,
    'tasks-tags': TasksTags,
    'user-select': UserSelect,
    'data-iterator': DataIterator
  },
  data () {
    return {
      user: null,
      selectedUser: null,
      loading: false,
      dataTasks: this.tasks,
      dataUsers: this.users,
      search: '',
      filter: 'Todas',
      filters: [
        'Completadas',
        'Pendietes',
        'Todas'
      ],
      pagination: {
        rowsPerPage: 25
      },
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'NAME', value: 'name' },
        { text: 'USER', value: 'user_id' },
        { text: 'COMPLETED', value: 'completed' },
        { text: 'TAGS', value: 'tags' },
        { text: 'CREATED', value: 'created_at_timestamp' },
        { text: 'UPDATED', value: 'updated_at_timestamp' },
        { text: 'ACTIONS', sortable: false, value: 'ful1l_search' }
      ]
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
  watch: {
    tasks (newTasks) {
      this.dataTasks = newTasks
    },
    user (user) {
      if (user == null) { this.user = null }
    }
  },
  computed: {
    total () {
      return this.dataTasks.length
    },
    filteredTasks () {
      if (!this.user) {
        return filters[this.filter](this.dataTasks)
      } else {
        return filters[this.filter](this.filteredTasksUsers)
      }
    },
    filteredTasksUsers () {
      let tasks = []
      console.log('this. user ' + this.user)
      this.dataTasks.map((task) => {
        if (task.user_id === this.user.id) {
          tasks.push(task)
        }
      })
      return tasks
    }
  },
  methods: {
    setFilter (newFilter) {
      this.filter = newFilter
    },
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    },
    updateTask (task) {
      this.refresh(false)
    },
    refresh (message = true) {
      this.loading = true
      window.axios.get(this.uri).then(response => {
        this.dataTasks = response.data
        this.loading = false
        if (message) this.$snackbar.showMessage('Tareas actualizadas correctamente')
      }).catch(() => {
        this.loading = false
      })
    }
  },
  created () {
    console.log('Registering laravel echo')
    console.log('User id: ')
    console.log(window.laravel_user.id)
    console.log('Is admin: ')
    console.log(window.laravel_user.admin)
    if (window.laravel_user.admin) {
      window.Echo.private('Tasques')
        .listen('TaskUncompleted', (e) => {
          console.log('TaskUncompleted Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskCompleted', (e) => {
          console.log('TaskCompleted Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskDeleted', (e) => {
          console.log('TaskDeleted Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskStored', (e) => {
          console.log('TaskStored Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskUpdate', (e) => {
          console.log('TaskUpdate Received')
          console.log(e.task)
          this.refresh()
        })
    } else {
      window.Echo.private('App.User.' + window.laravel_user.id)
        .listen('TaskUncompleted', (e) => {
          console.log('TaskUncompleted Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskCompleted', (e) => {
          console.log('TaskCompleted Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskDeleted', (e) => {
          console.log('TaskDestroy Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskStored', (e) => {
          console.log('TaskStored Received')
          console.log(e.task)
          this.refresh()
        })
        .listen('TaskUpdate', (e) => {
          console.log('TaskUpdate Received')
          console.log(e.task)
          this.refresh()
        })
    }
  }
}
</script>
