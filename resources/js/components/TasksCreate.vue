<template>
    <span>
        <v-dialog v-model="dialog"  @keydown.esc.stop.prevent="dialog=false">
            <v-toolbar color="primary darken-3" class="white--text">
            <v-btn flat icon class="white--text" @click="dialog=false">
                <v-icon>close</v-icon>
            </v-btn>
            <v-toolbar-title class="white--text">Crear Tarea</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
            <v-card>
                <v-card-text>
                    <task-form-create :users="users"  :uri="uri" @close="dialog=false" :tags="tags" @created="created" ></task-form-create>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-btn
            v-can="'tasks.store'"
            @click="dialog = true"
            fab
            bottom
            right
            fixed
            color="pink"
            class="white--text"
        >
                <v-icon>add</v-icon>
            </v-btn>
    </span>
</template>

<script>
import TaskFormCreate from './TaskFormCreate'
export default {
  name: 'TasksCreate',
  components: {
    'task-form-create': TaskFormCreate
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
    tags: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    created (task) {
      this.$emit('created', task)
    }
  }
}
</script>
