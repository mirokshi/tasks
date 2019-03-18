<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex xs5 md4 class="pt-2 pb-2">
            <v-flex xs12 md4>
                <v-avatar size="100">
                    <img :alt="user.name" :src="user.gravatar">
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
                        <toggle :readonly="true" :status="task.completed" :task="task"
                                               :tags="tags"></toggle>
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
                            <span slot="activator" class="subheading font-weight-bold grey--text"> Creada {{task.created_at_human}} </span>
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
  name: 'UnitTaskShow',
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
