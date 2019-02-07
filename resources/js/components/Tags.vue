<template>
    <span>
  <v-dialog v-model="editDialog" @keydown.esc="editDialog = false">
            <v-toolbar color="grey darken-3" class="white--text">
            <v-btn flat icon class="white--text" @click="editDialog = false">
                <v-icon class="mr-1">close</v-icon>
            </v-btn>
                <v-toolbar-title class="white--text">Editar Etiquetas</v-toolbar-title>
               <v-spacer></v-spacer>
                <v-btn color="white" flat @click="editDialog = false"><v-icon>exit_to_app</v-icon>SALIR</v-btn>
               <v-btn color="white" flat @click="editDialog = false"><v-icon>save</v-icon>GUARDAR</v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
        <v-form>
            <v-text-field v-model="tagBeingEdited.name" label="Nom" hint="El nom de la tag..."></v-text-field>
            <!--<v-text-field v-model="tagBeingEdited.color" label="Color" hint="Color de la tag"></v-text-field>-->
            <input type="color" v-model="tagBeingEdited.color" label="Color" style="width: 50px; height: 50px;">
          <v-textarea v-model="tagBeingEdited.description" label="Descripción" hint="Descripció"></v-textarea>
            <div class="text-xs-center">
            <v-btn color="grey" @click="editDialog = false"><v-icon class="mr-1">exit_to_app</v-icon>SALIR</v-btn>
               <v-btn color="success" @click="edit()"><v-icon class="mr-1">save</v-icon>GUARDAR</v-btn>
                </div>
        </v-form>
                </v-card-text>
      </v-card>

  </v-dialog>
  <v-dialog v-model="showDialog" @keydown.esc="showDialog = false">
        <v-toolbar color="grey darken-3" class="white--text">
            <v-btn color="white" flat icon @click="showDialog = false"><v-icon class="mr-1">close</v-icon></v-btn>
                 <v-toolbar-title class="white--text">Etiqueta</v-toolbar-title>
               <v-spacer></v-spacer> <v-btn color="white" flat @click="showDialog = false"><v-icon class="mr-1">exit_to_app</v-icon>SALIR</v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
        <v-form>
            <v-text-field  v-model="tagBeingShow.name" label="Nom" hint="El nombre de la etiqueta..." readonly></v-text-field>
            <input type="color" v-model="tagBeingShow.color" disabled style="width: 50px; height: 50px;">
          <v-textarea  v-model="tagBeingShow.description" label="Descripción" hint="Descripción" readonly></v-textarea>
            <div class="text-xs-center">
            <v-btn color="grey" @click="showDialog = false"><v-icon class="mr-1">exit_to_app</v-icon>SALIR</v-btn>
                </div>
        </v-form>
                </v-card-text>
      </v-card>

  </v-dialog>
  <v-dialog v-model="createDialog" @keydown.esc="createDialog = false">
            <v-toolbar color="grey darken-3" class="white--text">
            <v-btn color="white" flat icon @click="createDialog = false"><v-icon class="mr-1">close</v-icon></v-btn>

                 <v-toolbar-title class="white--text">Crear una etiqueta</v-toolbar-title>
               <v-spacer></v-spacer> <v-btn color="white" flat @click="createDialog = false"><v-icon class="mr-1">exit_to_app</v-icon>SALIR</v-btn>
               <v-btn color="white" flat @click="createDialog = false"><v-icon class="mr-1">save</v-icon>GUARDAR</v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
        <v-form>
            <v-text-field v-model="tagBeingCreated.name" label="Nom" hint="El nombre de la etiqueta..."></v-text-field>
            <!--<v-text-field v-model="tagBeingCreated.color" label="Color" hint="#RRGGBB"></v-text-field>-->
            <input type="color" v-model="tagBeingCreated.color" label="Color" style="width: 50px; height: 50px;">
          <v-textarea v-model="tagBeingCreated.description" label="Descripcio" hint="Descripción"></v-textarea>
            <div class="text-xs-center">
            <v-btn color="grey" @click="createDialog = false"><v-icon class="mr-1">exit_to_app</v-icon>SALIR</v-btn>
               <v-btn color="success" @click="create"><v-icon class="mr-1">save</v-icon>GUARDAR</v-btn>
                </div>
        </v-form>
                </v-card-text>
      </v-card>

  </v-dialog>

  <v-toolbar color="secondary">
      <v-toolbar-title class="white--text">Tags {{total}}</v-toolbar-title>
      <v-spacer></v-spacer>

        <v-btn icon dark class="white--text">
            <v-icon>settings</v-icon>
        </v-btn>
        <v-btn icon dark class="white--text" @click="refresh" :loading="loading" :disabled="loading">
            <v-icon>refresh</v-icon>
        </v-btn>

        </v-toolbar>
        <v-card>
        <v-card-title>
            <v-layout row wrap>
                <v-flex xs12>
                    <v-text-field
                            v-model="search"
                            append-icon="search"
                            label="Búsqueda"
                            single-line
                            hide-details
                    ></v-text-field>
                </v-flex>
            </v-layout>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="dataTags"
                    :search="search"
                    no-results-text="No se ha encontrado ningun registro"
                    :loading="loading"
                    no-data-text=""
                    rows-per-page-text="Tags per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                    :pagination.sync="pagination"
                    class="hidden-md-and-down">

                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: tag}">
                    <tr>
                        <td>{{ tag.id}}</td>
                        <td>{{ tag.name}}</td>
                        <td>{{tag.description}}</td>
                        <td><v-icon x-large :color="tag.color">memory</v-icon></td>
                        <td><span :title="tag.created_at_formatted">{{tag.created_at_human}}</span></td>
                        <td><span :title="tag.updated_at_formatted">{{tag.updated_at_human}}</span></td>
                        <td>
                        <v-btn v-if="$can('tags.update', tag)" color="teal lighten-1" icon flat title="Modificar la etiqueta"
                               @click="showEdit(tag)">
                            <v-icon>border_color</v-icon>
                        </v-btn>
                            <v-btn v-if="$can('tags.show', tag)" color="indigo accent-1" icon flat
                                   @click="showShow(tag)">
                            <v-icon>visibility</v-icon>
                        </v-btn>
                        <v-btn v-if="$can('tags.destroy', tag)" :loading="removing === tag.id" :disabled="removing === tag.id" color="error" flat icon title="Eliminar la etiqueta"
                               @click="destroy(tag)">
                            <v-icon>delete</v-icon>
                        </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-card>
        <v-btn
                fab
                bottom
                right
                color="pink"
                fixed
                class="white--text"
                @click="showCreate"
                v-if="$can('user.tags.store')"
        >
            <v-icon>add</v-icon>

        </v-btn>
    </span>
</template>

<script>
export default{
  name: 'Tags',
  data () {
    return {
      name: '',
      description: '',
      color: '',
      showName: '',
      showDescription: '',
      showCompleted: false,
      dataTags: this.tags,
      tagBeingRemoved: '',
      tagBeingCreated: {},
      tagBeingShow: '',
      tagBeingEdited: '',
      createDialog: false,
      editDialog: false,
      showDialog: false,
      search: '',
      loading: false,
      creating: false,
      editing: false,
      removing: null,
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'NAME', value: 'name' },
        { text: 'DESCRIPTION', value: 'description' },
        { text: 'COLOR', value: 'completed' },
        { text: 'CREACION', value: 'created_at_timestamp' },
        { text: 'ACTUALIZACION', value: 'updated_at_timestamp' },
        { text: 'ACCIONES', sortable: false, value: 'full_search' }
      ],
      pagination: {
        rowsPerPage: 25
      }
    }
  },
  props: {
    tags: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    },
  },
  methods: {
    refresh () {
      this.loading = true
      window.axios.get(this.uri).then(response => {
        this.$snackbar.showMessage('Se ha actualizado correctamente')
        this.dataTags = response.data
        this.loading = false
      }).catch(error => {
        console.log(error)
        this.loading = false
      })
    },
    create () {
      this.creating = true
      window.axios.post(this.uri, this.tagBeingCreated).then((response) => {
        this.createTag(response.data)
        this.$snackbar.showMessage('Se ha creado correctamente la etiqueta')
        this.refresh()
        this.creating = false
        this.createDialog = false
      }).catch((error) => {
        this.$snackbar.showError(error)
        this.creating = false
        this.createDialog = false
      })
    },
    showCreate () {
      this.createDialog = true
    },
    show (tag) {
      console.log('Show Tag' + tag.id)
    },
    removeTag (tag) {
      this.dataTags.splice(this.dataTags.indexOf(tag), 1)
    },
    editTag (tag) {
      this.dataTags.splice(this.dataTags.indexOf(tag), 1, tag)
    },
    createTag (tag) {
      this.dataTags.splice(0, 0, tag)
    },
    async destroy (tag) {
      let result = await this.$confirm('La etiquetas borradas no se pueden recuperar',
        { title: 'Esta seguro?', buttonTrueText: 'Eliminar', buttonFalseText: 'Cancelar', color: 'error' })
      if (result) {
        this.removing = tag.id
        window.axios.delete(this.uri + tag.id).then(() => {
          this.removeTag(tag)
          this.$snackbar.showMessage('Se ha borrado correctamente la etiqueta')
          this.removing = null
        }).catch(error => {
          this.$snackbar.showError(error)
          this.removing = null
        })
      }
    },
    edit () {
      this.editing = true
      window.axios.put(this.uri + this.tagBeingEdited.id, this.tagBeingEdited).then(() => {
        this.editTag(this.tagBeingEdited)
        this.$snackbar.showMessage('Se ha editado correctamente la etiqueta')
        this.refresh()
        this.editing = false
        this.editDialog = false
      }).catch((error) => {
        this.$snackbar.showError(error)
        this.editing = false
        this.editDialog = false
      })
    },
    showEdit (tag) {
      this.editDialog = true
      this.tagBeingEdited = tag
    },
    showShow (tag) {
      this.showDialog = true
      this.tagBeingShow = tag
    },
    complete (tag) {
      this.tagBeingEdited = tag
      this.edit()
    }
  },
  created () {
    console.log('Usuario logado:')
    console.log(window.laravel_user)
  },
  computed: {
    total () {
      return this.dataTags.length
    }
  }
}
</script>
