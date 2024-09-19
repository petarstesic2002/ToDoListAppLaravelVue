<template>
    <div class="container text-center">
        <h1 class="my-4">Dodaj Zadatak</h1>
        <span v-if="message!=''" class="alert alert-warning">{{ message }}</span>
        <form class="container mt-4 col-6" @submit.prevent="addTask()">
            <div class="mt-3 mx-5" v-if="validationErrors">
                <div class="alert alert-danger" v-for="(errors, field) in validationErrors" :key="field">
                    <div>
                        <span v-for="(error, index) in errors" :key="index">{{ error }}</span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
              <label for="title" class="form-label">Naziv Zadatka</label>
              <input type="text" placeholder="Naziv" class="form-control" id="title" v-model="title">
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">Opis Zadatka</label>
              <input type="text" placeholder="Opis" class="form-control" id="desc" v-model="description">
            </div>
            <button type="submit" class="btn btn-primary">Sačuvaj</button>
        </form>
    </div>
</template>
<script>
    export default{
        name:'AddTask',
        data(){
            return{
                title: "",
                description: "",
                message: "",
                validationErrors:{}
            }
        },
        methods:{
            addTask(){
                let formData = new FormData();
                formData.append('title', this.title);
                formData.append('description', this.description);
                axios({
                    method: "post",
                    url: this.baseApiUrl + 'tasks',
                    data: formData,
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(response=>{
                    if(response.data.success=="false"){
                        this.message = response.data.message;
                        this.validationErrors = response.data.data;
                    }
                    else{
                        this.message = response.data.message;
                        this.validationErrors = {}
                        setTimeout(() => {
                            this.vueRouter.push({ path:'/' })
                        }, 1000);
                    }
                }).catch(xhrResponse=>{
                    this.message = xhrResponse.message;
                });
            }
        }
    }
</script>
<style scoped>
</style>
