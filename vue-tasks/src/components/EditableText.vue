<template>
  <span>
      <span v-if="!editing" @dblclick="editing=true"> <!-- EDITA -->
          {{text}}
          <svg @click="editing=true" class="h-5 w-4.5 fill-current text-yellow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg> <!-- Edit -->
      </span>

      <span v-if="editing" @keyup.esc="editing=false" @keyup.enter="edit">  <!--TERMMINA DE EDITAR -->
          <svg @click="edit" class="h-5 w-4.5  fill-current text-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> <!-- Check -->
          <svg @click="editing=false" class="h-5 w-4.5  fill-current text-red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>&nbsp; <!--Cancel -->

          <input type="text" v-model="currentText">
          <!--//SINTAX SUGAR -->
          <!--<input type="text" :value="text" @input="text = $event.target.value">-->
      </span>
  </span>
</template>

<script>
    export default {
        name: 'EditableText',
        data() {
            return {
                editing: false,
                currentText: this.text
            }
        },
         // props :['text'],
        props: {
            'text': {
                type: String,
                required : true
            }
        },
        methods: {
            edit() {
             this.editing=false,
                // INFORMAR AL PADRE
                this.$emit('edited', this.currentText)
            }
        },
        created(){
            console.log('Componente Editable estar creador');
        }
    }
</script>