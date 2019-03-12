<template>
    <v-autocomplete
        :read-only="readOnly"
        :items="dataUsers"
        v-model="selectedUser"
        :item_value="itemValue"
        clearable
        :label="label"
    >
        <template slot="selection" slot-scope="data">
            <v-chip>
                <v-avatar :title="data.item.name">
                    <img :src="data.item.gravatar" :alt="data.item.name">
                </v-avatar>
                {{ data.item.name }}
            </v-chip>
        </template>
        <template slot="item" slot-scope="{ item: user }">
            <v-list-tile-avatar>
                <v-avatar :title="user.name">
                    <img v-if="user.gravatar" :src="user.gravatar" alt="avatar">
                    <img v-else src="https://www.gravatar.com/avatar/" alt="avatar">
                </v-avatar>
            </v-list-tile-avatar>
            <v-list-tile-content>
                <v-list-tile-title v-text="user.name"></v-list-tile-title>
                <v-list-tile-sub-title v-text="user.email"></v-list-tile-sub-title>
            </v-list-tile-content>
            <v-spacer></v-spacer>
            <span class="dotO" title="Usuario Conectado" v-if="user.online"></span>
            <span class="dotI" title="Usuario Desconectado" v-else></span>
        </template>
    </v-autocomplete>
</template>

<script>
export default {
  name: 'UserSelect',
  data () {
    return {
      dataUsers: this.users,
      selectedUser: this.value
    }
  },
  model: {
    prop: 'user',
    event: 'selected'
  },
  props: {
    readOnly: {
      type: Boolean,
      default: false
    },
    itemValue: {
      type: String,
      default: 'id'
    },
    user: {
      type: Object,
      default: function () {
        return {}
      }
    },
    users: {
      type: Array,
      required: true
    },
    label: {
      type: String,
      default: 'Usuarios'
    }
  },
  watch: {
    user (user) {
      this.selectedUser = user
    },
    selectedUser (newValue) {
      this.$emit('selected', newValue)
    },
    users () {
      this.dataUsers = this.users
    }
  }
}
</script>
<style scoped>
    .dotO{
        height: 15px;
        width: 15px;
        background-color: #388a11;
        border-radius: 50%;
        display: inline-block;
        margin-left: 9px;
        margin-right: 9px;
    }
    .dotI{
        height: 15px;
        width: 15px;
        background-color: #730500;
        border-radius: 50%;
        display: inline-block;
        margin-left: 9px;
        margin-right: 9px;
    }
</style>
