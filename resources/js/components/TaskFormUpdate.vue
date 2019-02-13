<template>
    <v-form>
        <v-text-field v-model="name" label="Nombre" hint="El nombre de la tasca tarea" placeholder="Nombre de la tarea"></v-text-field>

        <!--TODO toggle component? -->
        <!--<toggle></toggle>-->
        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendiente'"></v-switch>

        <v-textarea v-model="description" label="Descripción" hint="bla bla bla..."></v-textarea>

        <user-select v-model="user" :users="dataUsers" label="Usuario"></user-select>

        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancelar
            </v-btn>
            <v-btn color="success" @click="update" :disabled="working" :loading="working">
                <v-icon class="mr-1" >save</v-icon>
                Actualizar
            </v-btn>
        </div>
    </v-form>
</template>

<script>
import Toggle from './Toggle'
export default {
  name: 'TaskFormUpdate',
  components: { Toggle },
  data () {
    return {
      name: this.task.name,
      description: this.task.description,
      completed: this.task.completed,
      user: null,
      dataUsers: this.users,
      working: false
    }
  },
  props: {
    task: {
      type: Object,
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
    task (task) {
      this.updateUser(task)
    }
  },
  methods: {
    updateUser (task) {
      this.user = this.users.find((user) => {
        return parseInt(user.id) === parseInt(task.user_id)
      })
    },
    update () {
      this.working = true
      const newTask = {
        name: this.name,
        description: this.description,
        completed: this.completed,
        user: this.user
      }
      window.axios.put(this.uri + this.task.id, newTask).then((response) => {
        this.$emit('updated', response.data)
        this.$emit('close')
        this.working = false
      }).catch(error => {
        this.$snackbar.showError(error)
        this.working = false
      })
    }
  },
  created () {
    this.updateUser(this.task)
  }
}
</script>
