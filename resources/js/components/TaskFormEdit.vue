<template>
    <v-form>
        <v-text-field
                v-model="name"
                label="Nombre"
                hint="El nombre de la tarea"
                placeholder="Nombre de la tarea"
                :error-messages="nameErrors"
                @input="$v.name.$touch()"
                @blur="$v.name.$touch()"
        ></v-text-field>
        <v-switch v-model="completed" :label="completed ? 'Completeda' : 'Pendiente'"></v-switch>
        <v-textarea v-model="description" label="Descripcion" hint="Descripcion de la tarea"></v-textarea>
        <user-select v-model="user_id" :users="dataUsers" label="Usuario"></user-select>
        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                CANCELAR
            </v-btn>
            <v-btn color="success" @click="edit" :disabled="loading || $v.$invalid()" :loading="loading">
                <v-icon class="mr-1">save</v-icon>
                AGREGAR
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
  name: 'TaskFormEdit',
  components: {
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
        !this.$v.name.required && errors.push('El nombre obligatorio')
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
    edit () {
      this.loading = true
      const  task = {
        user_id: this.user_id,
        name: this.name,
        completed: this.completed,
        description: this.description
      }
      window.axios.post()
    }

  }
}
</script>

<style scoped>

</style>
