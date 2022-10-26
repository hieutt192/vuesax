<template>
<div id="app">
    <BaseNarBar/>
    <router-view/>
</div>
</template>

<script>
import BaseNarBar from './narbar/BaseNarBar.vue'

export default {
    components: {
        BaseNarBar,
    }
}
</script>

<style>

</style>
