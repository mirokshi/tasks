<template>
    <v-dialog v-model="dialog"  @keydown.esc="dialog=false">
        <v-toolbar color="blue darken-3" class="white--text">
            <v-btn flat icon class="white--text" @click="dialog=false">
                <v-icon class="mr-1">close</v-icon>
            </v-btn>
            <v-toolbar-title class="white--text">Editar Tasca</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn flat class="white--text" @click="dialog=false">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Sortir
            </v-btn>
            <v-btn flat class="white--text">
                <v-icon class="mr-1">save</v-icon>
                Guardar
            </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-text>
                <v-form>
                    <v-text-field v-model="name" label="Nom" hint="El nom de la tasca..." placeholder="Nom de la tasca"></v-text-field>
                    <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

                    <v-textarea v-model="description" label="Descripció" hint="bla bla bla..."></v-textarea>
                    <v-autocomplete :items="dataUsers" label="Usuari" item-text="name"></v-autocomplete>
                    <div class="text-xs-center">
                        <v-btn @click="dialog=false">
                            <v-icon class="mr-1">exit_to_app</v-icon>
                            Cancel·lar
                        </v-btn>
                        <v-btn color="success">
                            <v-icon class="mr-1" >save</v-icon>
                            Guardar
                        </v-btn>
                    </div>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
    <v-btn v-if="$can('tasks.update',task)" icon color="success" flat title="Canviar la tasca"
           @click="showUpdate(task)">
        <v-icon>edit</v-icon>
    </v-btn>
</template>
<script>
export default {
  name: 'TaskUpdate',
  data () {
    return {
      dialog: false
    }
  }
}
</script>
