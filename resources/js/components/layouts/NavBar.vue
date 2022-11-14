<template>
 <div class="center examplex">
      <vs-navbar center-collapsed v-model="active">
        <template #left>
          <p>HomePage</p>
        </template>
        <vs-navbar-item :active="active == 'home'" id="home" @click="handleCLickHistory('/')">
          Home
        </vs-navbar-item>
        <vs-navbar-item :active="active == 'user'" id="User" @click="handleCLickHistory('/userManager')">
          User
        </vs-navbar-item>

        <template #right>
          <!-- <vs-button flat @click="handleLogout" >Logout</vs-button> -->
        </template>
      </vs-navbar>

    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {

    name: 'Nav',

    data:() => ({
      active: 'home',
    //   active: 'user',
    }),

    methods:{

            ...mapActions(['logout']),

            handleCLickHistory(newValue){
                this.$router.push(newValue)
            },

            async handleLogout() {
                await this.logout()
                localStorage.getItem("token")
                localStorage.removeItem('token');
            }


        }
}
</script>

<style>


</style>
