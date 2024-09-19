<template>
    <h1 class="text-center my-4">Lista zadataka</h1>
    <div class="text-center my-4">
        <router-link class="btn btn-outline-primary" to="/add">Dodaj novi zadatak</router-link>
    </div>
    <div v-if="tasks.length < 1" class="text-center">
        <h3 class="mt-2">Trenutno nema zadataka</h3>
    </div>
    <div class="container text-center table-responsive" v-else>
        <span v-if="message!=''" class="alert alert-warning text-center my-3">{{ message }}</span>
        <table class="table table-striped text-center mt-5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naziv Zadatka</th>
                    <th>Opis Zadatka</th>
                    <th>Završeno</th>
                    <th>Izmeni</th>
                    <th>Obriši</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="t, index in tasks" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ t.title }}</td>
                    <td>{{ t.description }}</td>
                    <td>
                        <input class="form-check-input" :checked="t.completed==1 ? true : false" type="checkbox" @input="markChecked(t.id)"/>
                    </td>
                    <td>
                        <router-link :to="`/edit/${t.id}`" class="btn btn-warning me-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></router-link>
                    </td>
                    <td>
                        <button class="btn btn-danger ms-1" @click="deleteTask(t.id)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    import axios from 'axios'
    export default{
        name: 'ToDoList',
        data(){
            return{
                tasks:[],
                message:""
            }
        },
        methods: {
            fetchTasks(){
                axios.get(this.baseApiUrl + 'tasks')
                .then(response=>{
                    this.tasks = response.data.data;
                    console.log(this.tasks);
                });
            },
            markChecked(id){
                axios.patch(this.baseApiUrl + 'tasks/' + id)
                .then(response=>{
                    this.message = response.data.message;
                    setTimeout(() => {
                        this.message = "";
                    }, 2000);
                })
            },
            deleteTask(id){
                console.log(id)
                axios.delete(this.baseApiUrl + 'tasks/' + id);
                this.fetchTasks();
            }
        },
        mounted(){
            this.fetchTasks();
        }
    }
</script>
<style scoped>
</style>
