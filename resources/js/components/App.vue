<template>
    <Header :navItems="navigation"/>
    <section id="content">
        <router-view></router-view>
    </section>
    <Footer/>
</template>
<script>
    import Header from './fixed/Header.vue'
    import Footer from './fixed/Footer.vue'
    export default{
        components:{
            Header,
            Footer
        },
        data(){
            return{
                navigation:[
                    {
                        text: "Prikaz Zadataka",
                        path: "/",
                    },
                    {
                        text: "Dodaj Zadatak",
                        path: "/add",
                    }
                ]
            }
        }
    }
</script>
<style scoped>
    #content{
        min-height: 800px;
    }
</style>
