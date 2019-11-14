<template>

    <div>

        <validation-errors
            :errors="this.errors"
            v-show="this.errors">
        </validation-errors>

        <collapse :name="name">

            <template v-slot:title>
                Add +
            </template>

            <template v-slot:content>
                <user-manage-all-form @addCurrencies="addCurrencies">
                </user-manage-all-form>
            </template>

        </collapse>

    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'url'
        ],
        data() {
            return {
                errors: [],
            }
        },
        methods: {
            addCurrencies(form) {
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
        }
    }
</script>
