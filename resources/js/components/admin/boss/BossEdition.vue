<template>

    <div>

        <validation-errors
            :errors="this.errors"
            v-show="this.errors">
        </validation-errors>

        <boss-create-form
            :boss_id="boss_id"
            :api_url="api_url"
            edition_mode="true"
            @editBoss="editBoss">
        </boss-create-form>

    </div>

</template>


<script>
    export default {
        props: [
            'api_url',
            'boss_id',
            'url'
        ],
        data() {
            return {
                errors: [],
            }
        },
        methods: {
            editBoss(boss) {
                this.errors = [];

                axios.patch(this.url, {
                    id: this.boss_id,
                    name: boss.name,
                    hp: boss.hp,
                    armor: boss.armor,
                    reward_gold: boss.reward_gold,
                    reward_gems: boss.reward_gems,
                    reward_exp: boss.reward_exp,
                    reward_item_rarity: boss.reward_item_rarity
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
