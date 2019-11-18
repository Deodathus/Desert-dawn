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

                <boss-create-form @addBoss="addBoss">
                </boss-create-form>

            </template>

        </collapse>

        <boss-list
            :items="items">
        </boss-list>

    </div>
</template>

<script>
    export default {
        props: [
            'bosses',
            'url',
            'name',
            'items'
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
                    .then(response => {
                        this.$swal(response.data.success);
                    })
                    .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            }
        },
    }
</script>
