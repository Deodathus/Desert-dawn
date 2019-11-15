<template>

    <div>

        <b-container fluid>

            <b-form @submit="onSubmit">

                <b-row>

                    <b-col cols="3">

                        <b-form-group
                            id="input-group-boss-name"
                            label="Boss's name"
                            label-for="input-boss-name">
                            <b-form-input
                                id="input-boss-name"
                                v-model="form.name"
                                required
                                placeholder="Enter name">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-boss-hp"
                            label="Boss's hp"
                            label-for="input-boss-hp">
                            <b-form-input
                                id="input-boss-hp"
                                v-model="form.hp"
                                required
                                placeholder="Enter hp">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-boss-armor"
                            label="Boss's armor"
                            label-for="input-boss-armor">
                            <b-form-input
                                id="input-boss-armor"
                                v-model="form.armor"
                                required
                                placeholder="Enter armor">
                            </b-form-input>
                        </b-form-group>

                        <b-button type="submit">Add</b-button>

                    </b-col>

                    <b-col cols="3" offset="1">

                        <b-form-group
                            id="input-group-boss-reward-gold"
                            label="Enter gold count"
                            label-for="input-boss-reward-gold">
                            <b-form-input
                                id="input-boss-reward-gold"
                                v-model="form.reward_gold"
                                required
                                placeholder="Enter gold count">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-boss-reward-gems"
                            label="Enter gems count"
                            label-for="input-boss-reward-gems">
                            <b-form-input
                                id="input-boss-reward-gems"
                                v-model="form.reward_gems"
                                required
                                placeholder="Enter gems count">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-boss-reward-exp"
                            label="Enter exp count"
                            label-for="input-boss-reward-exp">
                            <b-form-input
                                id="input-bpss=reward-exp"
                                v-model="form.reward_exp"
                                required
                                placeholder="Enter exp count">
                            </b-form-input>
                        </b-form-group>

                    </b-col>

                    <b-col cols="3" offset="1">

                        <b-form-group
                            id="input-group-boss-reward-item-rarity"
                            label="Enter item rarity"
                            label-for="input-boss-reward-item-rarity">
                            <b-form-input
                                id="input-boss-reward-item-rarity"
                                v-model="form.reward_item_rarity"
                                placeholder="Enter item rarity">
                            </b-form-input>
                        </b-form-group>

                    </b-col>

                </b-row>

            </b-form>

        </b-container>

    </div>

</template>

<script>
    export default {
        props: [
            'url'
        ],
        data() {
            return {
                form: {
                    name: '',
                    hp: null,
                    armor: null,
                    reward_gold: null,
                    reward_gems: null,
                    reward_exp: null,
                    reward_item_rarity: null,
                }
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();

                this.$emit('addBoss', this.form);
            }
        }
    }
</script>
