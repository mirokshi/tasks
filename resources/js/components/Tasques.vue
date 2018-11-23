<template>
  <span>
      <v-dialog v-model="deleteDialog">
            <v-card>
                <v-card-title class="headline">Seguro?</v-card-title>
                <v-card-text>
                    Esta opercion no se puede deshacer
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                      <v-btn
                              color="green darken-1"
                              flat
                              @click="deleteDialog = false"
                      >
                        Cancelar
                      </v-btn>
                      <v-btn
                              color="error darken-1"
                              flat
                              @click="destroy"
                              :loading="removing"
                              :disabled="removing"
                      >
                        Confirmar
                      </v-btn>
        </v-card-actions>
        </v-card>
        </v-dialog>
      <v-dialog v-model="createDialog" fullscreen hide-overlay transition="dialog-bottom-transition"
                @keydown.esc="createDialog=false">
          <v-toolbar color="grey darken-3" class="white--text">
              <v-btn flat icon class="white--text" @click="createDialog=false">
              <v-icon class="mr-1">close</v-icon>
              </v-btn>
            <v-toolbar-title class="white--text">Create Task</v-toolbar-title>
               <v-spacer></v-spacer>
            <v-btn flat  class="white--text" @click="createDialog=false">
                <v-icon class="mr-1">exit_to_app</v-icon>
                EXIT
            </v-btn>
          <v-btn flat class="white--text">
              <v-icon class="mr-1">save</v-icon>
              SAVE
          </v-btn>
            </v-toolbar>
          <v-card>
              <v-card-text>
                   <v-card-text>
                <v-form>
                    <v-text-field v-model="name" label="Nombre" hint="El nombre de la tarea"></v-text-field>
                    <v-switch v-model="completed" :label="completed ? 'Completada':'Pendiente'"></v-switch>
                    <v-textarea v-model="description" label="Descripcion" hint="Descripcion"></v-textarea>
                    <v-autocomplete :items="dataUsers" label="Usuario" item-text="name"></v-autocomplete>
                     <v-btn @click="createDialog=false" ><v-icon class="mr-1">exit_to_app</v-icon></v-btn>
                    <v-btn><v-icon class="mr-1">save</v-icon></v-btn>
                </v-form>
            </v-card-text>
              </v-card-text>
          </v-card>
      </v-dialog>
      <v-dialog v-model="editDialog" fullscreen hide-overlay transition="dialog-bottom-transition"
      @keydown.esc="editDialog=false">
        <v-toolbar color="grey darken-3" class="white--text">
          <v-btn flat icon class="white--text" @click="editDialog=false">
              <v-icon class="mr-1">close</v-icon>
          </v-btn>
            <v-toolbar-title class="white--text">Editar Tasks</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn flat  class="white--text" @click="editDialog=false">
                <v-icon class="mr-1">exit_to_app</v-icon>
                EXIT
            </v-btn>
          <v-btn flat class="white--text">
              <v-icon class="mr-1">save</v-icon>
              SAVE
          </v-btn>
</v-toolbar>
          <v-card>
            <v-card-text>
                <v-form>
                    <v-text-field v-model="name" label="Nombre" hint="El nombre de la tarea"></v-text-field>
                    <v-switch v-model="completed" :label="completed ? 'Completada':'Pendiente'"></v-switch>
                    <v-textarea v-model="description" label="Descripcion" hint="Descripcion"></v-textarea>
                    <v-autocomplete :items="dataUsers" label="Usuario" item-text="name"></v-autocomplete>
                     <v-btn @click="editDialog=false"><v-icon class="mr-1">exit_to_app</v-icon></v-btn>
                    <v-btn><v-icon class="mr-1">save</v-icon></v-btn>
                </v-form>
            </v-card-text>
        </v-card>

      </v-dialog>
      <v-dialog v-model="showDialog" fullscreen hide-overlay transition="dialog-bottom-transition"
                @keydown.esc="showDialog=false">
         <v-toolbar  color="grey darken-3" class="white--text">
             <v-btn flat icon class="white--text" @click="showDialog=false">
              <v-icon class="mr-1">close</v-icon>
          </v-btn>
             <v-toolbar-title>Tasks</v-toolbar-title>
             <v-spacer></v-spacer>
              <v-btn flat class="white--text" @click="showDialog=false">
                  <v-icon class="mr-1">exit_to_app</v-icon>
                  CLOSE
              </v-btn>
          <v-btn flat class="white--text">
              <v-icon class="mr-1">save</v-icon>
                SAVE
          </v-btn>
         </v-toolbar>
          <v-card>
              <v-card-text>
                <v-form>
                    <v-text-field v-model="name" label="Nombre" hint="El nombre de la tarea"></v-text-field>
                    <v-switch v-model="completed" :label="completed ? 'Completada':'Pendiente'"></v-switch>
                    <v-textarea v-model="description" label="Descripcion" hint="Descripcion"></v-textarea>
                    <v-autocomplete :items="dataUsers" label="Usuario" item-text="name"></v-autocomplete>
                     <v-btn @click="showDialog=false"><v-icon class="mr-1">exit_to_app</v-icon></v-btn>
                    <v-btn><v-icon class="mr-1">save</v-icon></v-btn>
                </v-form>
            </v-card-text>
          </v-card>
      </v-dialog>
      <!--<v-snackbar :timeout="snackbarTimeout" :color="snackbarColor" v-model="snackbar" >-->
          <!--{{ snackbarMessage }}-->
          <!--<v-btn dark flat @click="snackbar=false" >X</v-btn>-->
      <!--</v-snackbar>-->
      <v-toolbar color="grey darken-4">
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
                              ></v-select>
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
                  no-results-text="No se ha encontrado ningun regustro"
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
                        <td  v-text="task.name"></td>
                        <td>
                             <v-avatar :title="task.user_name">
                                <img :src="task.user_gravatar" alt="avatar">
                            </v-avatar>
                        </td>
                        <td v-text="task.completed ? 'Completada' : 'Pendent'"></td>
                        <td>
                             <span :title="task.created_at_formatted">{{ task.created_at_human}}</span>
                        </td>
                        <td>
                            <span :title="task.updated_at_formatted">{{task.updated_at_human}}</span>
                        </td>
                        <td>

                            <v-btn icon color="primary" flat title="Muestra una tarea"
                                   @click="showTasks(task)">
                                <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn icon color="success" flat title="Edita una tarea"
                                   @click="showUpdate(task)">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn icon color="error" flat title="Elimina una tarea"
                            @click="showDestroy(task)">
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
                              <v-list-tile-content>Completed</v-list-tile-content>
                              <v-list-tile-content class="align-end">task.completed</v-list-tile-content>
                          </v-list-tile>
                      </v-list>
                  </v-card>
              </v-flex>
          </v-data-iterator>
      </v-card>
      <v-btn
              @click="showCreate"
              fab
              bottom
              right
              fixed
              color ="pink"
      class="white--text">
          <v-icon>add</v-icon>
      </v-btn>
  </span>
</template>

<script>

export default {
  name: 'Tasques',
  data () {
    return {
      dataUsers: this.users,
      name: '',
      completed: false,
      description: '',
      deleteDialog: false,
      editDialog: false,
      createDialog: false,
      showDialog: false,
      snackbar: true,
      snackbarMessage: '',
      snackbarTimeout: 3000,
      snackbarColor: 'success',
      user: '',
      usersold: [
        'Jose',
        'Manuel',
        'Emilio'
      ],
      filter: 'Todos',
      filters: [
        'Todos',
        'Completados',
        'Pendientes'
      ],
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      loading: false,
      taskBeginRemoved: null,
      removing: false,
      editing: false,
      dataTasks: this.tasks,
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'NAME', value: 'name' },
        { text: 'USER ID', value: 'user_id' },
        { text: 'COMPLETED', value: 'completed' },
        { text: 'CREACION', value: 'created_at_timestamp' },
        { text: 'ACTUALIZACION', value: 'updated_at_timestamp' },
        { text: 'ACCION', sortable: false, value: 'full_search' }
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
    }
  },
  methods: {
    refresh () {
      this.loading = true
      // setTimeout(() => { this.loading = false }, 5000)
      // ¡!¡! CAMBIA SEGUN EL CASO
      window.axios.get('/api/v1/user/tasks').then(response => {
        this.showMessage('Se ha actualizado correctamente')
        this.dataTasks = response.data
        this.loading = false
      }).catch(error => {
        this.loading = false
        this.showError(error)
      })
      // window.axios.get('/api/v1/user/tasks').then().catch()
    },
    opcion1 () {
      console.log('TODO OPCION1')
    },
    showDestroy (task) {
      this.deleteDialog = true
      this.taskBeginRemoved = task
    },
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    },
    destroy () {
      this.removing = true
      window.axios.delete('/api/v1/user/tasks/' + this.taskBeginRemoved.id).then(() => {
        // this.refresh() //Problema -> rendimiento
        // this.dataTasks.splice(this.dataTasks.indexOf(this.taskBeginRemoved), 1)
        this.removeTask(this.taskBeginRemoved)
        this.deleteDialog = false
        this.taskBeginRemoved = null
        this.showMessage('Se ha borrado correctamente')
        this.removing = false
      }).catch(error => {
        this.showError(error)
        this.removing = false
      })
    },
    // SNACKNBAR
    showMessage (message) {
      this.snackbarMessage = message
      this.snackbarColor = 'success'
      this.snackbar = true
    },
    showError (error) {
      this.snackbarMessage = error.message
      this.snackbarColor = 'error'
      this.snackbar = true
    },
    // SNACKBAR END
    showUpdate () {
      this.editDialog = true
    },
    showCreate () {
      this.createDialog = true
    },
    showTasks () {
      this.showDialog = true
    },
    update () {
      this.editDialog = false
    },
    create () {
      this.createDialog = false
    },
    show () {
      this.showDialog = false
    }
  },
  created(){
    console.log('USUARIO LAGADO')
    console.log(window.laravel_user)
  }
}
</script>
