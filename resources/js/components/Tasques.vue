<template>
  <span>
      <v-dialog v-model="deleteDialog" color="green darkeen-1" fullscreen>
          <v-card>
              TODO DIALOG (DELETE A TASK)
          <v-btn dark flat @click="deleteDialog=false" >X</v-btn>
          </v-card>

      </v-dialog>
      <v-dialog v-model="createDialog" fullscreen>
          TODO DIALOG (CREATE A NEW TASK)
      </v-dialog>
      <v-snackbar :timeout="3000" color="warning" v-model="snackbar" >
          Esto es una SNACKBAR
          <v-btn dark flat @click="snackbar=false" >X</v-btn>
      </v-snackbar>
      <v-toolbar color="grey darken-4">
      <v-menu>
          <v-btn slot="activator" flat >
          <v-icon>more_vert</v-icon>
          </v-btn>
          <!--<v-list>-->
              <!--<v-list-tile>-->
                  <!--<v-list-tile-title>Opcion 1</v-list-tile-title>-->
              <!--</v-list-tile>-->
          <!--</v-list>-->
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
                              :items="users"
                              v-model="user"
                              cleanable
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
          >
              <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: task}">
                    <tr>
                        <td v-text="task.id"></td>
                        <td  v-text="task.name"></td>
                        <td  v-text="task.user_id"></td>
                        <td v-text="task.completed"></td>
                        <td  v-text="task.created_at"></td>
                        <td v-text="task.updated_at"></td>
                        <td>

                            <v-btn icon color="primary" flat title="Muestra una tarea"
                                   @click="show(task)">
                                <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn icon color="success" flat title="Edita una tarea"
                                   @click="update(task)">
                                <v-icon>update</v-icon>
                            </v-btn>
                            <v-btn icon color="error" flat title="Elimina una tarea"
                            @click="showDestroy(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>

                        </td>
                    </tr>
                </template>
          </v-data-table>
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
      deleteDialog: false,
      createDialog:false,
      snackbar: true,
      user: '',
      users: [
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
      dataTasks: [
        {
          id: 1,
          name: 'comprar pan',
          completed: false,
          user_id: 1,
          created_at: 'hace 1 siglo',
          updated_at: 'hace 5 siglo'
        },
        {
          id: 2,
          name: 'comprar leche',
          completed: false,
          user_id: 2,
          created_at: 'hace 1 siglo',
          updated_at: 'hace 5 siglo'
        }
      ],
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'NAME', value: 'name' },
        { text: 'USER ID', value: 'user_id' },
        { text: 'COMPLETED', value: 'comleted' },
        { text: 'CREACION', value: 'created_at' },
        { text: 'ACTUALIZACION', value: 'updated_at' },
        { text: 'ACCION', sortable: false }
      ]
    }
  },
  methods: {
    refresh () {
      this.loading = true
      setTimeout(() => { this.loading = false }, 5000)
      // TODO -> AXIOS
      console.log('TODO REFRESH')
    },
    opcion () {
      console.log('TODO REFRESH')
    },
    showDestroy (task) {
      this.deleteDialog = true
    },
    destroy (task) {
      console.log('TODO DELETE TASK' + task.id)
    },
    showCreate () {
      this.createDialog= true
    },
    create () {
      console.log('TODO CREATE TASK')
    },
    update () {
      console.log('TODO UPDATE TASK')
    },
    show () {
      console.log('TODO SHOW TASK')
    },
    showCreateDialog () {
      console.log('TODO SHOW TASK')
    }

  }

}
</script>

<style>

</style>
