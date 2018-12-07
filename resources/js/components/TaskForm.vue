<template>
    <v-form>
        <v-text-field v-model="name" label="Nom" hint="El nombre de la tarea..." placeholder="Nombre de la tarea"></v-text-field>
        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendiente'"></v-switch>
        <v-textarea v-model="description" label="Descripción" hint="Descripción de la tarea..."></v-textarea>
        <v-autocomplete v-model="user_id" :items="dataUsers" label="Usuario" item-text="name" item-value="id"></v-autocomplete>
        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancelar
            </v-btn>
            <v-btn color="success" @click="add">
                <v-icon class="mr-1" >save</v-icon>
                Agregar
            </v-btn>
        </div>
    </v-form>
</template>
<script>
export default {
  name: 'TaskForm',
  data () {
    return {
      name: '',
      completed: false,
      description: '',
      dataUsers: this.users,
      loading: false,
      user_id: null
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    },
    addUri: {
      type: String,
      default: '/api/v1/tasks'
    }
  },
  methods: {
    add () {
      this.loading = true
      const task = {
        user_id: this.user_id,
        name: this.name,
        completed: this.completed,
        description: this.description
      }
      window.axios.post(this.addUri, task).then(response => {
        this.$snackbar.showMessage('Tarea creado a correctamente')
        this.$emit('created', response.data)
        this.loading = false
        this.$emit('close')
      }).catch(error => {
        this.$snackbar.showError(error.data)
        this.loading = false
      })
    }
  }
}
</script>
