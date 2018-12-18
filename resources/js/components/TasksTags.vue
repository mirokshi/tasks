<template>
    <span>
        <v-chip v-for="tag in task.tags" :key="tag.id" v-text="tag.name" :color="tag.color" @dblclick="removeTag"></v-chip>
        <v-btn icon><v-icon>remove</v-icon></v-btn>
        <v-btn icon @click="dialog = true"><v-icon>add</v-icon></v-btn>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title> Añadir etiqueta a la tarea</v-card-title>
                <v-card-text>
                    <v-combobox
                        v-model="selectedTags"
                        :items="tags"
                        multiple
                        chips
                        item-text="name"
                    >
                        <template
                            slot="selection"
                            slot-scope="{ data: tag }"
                        >
                            <v-chip
                                :selected="data.selected"
                                :disabled="data.disabled"
                                :key="JSON.stringify(data.item.name)"
                                class="v-chip--select-multi"
                                @input="data.parent.selectItem(data.item.name)"
                            >
                                {{ data.item }}
                            </v-chip>

                        </template>
                    </v-combobox>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn flat @click="dialog = false">CANCELAR</v-btn>
                    <v-btn color="grey darken-3" flat @click="addTag">AÑADIR</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </span>
</template>
<script>
export default {
  name: 'TasksTag',
  data () {
    return {
      dialog: false,
      selectedTags: {}
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    tags: {
      type: Array,
      required: true
    }
  },
  methods: {
    removeTag () {
      console.log('TODO')
      window.axios.delete('/api/v1/tasks' + this.task.id + '/tag/' + this.tag).then(response => {
        this.$snackbar.showMessage('Etiqueta eliminada correctamente')
      }).catch(error => {
        this.$snackbar.showError(error)
      })
    },
    addTag () {
      console.log('TODO')
      let tag = {}
      window.axios.post('/api/v1/tasks/' + this.task.id + '/tag').then(response => {
        this.$snackbar.showMessage('Etiqueta añadida correctamente')
      }).catch(error => {
        this.$snackbar.showError(error)
      })
    }
  }

}
</script>
