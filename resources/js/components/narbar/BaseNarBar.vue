<template>
<div>
    <nav>

        <ul>
        <h3> Training </h3>
            <li>
            <a v-on:click="handleCLickHistory('/')">
                Home
            </a>
        </li>
        <li>
            <a v-on:click="handleCLickHistory('/Login')">
                Login
            </a>
        </li>
        <li>
            <a v-on:click="handleCLickHistory('/Signup')">
                Signup
            </a>
        </li>

    </ul>
    </nav>
</div>
</template>

<script>
export default {
    methods:{
            handleCLickHistory(newValue){
                this.$router.push(newValue)
            }
        }
}
</script>

<style>
    h3 {
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
    }

</style>
