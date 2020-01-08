<template>

    <div>

        <validation-errors
            :errors="this.errors"
            v-show="this.errors">
        </validation-errors>

        <item-create-form
            :url="url"
            :api_url="api_url"
            :item_rarities_api_url="item_rarities_api_url"
            :item_types_api_url="item_types_api_url"
            @editItem="editItem"
            :edition_mode="true"
            :item_id="item_id">
        </item-create-form>

    </div>

</template>

<script>
    export default {
        props: [
            'api_url',
            'item_types_api_url',
            'item_rarities_api_url',
            'item_id',
            'name',
            'url'
        ],
        data() {
            return {
                errors: [],
            }
        },
        methods: {
            editItem(item) {
                this.errors = [];

                axios.patch(this.url, {
                    id: this.item_id,
                    name: item.name,
                    item_rarity_id: item.item_rarity_id,
                    required_level: item.required_level,
                    type: item.type,
                    strength: item.strength,
                    stamina: item.stamina,
                    agility: item.agility,
                    intellect: item.intellect,
                    luck: item.luck,
                    wisdom: item.wisdom
                })
                    .then((response) => {
                        this.$swal(response.data.success);
                    })
                    .catch((error) => {
                        this.errors = error.response.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
