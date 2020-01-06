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

                <boss-create-form @addBoss="addBoss"
                    :rarities_api_url="rarities_api_url"
                    edition_mode="false">
                </boss-create-form>

            </template>

        </collapse>

        <boss-list
            :items="items"
            ref="bossList"
            :url="url">
        </boss-list>

    </div>
</template>

<script>
    export default {
        props: [
            'bosses',
            'url',
            'name',
            'items',
            'rarities_api_url'
        ],
        data() {
            return {
                errors: [],
            }
        },
        methods: {
            addBoss(form) {
                this.errors = [];

                axios.post(this.url, form)
                    .then((response) => {
                        this.$swal(response.data.success);
                        this.$refs.bossList.pushRecord(form);
                    })
                    .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
        },
    }
</script>
