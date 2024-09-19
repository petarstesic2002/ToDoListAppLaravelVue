<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-2">
        <div class="container">
          <ul class="navbar-nav">
            <li class="navbar-brand"><router-link class="nav-link" :to="navItems[0].path">To-Do List App</router-link></li>
          </ul>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item" v-for="n,index in navItems" :key="index">
                <router-link class="nav-link" :to="n.path">{{n.text}}</router-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</template>
<script>
    export default{
        name:'Header',
        props:['navItems']
    }
</script>
<style scoped>

</style>
