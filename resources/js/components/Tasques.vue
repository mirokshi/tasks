<template>
  <span>
      <v-dialog v-model="editDialog" @keydown.esc="editDialog=false">
        <v-toolbar color="grey darken-3" class="white--text">
          <v-btn flat icon class="white--text" @click="editDialog=false">
              <v-icon class="mr-1">close</v-icon>
          </v-btn>
            <v-toolbar-title class="white--text">Editar Tareas</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn flat  class="white--text" @click="editDialog=false">
                <v-icon class="mr-1">exit_to_app</v-icon>
                SALIR
            </v-btn>
          <v-btn
                  flat
                  class="white--text"
                  @click="edit"
                  :loading="editing"
                  :disabled="editing"
          >
              <v-icon class="mr-1">save</v-icon>
              GUARDAR
          </v-btn>
</v-toolbar>
          <v-card>
            <v-card-text>
                <v-form>
                    <v-text-field v-model="taskBeingEdited.name" label="Nombre" hint="El nombre de la tarea"></v-text-field>
                    <v-switch v-model="taskBeingEdited.completed" :label="taskBeingEdited.completed ? 'Completada':'Pendiente'"></v-switch>
                    <v-textarea v-model="taskBeingEdited.description" label="Descripcion" hint="Descripcion"></v-textarea>
                    <v-autocomplete :items="dataUsers" v-model="taskBeingEdited.user_id" label="Usuario" item-text="name" item-value="id"></v-autocomplete>
                    <div>
                     <v-btn @click="editDialog=false"><v-icon class="mr-1">exit_to_app</v-icon></v-btn>
                    <v-btn @click="edit"> <v-icon class="mr-1">save</v-icon></v-btn>
                        </div>
                </v-form>
            </v-card-text>
        </v-card>

      </v-dialog>
      <v-dialog v-model="showDialog" @keydown.esc="showDialog=false">
         <v-toolbar  color="grey darken-3" class="white--text">
             <v-btn flat icon class="white--text" @click="showDialog=false">
              <v-icon class="mr-1">close</v-icon>
          </v-btn>
             <v-toolbar-title>Tasks</v-toolbar-title>
             <v-spacer></v-spacer>
              <v-btn flat class="white--text" @click="showDialog=false">
                  <v-icon class="mr-1">exit_to_app</v-icon>
              </v-btn>
         </v-toolbar>
          <v-card>
             <v-card-text>
                    <v-form>
                        <v-text-field v-model="takeTask.name" label="Nombre" readonly></v-text-field>
                        <v-switch v-model="takeTask.completed" :label="takeTask.completed ? 'Completada':'Pendiente'" readonly></v-switch>
                        <v-textarea v-model="takeTask.description" label="Descripción" readonly></v-textarea>
                        <v-autocomplete :items="dataUsers" label="Usuario" v-model="takeTask.user" item-text="name" return-object readonly></v-autocomplete>
                        <div class="text-xs-center">
                            <v-btn @click="showDialog=false">
                                <v-icon class="mr-2">exit_to_app</v-icon>
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
          </v-card>
      </v-dialog>
       <v-toolbar color="grey darken-1">
      <v-menu>
          <v-btn slot="activator" flat >
          <v-icon>more_vert</v-icon>
          </v-btn>
         <v-list>
                    <v-list-tile @click="opcion1">
                        <v-list-tile-title>Opción 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
      </v-menu>
      <v-toolbar-title class="white--text">Tasques {{ total }}</v-toolbar-title>
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
              <v-layout>
                  <v-flex xs3 class="mr-2">
                      <v-select
                              label="Filters"
                              :items="filters"
                              v-model="filter"
                      ></v-select>
                  </v-flex>
                      <v-flex xs4 class="mr-2">
                      <v-select
                              label="User"
                              :items="dataUsers"
                              v-model="users"
                              item-text="name"
                              clearable
                              >
                      </v-select>
                  </v-flex>
                  <v-flex xs5>
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
                  no-results-text="No se ha encontrado ningun registro"
                  no-data-text="No hay datos disponibles"
                  rows-per-page-text="Tareas por pagina"
                  :rows-per-page-items="[5,10,25,50,100,200,{'text':'Todos', 'value' : -1}]"
                  :loading="loading"
                  :pagination.sync="pagination"
                  class="hidden-md-and-down"
          >
              <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: task}">
                    <tr>
                        <td>{{task.id}}</td>
                        <td>{{task.name}}</td>
                        <td>
                             <v-avatar :title="task.user_name">
                                <img :src="task.user_gravatar" alt="avatar">
                            </v-avatar>
                        </td>
                          <!--<v-switch v-model="task.completed" :label="task.completed ? 'Completada' : 'Pendiente'"></v-switch>-->
                        <toggle :completed="task.completed" :id="task.id"></toggle>
                        <!--<task-completed-toggle :completed="task"> </task-completed-toggle>-->
                        <td>
                             <span :title="task.created_at_formatted">{{ task.created_at_human}}</span>
                        </td>
                        <td>
                            <span :title="task.updated_at_formatted">{{task.updated_at_human}}</span>
                        </td>
                        <td>
                            <v-btn v-if="$can('tasks.update', task)" color="teal lighten-1" icon flat title="Modificar la tarea"
                                     @click="showEdit(task)">
                            <v-icon>border_color</v-icon>
                            </v-btn>
                            <v-btn v-if="$can('tasks.show', task)" color="indigo accent-1" icon flat title="Mostrar tarea"
                                   @click="showTasks(task)">
                            <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn v-if="$can('tasks.destroy', task)" :loading="removing === task.id" :disabled="removing === task.id" color="deep-orange lighten-1" flat icon title="Eliminar la tarea"
                                   @click="destroy(task)">
                            <v-icon>delete</v-icon>
                        </v-btn>
                        </td>
                    </tr>
                </template>
          </v-data-table>
          <v-data-iterator
                  class="hidden-lg-and-up"
                  :items="dataTasks"
                  :search="search"
                  no-results-text="No se ha encontrado ningun registro"
                  no-data-text="No hay datos disponibles"
                  rows-per-page-text="Tareas por pagina"
                  :rows-per-page-items="[5,10,25,50,100,200,{'text':'Todos', 'value' : -1}]"
                  :loading="loading"
                  :pagination.sync="pagination"
          >
              <v-flex
                      slot="item"
                      slot-scope="{item:task}"
                      xs12
                      sm6
                      md4
              >
                  <v-card class="mb-1">
                      <v-card-title v-text="task.name"></v-card-title>
                      <v-list dense>
                          <v-list-tile>
                              <v-list-tile-content>Completed:</v-list-tile-content>
                              <v-list-tile-content class="align-end">{{ task.completed ? 'Completada':'Pendiente'}}</v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile>
                              <v-list-tile-content>User:</v-list-tile-content>
                              <v-list-tile-content class="align-end">
                                  <v-avatar :title="task.user_name">
                                <img :src="task.user_gravatar" alt="avatar">
                                </v-avatar>
                              </v-list-tile-content>
                            </v-list-tile>
                      </v-list>
                  </v-card>
              </v-flex>
          </v-data-iterator>
      </v-card>
      <task-create :users="users"></task-create>
  </span>
</template>

<script>
import TaskCompletedToggle from './TaskCompletedToggle'
import Toggle from './Toggle'
import TaskCreate from './TaskCreate.vue'
export default {
  name: 'Tasques',
  components: {
    'task-completed-toggle': TaskCompletedToggle,
    'toggle': Toggle,
    'task-create': TaskCreate
  },
  data () {
    return {
      user: '',
      takeTask: '',
      dataUsers: this.users,
      name: '',
      completed: false,
      description: '',
      editDialog: false,
      createDialog: false,
      showDialog: false,
      snackbar: true,
      snackbarMessage: '',
      snackbarTimeout: 3000,
      snackbarColor: 'success',
      taskBeingEdited: '',
      filter: 'all',
      filters: [
        'Todos',
        'Completedos',
        'Pendientes'
      ],
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      loading: false,
      creating: false,
      removing: false,
      editing: null,
      dataTasks: this.tasks,
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'NAME', value: 'name' },
        { text: 'USER', value: 'user_id' },
        { text: 'COMPLETED', value: 'completed' },
        { text: 'CREACION', value: 'created_at_timestamp' },
        { text: 'ACTUALIZACION', value: 'updated_at_timestamp' },
        { text: 'ACCIONES', sortable: false, value: 'full_search' }
      ]
    }
  },
  props: {
    tasks: {
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
    setFilter (newFilter) {
      this.filter = newFilter
    },
    opcion1 () {
      console.log('TODO OPCION1')
    },
    refresh () {
      this.loading = true
      window.axios.get(this.uri).then(response => {
        this.$snackbar.showMessage('Se ha actualizado correctamente')
        this.dataTasks = response.data
        this.loading = false
      }).catch(error => {
        this.$snackbar.showError(error.message)
        this.loading = false
      })
    },
    create (task) {
      console.log('task')
    },
    // destroyWithPromises () {
    //   this.$confirm().then(
    //     window.axios.then
    //   ).catch (
    //
    //   )
    //   },
    async destroy (task) {
      // ES6 async await
      let result = await this.$confirm('Las tareas borrados no se puede recuperar',
        {
          title: 'Estas seguro?',
          buttonTrueText: 'Eliminar',
          buttonFalseText: 'Cancelar'
        })
      if (result) {
        this.removing = task.id
        window.axios.delete(this.uri + task.id).then(() => {
          this.refresh()
          this.removeTask(task)
          this.deleteDialog = false
          task = null
          this.$snackbar.showMessage('Se ha borrado correctamente la tarea')
          this.removing = task.id
        }).catch(error => {
          this.$snackbar.showError(error.message)
          this.removing = task.id
        })
      }
    },
    edit () {
      this.editing = true
      window.axios.put(this.uri + this.taskBeingEdited.id, {
        user_id: this.taskBeingEdited.user_id,
        name: this.taskBeingEdited.name,
        completed: this.taskBeingEdited.completed,
        description: this.taskBeingEdited.description
      }).then(() => {
        this.editTask(this.taskBeingEdited)
        this.$snackbar.showMessage('Se ha editado correctamente la tarea')
      }).catch((error) => {
        this.$snackbar.showError(error)
        this.editing = false
        this.editDialog = false
      }).finally(() => {
        this.editing = false
        this.editDialog = false
      })
    },
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    },
    editTask ($task) {
      this.dataTasks.splice(this.dataTasks.indexOf($task), 1, $task)
    },
    showEdit (task) {
      this.editDialog = true
      this.taskBeingEdited = task
    },
    showTasks (task) {
      this.takeTask = task
      this.showDialog = true
    },
    show (task) {
      this.showDialog = false
    }
  },
  created () {
    console.log('USUARIO LOGADO')
    console.log(window.laravel_user)
  },
  computed: {
    total () {
      return this.dataTasks.length
    },
    filteredTasks () {
      return filters[this.filter](this.dataTasks)
    }
  }
}
</script>
