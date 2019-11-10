<template>
    <div>
        <div v-for="link in links">
            <b-link class="links" v-html="link.text" :href="link.href"></b-link>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['links'],
    }
</script>
