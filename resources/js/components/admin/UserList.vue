<template>
    <list
        :items="users"
        rel="list">
    </list>
</template>

<script>
    export default {
        props: ['users'],
        methods: {
            pushRecord(record) {
                this.$refs.list.pushRecord(record);
            }
        }
    }
</script>
