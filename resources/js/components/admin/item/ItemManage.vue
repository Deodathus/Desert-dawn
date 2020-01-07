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
                    :item_types_api_url="item_types_api_url">
                </item-create-form>

            </template>

        </collapse>

        <item-list
            :items="items"
            :url="url">
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
            'item_id',
            'items',
            'name'
        ],
        data() {
            return {
                errors: [],
            }
        }
    }
</script>

<style scoped>

</style>
