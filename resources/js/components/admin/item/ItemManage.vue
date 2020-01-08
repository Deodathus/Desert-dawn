<template>

    <div>

        <validation-errors
            :errors="this.errors"
            v-show="this.errors">
        </validation-errors>

        <collapse :name="name">

            <template v-slot:title>
                Creation +
            </template>

            <template v-slot:content>

                <item-create-form
                    :url="url"
                    :api_url="api_url"
                    :item_rarities_api_url="item_rarities_api_url"
                    :item_types_api_url="item_types_api_url"
                    @addItem="addItem">
                </item-create-form>

            </template>

        </collapse>

        <item-list
            :items="items"
            :url="url"
            ref="itemList">
        </item-list>

    </div>

</template>

<script>
    export default {
        props: [
            'url',
            'api_url',
            'item_types_api_url',
            'item_rarities_api_url',
            'items',
            'name'
        ],
        data() {
            return {
                errors: [],
            }
        },
        methods: {
            addItem(form) {
                this.errors = [];

                axios.post(this.url, form)
                    .then((response) => {
                        this.$swal(response.data.success);
                        this.$refs.itemList.pushRecord(form);
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                    });
            }
        },
    }
</script>

<style scoped>

</style>
