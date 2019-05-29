<template>
    <span>
        <v-dialog v-model="dialog"  :fullscreen="$vuetify.breakpoint.smAndDown" @keydown.esc.stop.prevent="dialog=false">
            <v-toolbar color="primary darken-3" class="white--text">
            <v-btn flat icon class="white--text" @click="dialog=false">
                <v-icon>close</v-icon>
            </v-btn>
            <v-toolbar-title class="white--text">Verificar movil</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
            <v-card>
                <v-card-text>
                    <form>
        <v-container grid-list-md align-center>
            <v-layout row wrap>
                <v-flex xs12>
                    <v-text-field
                        v-model="code"
                        counter="6"
                        hint="Codi rebut via SMS"
                        label="Codi"
                        :error-messages="codeErrors"
                        @input="$v.code.$touch()"
                        @blur="$v.code.$touch()"
                    ></v-text-field>
                    <v-btn color="primary" @click="validate" :loading="loading" :disabled="loading  || $v.$invalid">Validar</v-btn>
                </v-flex>
            </v-layout>
        </v-container>
    </form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-btn
            @click="dialog = true"
            icon
            flat
        >
                <v-icon>phonelink</v-icon>
            </v-btn>
    </span>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, maxLength } from 'vuelidate/lib/validators'

export default {
  name: 'VerifyMobileForm',
  mixins: [validationMixin],
  data () {
    return {
      code: '',
      loading: false,
      dialog: false
    }
  },
  validations: {
    code: { required, maxLength: maxLength(6) }
  },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  computed: {
    codeErrors () {
      const codeErrors = []
      if (!this.$v.code.$dirty) return codeErrors
      !this.$v.code.required && codeErrors.push('El codi és obligatori.')
      !this.$v.code.maxLength && codeErrors.push('El codi ha de tenir una mida màxima de 6 caràcters.')
      return codeErrors
    }
  },
  methods: {
    validate () {
      this.loading = true
      window.axios.post('/api/v1/users/' + this.user.id + '/verify_mobile', {
        code: this.code
      }).then(() => {
        console.log(this.code)
        this.dialog = false
        this.loading = false
        this.$snackbar.showMessage('Codi correcte. El vostre mòbil ha estat validat correctament')
      }).catch(() => {
        this.dialog = false
        this.loading = false
      })
    }
  }
}
</script>
