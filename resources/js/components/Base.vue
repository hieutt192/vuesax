<template>
<div id="app">
    <BaseNarBar/>
    <div class="square">

        <router-view/>
    </div>
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
    .square {
        margin-top: 4.25rem;
    }
</style>
