<template>
    <v-form>
        <v-text-field
            autofocus
            v-model="name"
            label="Nombre"
            hint="El nombre de la tarea..."
            placeholder="Nombre de la tarea"
            readonly
        ></v-text-field>

        <v-switch readonly v-model="completed" :label="completed ? 'Completada' : 'Pendiente'"></v-switch>

        <v-textarea
            v-model="description"
            label="Descripción"
            hint="Descripcion de la tarea..."
            readonly
        ></v-textarea>

        <user-select :readOnly="true" :users="dataUsers" label="Usuario"></user-select>
    </v-form>
</template>

<script>
export default {
  data () {
    return {
      name: this.task.name,
      completed: this.task.completed,
      description: this.task.description,
      dataUsers: this.users
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
    }
  },
  created () {
    this.updateUser(this.task)
  }
}
</script>
