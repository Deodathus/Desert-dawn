<template>

    <list
        :items="items"
        :fields="fields"
        ref="list"
        :url="url">
    </list>

</template>

<script>
    export default {
        props: [
            'items',
            'url'
        ],
        data() {
            return {
                fields: [
                    'name',
                    'hp',
                    'armor',
                    'reward_gold',
                    'reward_gems',
                    'reward_exp',
                    'reward_item_rarity',
                    'options'
                ],
            }
        },
        methods: {
            pushRecord(record) {
                this.$refs.list.pushRecord(record);
            }
        },
    }
</script>

<style scoped>

</style>
