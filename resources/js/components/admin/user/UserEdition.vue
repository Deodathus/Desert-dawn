<template>

    <div>
        <validation-errors
            :errors="this.errors"
            v-show="this.errors">
        </validation-errors>

        <user-create-form :edition_mode="true" :api_url="api_url" :user_id="user_id" @editUser="editUser">
        </user-create-form>
    </div>

</template>

<script>
    export default {
        props: [
            'api_url',
            'user_id',
            'url'
        ],
        data() {
          return {
              errors: [],
          };
        },
        methods: {
            editUser(user) {
                axios.patch(this.url, {
                    id: this.user_id,
                    name: user.name,
                    password: user.password,
                    coins: user.coins,
                    gems: user.gems,
                    energy: user.energy,
                    level: user.level,
                    is_admin: user.isAdmin,
                    exp: user.exp,
                    skill_1: user.skillOne,
                    skill_2: user.skillTwo,
                    skill_3: user.skillThree,
                    skill_1_damage: user.skillOneDamage,
                    skill_2_damage: user.skillTwoDamage,
                    skill_3_damage: user.skillThreeDamage,
                })
                    .then((response) => {
                        this.$swal(response.data.success);
                    })
                    .catch((error) => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        }
    }
</script>

<style scoped>

</style>
