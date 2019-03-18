<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex xs5 md4 class="pt-2 pb-2">
            <v-flex xs12 md4>
                    <v-avatar :title="task.user_name" size="100">
                        <img v-if="task.user_gravatar" :src="task.user_gravatar" alt="avatar">
                        <img v-else src="https://www.gravatar.com/avatar/" alt="avatar">
                    </v-avatar>
            </v-flex>
            <v-flex xs12 md4 class="pt-2">
                <span class="subheading">{{ task.user_name }}</span>
            </v-flex>
        </v-flex>
        <v-flex xs7 md4>
            <v-list class="pb-3 pb-3">
                <v-list-tile>
                    <v-list-tile-content>
                        <toggle :value="task.completed" uri="/api/v1/completed_task" active-text="Completada" unactive-text="Pendiente" :resource="task"></toggle>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile>
                    <v-list-tile-content>
                        <v-tooltip bottom>
                            <span slot="activator" class="font-weight-thin"> {{task.description}} </span>
                            <span>Descripció</span>
                        </v-tooltip>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile>
                    <v-list-tile-content>
                        <tasks-tags :task="task" :tags="tags" :selected-tags="task.tags"
                                         :readonly="true"></tasks-tags>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile>
                    <v-list-tile-content>
                        <v-tooltip bottom>
                            <span slot="activator" class="subheading font-weight-bold grey--text"> Creada + {{task.created_at_human}} </span>
                            <span>{{ task.created_at_formatted }}</span>
                        </v-tooltip>
                        <span v-if="$vuetify.breakpoint.mdAndUp"> {{ task.created_at_formatted }}</span>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile>
                    <v-list-tile-content>
                        <v-tooltip bottom>
                            <span slot="activator" class="subheading font-weight-bold grey--text"> Actualitzada {{task.updated_at_human}} </span>
                            <span>{{ task.updated_at_formatted }}</span>
                        </v-tooltip>
                        <span v-if="$vuetify.breakpoint.mdAndUp"> {{ task.updated_at_formatted }}</span>

                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-flex>
    </v-layout>
</template>
<script>

import TasksTags from './TasksTags'
import Toggle from '../Toggle'

export default {
  name: 'ShowTask',
  components: {
    'tasks-tags': TasksTags,
    'toggle': Toggle
  },
  props: {
    tags: {
      type: Array,
      required: true
    },
    task: {
      type: Object,
      required: true
    },
    user: {
      type: Object,
      default: function () {
        return this.task.user
      }
    }
  }
}
</script>
