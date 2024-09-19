import './bootstrap';
import { createApp } from 'vue';
import { createWebHistory, createRouter } from "vue-router";
import ToDoList from './components/ToDoList.vue';
import App from './components/App.vue';
import AddTask from './components/AddTask.vue'
import EditTask from './components/EditTask.vue'

const routes = [
    {
        path: "/",
        component: ToDoList,
    },
    {
        path: "/add",
        component: AddTask
    },
    {
        path: "/edit/:id",
        component: EditTask
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

let app = createApp(App);
app.config.globalProperties.baseApiUrl = "http://127.0.0.1:8000/api/";
app.config.globalProperties.vueRouter = router;
app.use(router).mount('#app');
