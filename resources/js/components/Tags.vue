<template>
    <v-layout row>
        <v-flex xs12 sm10 offset-sm1>
            <v-card>
                <snackbar></snackbar>
                <v-dialog max-width="400" v-model="deleteDialog">
                    <v-card>
                        <v-card-title class="headline">Delete tag</v-card-title>
                        <v-card-text>You're going to delete <strong>{{ this.selectedTag.name }}</strong> tag. Are you sure?</v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="green darken-1" dark @click="deleteDialog = false">CANCEL</v-btn>
                            <v-btn color="red darken-1" dark @click="destroy()">DELETE</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="createDialog" fullscreen>
                    <v-toolbar dark color="deep-purple darken-4">
                        <v-btn icon dark @click="createDialog = false">
                            <v-icon>close</v-icon>
                        </v-btn>
                        <v-toolbar-title>New tag</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn dark flat :disabled="$v.$invalid" @click="add">Save</v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                    <v-card>
                        <v-card-text>
                            <v-form>
                                <v-text-field
                                        label="Name"
                                        color="light-blue"
                                        class="pr-2"
                                        v-model="selectedTag.name"
                                        @input="$v.selectedTag.name.$touch()"
                                        @blur="$v.selectedTag.name.$touch()"
                                        :error-messages="nameErrors"
                                ></v-text-field>
                                <v-text-field
                                        label="Color"
                                        color="light-blue"
                                        v-model="selectedTag.color"
                                        @input="$v.selectedTag.color.$touch()"
                                        @blur="$v.selectedTag.color.$touch()"
                                        :error-messages="colorErrors"
                                ></v-text-field>
                                <v-textarea
                                        label="Description"
                                        color="light-blue"
                                        v-model="selectedTag.description"
                                        @input="$v.selectedTag.description.$touch()"
                                        @blur="$v.selectedTag.description.$touch()"
                                        :error-messages="descriptionErrors"
                                ></v-textarea>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="editDialog" fullscreen>
                    <v-card>
                        <v-toolbar dark color="green darken-2">
                            <v-btn icon dark @click="editDialog = false">
                                <v-icon>close</v-icon>
                            </v-btn>
                            <v-toolbar-title>Edit tag {{ this.selectedTag.name }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-toolbar-items>
                                <v-btn dark flat :disabled="$v.$invalid" @click="update">Save</v-btn>
                            </v-toolbar-items>
                        </v-toolbar>
                        <v-container>
                            <v-layout row>
                                <v-flex xs12 md6>
                                    <v-text-field
                                            label="Name"
                                            color="light-blue"
                                            class="pr-2"
                                            v-model="selectedTag.name"
                                            @input="$v.selectedTag.name.$touch()"
                                            @blur="$v.selectedTag.name.$touch()"
                                            :error-messages="nameErrors"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12 md6>
                                    <v-text-field
                                            label="Color"
                                            color="light-blue"
                                            v-model="selectedTag.color"
                                            @input="$v.selectedTag.color.$touch()"
                                            @blur="$v.selectedTag.color.$touch()"
                                            :error-messages="colorErrors"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout row>
                                <v-flex xs12>
                                    <v-textarea
                                            label="Description"
                                            color="light-blue"
                                            v-model="selectedTag.description"
                                            @input="$v.selectedTag.description.$touch()"
                                            @blur="$v.selectedTag.description.$touch()"
                                            :error-messages="descriptionErrors"
                                    ></v-textarea>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="infoDialog" fullscreen>
                    <v-card>
                        <v-toolbar dark color="blue">
                            <v-btn icon dark @click="infoDialog = false">
                                <v-icon>close</v-icon>
                            </v-btn>
                            <v-toolbar-title><strong>{{ this.selectedTag.name }}</strong> tag info</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-toolbar-items>
                                <v-btn dark flat @click="showEdit(selectedTag)">Edit</v-btn>
                            </v-toolbar-items>
                        </v-toolbar>
                        <v-container>
                            <v-layout row>
                                <v-flex xs12 md6>
                                    <v-text-field
                                            label="Name"
                                            color="light-blue"
                                            class="pr-2"
                                            v-model="this.selectedTag.name"
                                            readonly
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12 md6>
                                    <v-text-field
                                            label="Color"
                                            color="light-blue"
                                            v-model="this.selectedTag.color"
                                            readonly
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout row>
                                <v-flex xs12>
                                    <v-textarea
                                            label="Description"
                                            color="light-blue"
                                            v-model="this.selectedTag.description"
                                            readonly
                                    ></v-textarea>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                </v-dialog>
                <v-toolbar color="deep-purple darken-4" dark>
                    <v-toolbar-title class="font-weight-bold">Tags ({{ total }})</v-toolbar-title>

                    <v-spacer></v-spacer>
                    <v-btn title="Refresh data" icon @click="searchForTags">
                        <v-icon>refresh</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-card>
                    <v-card-title>
                        <v-spacer></v-spacer>
                        <v-flex xs12 sm12>
                            <v-text-field
                                    label="Search..."
                                    v-model="search"
                                    append-icon="search"
                                    color="deep-purple darken-4"
                            ></v-text-field>
                        </v-flex>
                    </v-card-title>
                    <v-data-table
                            :headers="headers"
                            :items="getTags"
                            class="elevation-2 p-3"
                            :search="search"
                            :loading="loading"
                    >
                        <v-progress-linear slot="progress"
                                           color="deep-purple darken-4"
                                           indeterminate
                        ></v-progress-linear>
                        <template slot="items" slot-scope="{ item: tag }">
                            <td>{{ tag.id }}</td>
                            <td class="text-xs-left">{{ tag.name }}</td>
                            <td class="text-xs-center">{{ tag.description }}</td>
                            <td class="text-xs-left"><div class="elevation-2" :style="'background-color:' + tag.color+';border-radius: 4px;height: 15px;width: 15px;'"></div></td>
                            <td class="text-xs-center">{{ tag.created_at_human }}</td>
                            <td class="text-xs-center">{{ tag.updated_at_human}}</td>
                            <td class="text-xs-center">
                                <v-btn v-if="$can('tags.show')" @click="showInfo(tag)" fab small icon>
                                    <v-icon title="Show tag" color="blue">visibility</v-icon>
                                </v-btn>
                                <v-btn v-if="$can('tags.update')" @click="showEdit(tag)" fab small icon>
                                    <v-icon title="Edit tag" color="green darken-2">edit</v-icon>
                                </v-btn>
                                <v-btn v-if="$can('tags.destroy')" @click="showDestroy(tag)" fab small icon>
                                    <v-icon title="Delete tag" color="error">delete</v-icon>
                                </v-btn>
                            </td>
                        </template>
                    </v-data-table>
                </v-card>
                <v-btn
                        v-if="$can('tags.store')"
                        bottom
                        fab
                        right
                        color="deep-purple darken-4"
                        fixed
                        dark
                        class="elevation-4"
                        @click="showCreate"
                >
                    <v-icon>add</v-icon>
                </v-btn>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, minLength, maxLength } from 'vuelidate/lib/validators'
export default {
  name: 'Tags',
  data () {
    return {
      privateMode: false,
      data: 'Tags',
      dataTags: [],
      errorMsg: '',
      filter: 'all',
      search: '',
      errorMessage: '',
      loading: false,
      headers: [
        { text: 'ID', value: 'id', align: 'left', sortable: true },
        { text: 'Name', value: 'name', align: 'left', sortable: true },
        { text: 'Description', value: 'description', align: 'center', sortable: true },
        { text: 'Color', value: 'color', align: 'left', sortable: true },
        { text: 'Created at', value: 'created_at', align: 'center', sortable: true },
        { text: 'Updated at', value: 'update_at', align: 'center', sortable: true },
        { text: 'Actions', align: 'center', sortable: false }
      ],
      deleteDialog: false,
      createDialog: false,
      editDialog: false,
      infoDialog: false,
      selectedTag: {
        name: '',
        description: '',
        color: '',
        user_id: '',
        user: ''
      }
    }
  },
  mixins: [validationMixin],
  validations: {
    selectedTag: {
      name: { required },
      description: { required },
      color: { required, minLength: minLength(7), maxLength: maxLength(7) }
    }
  },
  methods: {
    add () {
      window.axios.post(this.getStoreURL, this.selectedTag).then((response) => {
        this.createDialog = false
        this.searchForTags()
        this.$snackbar.showMessage('Tag ' + response.data.name + ' created!')
        this.selectedTag = {
          name: '',
          description: '',
          color: ''
        }
      }).catch((error) => {
        this.errorMsg = error.message
      })
    },
    update () {
      window.axios.put(this.getUpdateURL + this.selectedTag.id, this.selectedTag).then((response) => {
        this.editDialog = false
        console.log(response.data)
        this.searchForTags()
        this.$snackbar.showMessage('Tag ' + this.selectedTag.name + ' updated!')
        this.selectedTag = {
          name: '',
          description: '',
          color: ''
        }
      }).catch((error) => {
        this.errorMsg = error.message
      })
    },
    destroy () {
      window.axios.delete(this.getDestroyURL + this.selectedTag.id).then((response) => {
        this.deleteDialog = false
        this.$snackbar.showMessage('Tag ' + this.selectedTag.name + ' successfully deleted!')
        this.dataTags.splice(this.dataTags.indexOf(this.selectedTag), 1)
      }).catch((error) => {
        this.errorMsg = error.message
      })
    },
    searchForTags () {
      this.loading = true
      window.axios.get(this.getIndexURL).then((response) => {
        this.loading = false
        this.dataTags = response.data
      }).catch((error) => {
        this.loading = false
        this.errorMessage = error.response.data
      })
    },
    showCreate () {
      this.selectedTag.name = ''
      this.selectedTag.description = ''
      this.selectedTag.color = ''
      this.createDialog = true
    },
    showDestroy (tag) {
      this.selectedTag = tag
      this.deleteDialog = true
    },
    showEdit (tag) {
      this.selectedTag = tag
      this.infoDialog = false
      this.editDialog = true
    },
    showInfo (tag) {
      this.selectedTag = tag
      this.infoDialog = true
    }
  },
  props: {
    'tags': {
      type: Array,
      required: false
    },
    'private': {
      type: Boolean
    }
  },
  created () {
    if (this.tags.length === 0) {
      this.searchForTags()
    } else {
      this.dataTags = this.tags
    }
    if (this.private === true) {
      this.privateMode = true
    }
  },
  computed: {
    total () {
      return this.dataTags.length
    },
    getTags () {
      return this.dataTags
    },
    nameErrors () {
      const errors = []
      if (!this.$v.selectedTag.name.$dirty) return errors
      !this.$v.selectedTag.name.required && errors.push('Name field is required!')
      return errors
    },
    descriptionErrors () {
      const errors = []
      if (!this.$v.selectedTag.description.$dirty) return errors
      !this.$v.selectedTag.description.required && errors.push('Description field is required!')
      return errors
    },
    colorErrors () {
      const errors = []
      if (!this.$v.selectedTag.color.$dirty) return errors
      !this.$v.selectedTag.color.required && errors.push('Color field is required!')
      !this.$v.selectedTag.color.minLength && errors.push('Color format is incorrect! Use hex format (#RRGGBB)')
      !this.$v.selectedTag.color.maxLength && errors.push('Color format is incorrect! Use hex format (#RRGGBB)')
      return errors
    },
    getIndexURL () {
      return '/api/v1/tag'
    },
    getStoreURL () {
      return '/api/v1/tag'
    },
    getUpdateURL () {
      return '/api/v1/tag/'
    },
    getDestroyURL () {
      return '/api/v1/tag/'
    }
  }
}
</script>

<style scoped>
</style>
