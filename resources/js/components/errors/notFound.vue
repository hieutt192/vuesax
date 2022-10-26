<template>
<center>
    <h1 > <p> Page Not Found! </p></h1>
    <p>
      <a ><router-link to="/"> Go home? </router-link> </a>
    </p>
  </center>
</template>

<script>
export default {
    name: 'NotFound'
}
</script>

<style>
    center {
        margin: 15vw;
    }

    h1 p {
        /* color: var(--border); */
        color: orange;
        font-size: 2em;
    }
</style>
