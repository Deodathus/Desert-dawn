<template>
    <list
        :items="users"
        :fields="fields"
        ref="list"
        :url="url">
    </list>
</template>

<script>
    export default {
        props: [
            'users',
            'url'
        ],
        methods: {
            pushRecord(record) {
                this.$refs.list.pushRecord(record);
            }
        },
        data() {
            return {
                fields: [
                    'id',
                    'name',
                    'email',
                    'is_admin',
                    'coins',
                    'gems',
                    'energy',
                    'level',
                    'exp',
                    'skill_1',
                    'skill_2',
                    'skill_3',
                    'options'
                ],
            }
        }
    }
</script>
