<template>
    <v-form>
        <v-text-field
                v-model="name"
                label="Nombre"
                hint="El nombre de la tarea..."
                placeholder="Nombre de la tarea"
                :error-messages="nameErrors"
                @input="$v.name.$touch()"
                @blur="$v.name.$touch()"
        ></v-text-field>
        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendiente'"></v-switch>
        <v-textarea v-model="description" label="Descripción" hint="Descripción de la tarea..."></v-textarea>

        <!--<v-autocomplete v-model="user_id" :items="dataUsers" label="Usuario" item-text="name" item-value="id"></v-autocomplete>-->
        <user-select v-model= "user_id" :users="dataUsers" label="Usuario"></user-select>
        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1" >exit_to_app</v-icon>
                Cancelar
            </v-btn>
            <v-btn color="success" @click="add" :disabled="loading || $v.$invalid" :loading="loading">
                <v-icon class="mr-1" >save</v-icon>
                Agregar
            </v-btn>
        </div>
    </v-form>
</template>
<script>
import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'
import UserSelect from './UserSelect'

export default {
  mixins: [validationMixin],
  validations: {
    name: { required }
  },
  name: 'TaskFormCreate',
  components:{
    'user-select': UserSelect
  },
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
      } else {
        !this.$v.name.required && errors.push('El nombre es obligatorio')
      }
    }
  },
  methods: {
    reset () {
      this.user_id = ''
      this.name = ''
      this.description = ''
      this.completed = ''
    },
    add () {
      this.loading = true
      const task = {
        user_id: this.user_id,
        name: this.name,
        completed: this.completed,
        description: this.description
      }
      window.axios.post(this.uri, task).then(response => {
        this.$snackbar.showMessage('Tarea creada a correctamente')
        this.reset()
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
