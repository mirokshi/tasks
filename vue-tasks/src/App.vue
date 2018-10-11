<template>

  <div id="app">
    <!--API
        JSON APIS/ REST APIS

        //BACKEND/LARAVEL/PHP que nos proporciones la lista de tasks

        http://myservidor.com/tasks

        API, REST O JSON NO REGRESAN HTML -> regresan objectos Javascript en format JSON

        formato del curso:JSON
    -->
    <tasks :tasks="tasks"></tasks>
  </div>
</template>

<script>
    import Tasks from './components/Tasks.vue'
    import EditableText from './components/EditableText.vue'
    import  axios from 'axios'

    export default {
        name: 'app',
        data(){
          return{
              tasks: [],
              error: null
          }
        },
        components: {
            'tasks' : Tasks,
            'editable-text': EditableText
        },
        created() {
         // async created(){
            console.log('Componente APP esta creado');
            //AJAX -> Asynchonous JAscript i XML
            //XHR -> XML HTTP Request Asincrones

            //JAVASCRIPT NO BLOQUEA
            // axios.get('http://localhost:8050/api/v1/tasks')

            //3 OPCIONES
                  //1) CALBACKS -> funciones anonimas
            // fileManager.open('/home/mirokshi/.bashrc',  (file) => {
            //     console.log(file);
            // })

                //2) PROMISES -> .then .catch
            axios.get('http://127.0.0.1:8050/api/v1/tasks').then((response)=> {
                this.tasks = response.data
                // axios.get('http://httpbin.org/get').then(()=> {
            }).catch((error) => {
                this.error = error
            })

            //3) ASYNC  WAIT
             // async function (){
             //     let result = await axios.get('http://localhost:8050/api/v1/tasks')
             // }

        //3 OPCIONES
              //1) API por defecto de javascript
              //2) Jquery --> Ajax/XHR
              //3)Librerias especificas -> Axios
            // this.tasks=
        }
    }
</script>

<style>

</style>