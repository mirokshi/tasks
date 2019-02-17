<template>
    <v-form>
        <v-text-field
            autofocus
            v-model="name"
            label="Nombre"
            hint="El nombre de la tarea..."
            placeholder="Nombre de la tarea"
            :error-messages="nameErrors"
            @input="$v.name.$touch()"
            @blur="$v.name.$touch()"
        ></v-text-field>

        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

        <v-textarea v-model="description" label="Descripción" hint="Escribe la descripción de la tarea..."></v-textarea>

        <user-select :item-value="null" v-model="user" :users="dataUsers" label="Usuari"></user-select>

        <!--<tasks-tags :task-tags="tags" :tags="tags"></tasks-tags>-->

        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                CANCELAR
            </v-btn>
            <v-btn color="success" @click="add" :disabled="loading || $v.$invalid" :loading="loading">
                <v-icon class="mr-1" >save</v-icon>
                AÑADIR
            </v-btn>
        </div>
    </v-form>
</template>

<script>

import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'
import UserSelect from './UserSelect'
import TasksTags from './TasksTags'

export default {
  mixins: [validationMixin],
  validations: {
    name: { required }
  },
  name: 'TaskFormCreate',
  components: {
    'user-select': UserSelect,
    'tasks-tags': TasksTags
  },
  data () {
    return {
      name: '',
      completed: false,
      description: '',
      dataUsers: this.users,
      loading: false,
      user: null
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
      default: '/api/v1/tasks'
    }
  },
  computed: {
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) {
        return errors
      } else { !this.$v.name.required && errors.push('El nombre  es obligatorio.') }
      return errors
    }
  },
  methods: {
    selectLoggedUser () {
      if (window.laravel_user) {
        this.user = this.users.find((user) => {
          return parseInt(user.id) === parseInt(window.laravel_user.id)
        })
      }
    },
    reset () {
      this.name = ''
      this.description = ''
      this.completed = false
      this.user = null
    },
    add () {
      this.loading = true
      const task = {
        'name': this.name,
        'description': this.description,
        'completed': this.completed,
        'user_id': this.user.id
      }
      window.axios.post(this.uri, task).then(response => {
        this.$snackbar.showMessage('Tarea creada correctamente')
        this.reset()
        this.$emit('created', response.data)
        this.loading = false
        this.$emit('close')
      }).catch(error => {
        this.$snackbar.showError(error.data)
        this.loading = false
      })
    }
  },
  created () {
    this.selectLoggedUser()
  }
}
</script>
