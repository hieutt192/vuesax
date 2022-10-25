<script>
//   export default {
//     data() {
//       return {
//         fields: {},
//         errors: {},
//       };
//     },
//     methods: {
//       submit() {
//         axios
//           .post("/api/register", this.fields)
//           .then(() => {
//             this.$router.push({ name: "Login" });
//           })
//           .catch((error) => {
//             this.errors = error.response.data.errors;
//           });
//       },
//     },
//   };

import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

let form = reactive({
    name: '',
    email: '',
    password: '',
    c_password: '',
})

let errors = ref('')

const register = async () => {
    await axios.post('/api/register', form)
        .then(response => {
            if (response.data.success) {
                localStorage.setItem('token',response.data.data.token)
                router.push('/login')
            } else {
                errors.value = response.data.message;
            }
        })
}

</script>

<template>
    <div id="backend-view">
      <form @submit.prevent="register">
        <h3>Sign Up Here</h3>
        <label for="name">Name</label>
        <input type="text" id="name" v-model="form.name" />
        <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>

        <label for="email">Email</label>
        <input type="text" id="email" v-model="form.email" />
        <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>

        <label for="password">Password</label>
        <input type="password" id="password" v-model="form.password" />
        <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>

        <label for="c_password">Confirm password</label>
        <input
          type="password"
          id="c_password"
          v-model="form.c_password"
        />

        <button type="submit">Sign Up</button>
        <span>Have an account?<router-link to="/login"><a href=""> Log in</a></router-link></span>
      </form>
    </div>
  </template>


  <style scoped>
  #backend-view {
    height: 100vh;
    background-color: #f3f4f6;
    display: grid;
    align-items: center;
  }
  form {
    width: 400px;
    background-color: #ffffff;
    margin: 0 auto;
    border-radius: 10px;
    border: 2px solid rgba(255, 255, 255, 0.1);
    padding: 50px 35px;
  }
  form * {
    letter-spacing: 0.5px;
    outline: none;
  }

  label {
    display: block;
    margin-top: 20px;
    font-size: 16px;
    font-weight: 500;
  }
  input {
    display: block;
    height: 50px;
    width: 100%;
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 16px;
    font-weight: 300;
  }

  button {
    margin-top: 50px;
    width: 100%;
    background-color: rgba(0, 46, 173, 0.7);
    color: #ffffff;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
  }
  form span {
    display: block;
    margin-top: 20px;
  }
  a {
    color: rgba(0, 46, 173, 0.8);
  }

  .loader {
    text-align: center;
    margin-bottom: 15px;
  }
  </style>
