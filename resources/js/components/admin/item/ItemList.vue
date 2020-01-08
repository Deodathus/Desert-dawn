<template>

    <list
        :items="items"
        ref="list"
        :fields="fields"
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
                    'required_level',
                    'type',
                    'strength',
                    'stamina',
                    'agility',
                    'intellect',
                    'luck',
                    'wisdom',
                    'options'
                ],
                items_data: null,
            }
        },
        methods: {
            pushRecord(record) {
                this.$refs.list.pushRecord(record);
            },
            fillItemsData() {
                this.items_data.data.forEach(element => {
                    element.strength = element.item_attribute.strength;
                    element.stamina = element.item_attribute.stamina;
                    element.agility = element.item_attribute.agility;
                    element.intellect = element.item_attribute.intellect;
                    element.luck = element.item_attribute.luck;
                    element.wisdom = element.item_attribute.wisdom;
                });
            }
        },
        created() {
            this.items_data = this.items;

            this.fillItemsData();
        }
    }
</script>

<style scoped>

</style>
