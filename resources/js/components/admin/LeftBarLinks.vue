<template>
    <div class="text-center">
        <div v-for="link in links" class="links-div" style="width:100%">
            <b-button-group class="left-bar-button-group">
                <b-button class="left-bar-link" variant="secondary" :href="link.href">{{ link.text }}</b-button>
            </b-button-group>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['links'],
    }
</script>