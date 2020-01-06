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
                <user-create-form :url="url" @addUser="addUser" :edition_mode="false">
                </user-create-form>
            </template>

        </collapse>

        <user-list
            :users="users"
            ref="userList"
            :url="url">
        </user-list>

    </div>

</template>

<script>
    export default {
        props: [
            'users',
            'url',
            'name'
        ],
        data() {
            return {
                errors: [],
            }
        },
        methods: {
            addUser(form) {
                this.errors = [];

                axios.post(this.url, form)
                    .then((response) => {
                        this.$swal(response.data.success);
                        this.$refs.userList.pushRecord(form);
                    })
                    .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
        }
    }
</script>
