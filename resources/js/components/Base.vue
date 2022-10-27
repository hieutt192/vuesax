<template>
<div id="app">
    <BaseNarBar/>
    <div class="square">
        <router-view/>
    </div>
    <!-- <BaseSideBar/> -->
</div>
</template>

<script>
import BaseNarBar from './layouts/BaseNarBar.vue'
// import BaseSideBar from './layouts/BaseSideBar.vue'

export default {
    components: {
        BaseNarBar,
        // BaseSideBar,
    }
}
</script>

<style>
    .square {
        margin-top: 4.25rem;
    }
</style>
