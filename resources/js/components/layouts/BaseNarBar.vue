<template>
 <div class="center examplex">
      <vs-navbar center-collapsed v-model="active">
        <template #left>
          <img src="/logo2.png" alt="">
        </template>
        <vs-navbar-item :active="active == 'guide'" id="guide">
          Guide
        </vs-navbar-item>
        <vs-navbar-item :active="active == 'docs'" id="docs">
          Documents
        </vs-navbar-item>
        <vs-navbar-item :active="active == 'components'" id="components">
          Components
        </vs-navbar-item>
        <vs-navbar-item :active="active == 'license'" id="license">
          license
        </vs-navbar-item>
        <template #right>
          <vs-button flat @click="handleCLickHistory('/login')" >Login</vs-button>
          <vs-button v-on:click="handleCLickHistory('/signup')">Signup</vs-button>
        </template>
      </vs-navbar>

    </div>
</template>

<script>
export default {

    data:() => ({
      active: 'guide'
    }),

    methods:{
            handleCLickHistory(newValue){
                this.$router.push(newValue)
            }
        }
}
</script>

<style>
    /* h3 {
        padding-right: 100rem;
    }
    nav {
        padding-top: 0.50rem;
        padding-bottom: 0.25rem;
        background-color: white;
        box-shadow: 0 1px 2px 0 rgba(60,64, 67,0, 302), 0 1px 3px 1px rgba(60,64, 67,0, 149);
    }

    nav ul  {
        list-style-type: none;
        display: flex;
        justify-content: flex-end;
    }

    nav ul li  {
        padding: 0.25rem 0.50rem 0.25rem 0.50rem;
        background-color: white;
        margin-left: 0.25rem;
        margin-right: 0.25rem;
    }
    ul li a{
        text-decoration: none !important;
        color:white none !important;
    } */

</style>
