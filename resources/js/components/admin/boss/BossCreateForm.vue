<template>

    <div>

        <b-form @submit="onSubmit" id="boss-creation-form">

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

                    <b-button type="submit">{{ this.button }}</b-button>

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
                            id="input-boss-reward-exp"
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
                        label-for="select-boss-reward-item-rarity">
                        <b-form-select
                            id="select-boss-reward-item-rarity"
                            v-model="form.reward_item_rarity"
                            required>
                            <option :value="disabled" disabled>Please select an option</option>
                            <option :value="index" v-for="(item, index) in this.rarities">{{ item }}</option>
                        </b-form-select>
                    </b-form-group>

                </b-col>

            </b-row>

        </b-form>

    </div>

</template>

<script>
    export default {
        props: [
            'url',
            'edition_mode',
            'api_url',
            'rarities_api_url',
            'boss_id'
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
                },
                button: '',
                rarities: {},
                edition: false,
                disabled: null,
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();

                if (this.edition) {
                    this.$emit('editBoss', this.form)
                } else {
                    this.$emit('addBoss', this.form);
                }
            },
            fillBossData(bossData) {
                this.form.name = bossData.name;
                this.form.hp = bossData.hp;
                this.form.armor = bossData.armor;
                this.form.reward_gold = bossData.reward_gold;
                this.form.reward_gems = bossData.reward_gems;
                this.form.reward_exp = bossData.reward_exp;
                this.form.reward_item_rarity = bossData.reward_item_rarity;
            },
            getItemRarities() {
                axios.get(this.rarities_api_url)
                    .then((response) => {
                        this.rarities = response.data;
                })
                    .catch((error) => {
                        console.log(error.response.data);
                    });
            }
        },
        created() {
            this.edition = this.edition_mode;
            this.getItemRarities();

            if (this.edition) {
                this.button = 'Edit';

                axios.post(this.api_url, {
                    id: this.boss_id
                }).then((response) => {
                    this.fillBossData(response.data);
                }).catch((error) => {
                    if (error.response.status === 422) {
                        console.log(error.response.data);
                    }
                });
            } else {
                this.button = 'Add';
            }
        },
    }
</script>
