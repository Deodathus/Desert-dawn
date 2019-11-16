<template>
    <div>
        <div v-for="mainLink in mainLinks">
            <main-link
                :main-link="mainLink">
            </main-link>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'links',
            'mainLinks'
        ],
    }
</script>
