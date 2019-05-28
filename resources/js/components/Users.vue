<template>
    <span>
        <v-toolbar color="primary">
            <v-toolbar-title class="white--text">Usuaris</v-toolbar-title>
        </v-toolbar>
        <v-card>
            <v-container fluid>
                <v-layout wrap>
                    <v-flex xs12 md4>
                        <v-text-field
                            v-model="search"
                            append-icon="search"
                            label="Search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout wrap>
                    <v-flex xs12>
                        <v-data-table :headers="headers" class="elevation-1" :items="dataUsers" :search="search">
                            <template slot="items" slot-scope="{ item: user }">
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.mobile }}</td>
                                <td>{{ user.email_verified_at }}</td>
                                <td>
                                    <user-emails :user="user"></user-emails>
                                </td>
                            </template>
                        </v-data-table>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card>
    </span>
</template>

<script>

import UserEmailsComponent from './users/UserEmailsComponent'

export default {
  name: 'Users',
  components: {
    'user-emails': UserEmailsComponent
  },
  data () {
    return {
      dataUsers: this.users,
      search: '',
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Phone', value: 'mobile' },
        { text: 'Verified', value: 'verified_at' },
        { text: 'Actions', value: 'id' }
      ]
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
