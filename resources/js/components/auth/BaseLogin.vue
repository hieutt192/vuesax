<template>
    <!-- new -->
    <form @submit.prevent="onSubmit" class="knd-form">
        <!-- input -->
        <div class="knd-form-x">
            <h3>Login Form</h3>
            <div class="knd-form-field">
                <vs-input type="email" label="Email" v-model="email" placeholder="YourEmail@gmail.com">
                    <template #icon>
                    <i class='bx bx-envelope'></i>
                    </template>
                    <template v-if="validEmail" #message-success>
                    Email Valid
                    </template>
                    <template v-if="!validEmail && email !== ''" #message-danger>
                    Email Invalid
                    </template>
                </vs-input>
            </div>

       <!-- password -->
            <div class="knd-form-field">
                <vs-input type="password" label="Password" v-model="password" label-placeholder="Password"

                :visiblePassword="hasVisiblePassword"
                icon-after
                @click-icon="hasVisiblePassword = !hasVisiblePassword">
                    <template #icon>
                    <i v-if="!hasVisiblePassword" class='bx bx-show-alt'></i>
                    <i v-else class='bx bx-hide'></i>
                    </template>

                     <template v-if="getProgress >= 100" #message-success>
                    Secure password
                    </template>
                </vs-input>
            </div>

            <div class="knd-field-group">
            <vs-button >Login</vs-button>
            </div>
            <span>Don't have an account?<router-link to="/signup"> <a >Sign up</a></router-link></span>

        </div>

    </form>

</template>

<script>

import axios from 'axios';

export default {
    data:() =>  ({
        'email': '',
        'password': '',
        hasVisiblePassword: false

    }),

    methods: {
        onSubmit() {
            const data = {
                email: this.email,
                password: this.password,

            }

            axios.post('api/login', data, {}).then((res) => {
                this.$vs.notification({
                    flat: true,
                    color:'success',
                    position:'top-center',
                    title: 'Login Successful',
                    // text: res.data.access_token,
                    text: "Welcome to my page !",
                })
            }).catch((err) => {
                this.$vs.notification({
                    flat: true,
                    color:'danger',
                    position:'top-center',
                    title: 'Login Fail',
                    // text: err.response.data.error,
                    text: "Email or Password incorrect !",

                })
            });


        }
    },

    computed: {
        validEmail() {
          return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)
        },


      }
}
</script>

<style>

    .knd-form{
        height: 80vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .knd-form-field {
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    .knd-form-x {
        padding: 1.25rem;
        background-color: aquamarine;
    }

    .vs-input {
        width: 400px !important;
    }

    .knd-field-group {
        display: flex;
        align-items: center;
        flex-direction: row;
        margin-top: 0.50rem;
    }

    .knd-field-group a{
        text-decoration: none !important;
        text-transform: capitalize;
        margin-left: 0.25rem;
        cursor: pointer;
    }
</style>
