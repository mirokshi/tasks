<template>
    <span>
        <v-toolbar color="secondary">
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
                        <ul style="list-style-type:none;">
                            <li><v-icon color="red" @click="setFilter('completed')">lock</v-icon> : Completadas</li>
                            <li><v-icon color="blue" @click="setFilter('active')">lock_open</v-icon> : Pendientes</li>
                            <li><v-icon color="green" @click="setFilter('all')">done_all</v-icon> : Todos</li>
                        </ul>
                    </v-flex>
                    <v-flex lg4 class="pr-2">
                        <user-select @cleared="selectedUser = null" v-model="selectedUser" :users="dataUsers"  label="Filtrar por usuario" class="pr-4"></user-select>
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
                :items="filteredTasks && filteredUsers"
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
            <v-data-iterator class="hidden-lg-and-up"
                             :items="filteredTasks && filteredUsers"
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
          <task-destroy :task="task" @removed="removeTask" :uri="uri"></task-destroy>
          <task-update :users="users" :task="task" @updated="updateTask" :uri="uri"></task-update>
        </v-layout>
      </v-list-tile>
    </v-card-actions>
  </v-card>
                </v-flex>
            </v-data-iterator>
        </v-card>
    </span>
</template>

<script>
import Toggle from './Toggle'
import TaskDestroy from './TaskDestroy'
import TaskUpdate from './TaskUpdate'
import TaskShow from './TaskShow'
import TasksTags from './TasksTags'
import UserSelect from './UserSelect'

var filters = {
  all: function (dataTasks) {
    return dataTasks
  },
  completed: function (dataTasks) {
    return dataTasks.filter(function (task) {
      return task.completed
    })
  },
  active: function (dataTasks) {
    return dataTasks.filter(function (task) {
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
    'user-select': UserSelect
  },
  data () {
    return {
      filter: 'all',
      selectedUser: null,
      loading: false,
      dataTasks: this.tasks,
      dataUsers: this.users,
      search: '',
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
    }
  },
  computed: {
    total () {
      return this.dataTasks.length
    },
    filteredTasks () {
      return filters[this.filter](this.dataTasks)
    },
    filteredUsers () {
      let tasks = this.dataTasks
      if (this.selectedUser !== null) {
        tasks = tasks.filter((task) => {
          return task.user_id === this.selectedUser.id
        })
      }
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
      this.refresh()
    },
    refresh (message = true) {
      this.loading = true
      window.axios.get(this.uri).then(response => {
        this.dataTasks = response.data
        this.loading = false
        if (message) this.$snackbar.showMessage('Tareas actualizadas correctamente')
      }).catch(error => {
        console.log(error)
        this.loading = false
      })
    }
  }
}
</script>
