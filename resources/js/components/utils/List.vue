<template>
    <div>
        <b-table striped hover :items="items" :fields="fields">

            <template v-slot:cell(options)="data">

                <edit-item
                    :id="data.item.id"
                    :url="url">
                </edit-item>

                <delete-item
                    :id="data.item.id"
                    :url="url"
                    @deleteRecord="removeRecord">
                </delete-item>

            </template>

        </b-table>
    </div>
</template>

<script>
    export default {
        props: {
            items: {},
            fields: {},
            url: '',
        },
        data() {
            return {
                itemss: this.items,
            };
        },
        methods: {
            pushRecord(record) {
                this.items.push(record);
            },
            removeRecord(id) {
                this.items = this.items.filter((item) => item.id !== id);
            },
        },
    }
</script>
