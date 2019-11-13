<template>
    <list
        :items="users"
        ref="list">
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
