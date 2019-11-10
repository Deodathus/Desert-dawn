<template>
    <div>
        <div v-for="link in links">
            <b-link class="links" :href="link.href">{{ link.text }}</b-link>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['links'],
    }
</script>
