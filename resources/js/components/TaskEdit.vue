<template>
    <span>
        <v-dialog v-model="dialog" @keydown.esc="dialog=false">
        <v-toolbar color="grey darken-3" class="white--text">
            <v-btn flat icon class="white--text" @click="dialog=false">
                <v-icon class="mr-1">close</v-icon>
            </v-btn>
            <v-toolbar-title class="white--text">Edit Task</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn flat class="white--text" @click="dialog=false">
                <v-icon class="mr-1">exit_to_app</v-icon>
                EXIT
            </v-btn>
            <v-btn flat class="white--text">
                <v-icon class="mr-1">save</v-icon>
                ADD
            </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-text>
                <task-form-edit
                        :users="users"
                        :uri="uri"
                        @close="dialog=false"
                        @edited="$emit('edited')"
                ></task-form-edit>
            </v-card-text>
        </v-card>
    </v-dialog>
         <v-btn

                 icon
                 flat
                 title="Editar la tarea"
                 color="success"
                @click="showUpdate(task)"
         >
             <v-icon>edit</v-icon>
         </v-btn>
    </span>
</template>

<script>
import TaskFormEdit from './TaskFormEdit'
export default {
  name: 'TaskEdit',
  components: {
    'task-form-edit': TaskFormEdit
  },
  data () {
    return {
      dialog: false
    }
  },
  props: {
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
    edited (task) {
      this.$emit('edited', task)
    }
  }
}
</script>
