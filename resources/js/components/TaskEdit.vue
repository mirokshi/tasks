<template>
    <span>
        <v-dialog v-model="dialog" >
        <v-toolbar color="grey darken-3" class="white--text">
            <v-btn flat icon class="white--text" @click="dialog=false">
                <v-icon class="mr-1">close</v-icon>
            </v-btn>
            <v-toolbar-title class="white--text">Create Task</v-toolbar-title>
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
                <task-form :users="users" @close="dialog=false"></task-form>
            </v-card-text>
        </v-card>
    </v-dialog>
         <v-btn v-if="$can('tasks.destroy', task)" :loading="removing === task.id" :disabled="removing === task.id" color="deep-orange lighten-1" flat icon title="Eliminar la tasca"
                @click="destroy(task)">
                            <v-icon>delete</v-icon>
         </v-btn>
    </span>
</template>

<script>
import TaskForm from './TaskForm'
export default {
  name: 'TaskEdit',
  components: {
    'task-form': TaskForm
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
    }
  }
}
</script>
