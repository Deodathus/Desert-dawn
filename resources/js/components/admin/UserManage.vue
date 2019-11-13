<template>
    <div>
        <validation-errors
            :errors="this.errors"
            v-show="this.errors">
        </validation-errors>

        <user-create-form :url="url"
            @addUser="addUser"
            @emitRecord="addUserToList">
        </user-create-form>

        <user-list :users="users"
            ref="userList">
        </user-list>

    </div>
</template>

<script>
    export default {
        props: [
            'users',
            'url'
        ],
        data() {
            return {
                errors: [],
            }
        },
        methods: {
            addUser(form) {
                this.errors = [];

                axios.post(this.url, form).then((response) => {
                    this.$swal(response.data.success);
                }).catch(error => {
                    if (error.response.status === 422){
                        this.errors = error.response.data.errors;
                    }
                });
            },
            addUserToList(user) {
                this.$refs.userList.pushRecord(user);
            },
        }
    }
</script>
