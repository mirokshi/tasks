<template>
    <span>
        <v-toolbar color="primary lighten-2">
            <v-toolbar-title class="white--text">Users</v-toolbar-title>
            <v-spacer></v-spacer>
            <!--<v-btn icon class="white&#45;&#45;text" @click="refresh" :loading="loading" :disabled="loading">-->
                <!--<v-icon>refresh</v-icon>-->
            <!--</v-btn>-->
        </v-toolbar>
        <v-card>
            <v-card-title>
                <v-layout row wrap>
                    <v-flex>
                        <v-text-field
                            appedn-icon="search"
                            label="Buscar"
                            v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="dataUsers"
                :search="search"
                no-results-text="No se ha encontrado ningún registro"
                no-data-text="No hay datos disponibles"
                rows-per-page-text="Usuarios por pagina"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Todos','value':-1}]"
                :loading="loading"
                :pagination.sync="pagination"
                class="hidden-md-and-down"
            >
                 <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item:user}">
                    <tr>
                        <td>{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.admin}}</td>
                        <td>{{user.mobile}}</td>
                    </tr>
                </template>
            </v-data-table>
        </v-card>
    </span>
</template>

<script>
export default {
  name: 'Users',
  data () {
    return {
      loading: false,
      dataUsers: this.users,
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'NOMBRE', value: 'name' },
        { text: 'EMAIL', value: 'email' },
        { text: 'IS ADMIN?', value: 'admin' },
        { text: 'MOBILE', value: 'mobile' }
      ]
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    }
  }
  // methods: {
  //   refresh (message = true) {
  //     this.loading = true
  //     window.axios.get(this.uri).then(response => {
  //       this.dataTasks = response.data
  //       this.loading = false
  //       if (message) this.$snackbar.showMessage('Tareas actualizadas correctamente')
  //     }).catch(() => {
  //       this.loading = false
  //     })
  //   }
  // }
}
</script>

<style scoped>

</style>
