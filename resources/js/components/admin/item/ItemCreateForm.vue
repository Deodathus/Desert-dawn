<template>

    <div>

        <b-form @submit="onSubmit" id="item-creation-form">

            <b-row>

                <b-col cols="3">

                    <b-form-group
                        id="input-group-item-name"
                        label="Item's name"
                        label-for="input-item-name">
                        <b-form-input
                            id="input-item-name"
                            v-model="form.name"
                            required
                            placeholder="Enter name">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-item-required-level"
                        label="Item's required level"
                        label-for="input-item-required-level">
                        <b-form-input
                            id="input-item-required-level"
                            v-model="form.required_level"
                            required
                            placeholder="Enter required level">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-item-item-rarity-id"
                        label="Item's rarity"
                        label-for="select-item-item-rarity-id">
                        <b-form-select
                            id="select-item-item-rarity-id"
                            v-model="form.item_rarity_id"
                            required>
                            <option :value="disabled" disabled selected>Please select an option</option>
                            <option :value="index" v-for="(item, index) in this.rarities">{{ item }}</option>
                        </b-form-select>
                    </b-form-group>

                    <b-button type="submit">{{ this.button }}</b-button>

                </b-col>

                <b-col cols="3" offset="1">

                    <b-form-group
                        id="input-group-item-type"
                        label="Item's type"
                        label-for="select-item-type">
                        <b-form-select
                            id="select-item-type"
                            v-model="form.type"
                            required>
                            <option :value="disabled" disabled>Please select an option</option>
                            <option :value="index" v-for="(type, index) in this.types">{{ type }}</option>
                        </b-form-select>
                    </b-form-group>

                    <b-form-group
                        id="input-group-item-strength"
                        label="Item's strength"
                        label-for="input-item-strength">
                        <b-form-input
                            id="input-item-strength"
                            v-model="form.strength"
                            required
                            placeholder="Enter strength">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-item-stamina"
                        label="Item's stamina"
                        label-for="input-item-stamina">
                        <b-form-input
                            id="input-item-stamina"
                            v-model="form.stamina"
                            required
                            placeholder="Enter stamina">
                        </b-form-input>
                    </b-form-group>

                </b-col>

                <b-col cols="3" offset="1">

                    <b-form-group
                        id="input-group-item-agility"
                        label="Item's agility"
                        label-for="input-item-agility">
                        <b-form-input
                            id="input-item-agility"
                            v-model="form.agility"
                            required
                            placeholder="Enter agility">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-item-intellect"
                        label="Item's intellect"
                        label-for="input-item-intellect">
                        <b-form-input
                            id="input-item-intellect"
                            v-model="form.intellect"
                            required
                            placeholder="Enter intellect">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-item-luck"
                        label="Item's luck"
                        label-for="input-item-luck">
                        <b-form-input
                            id="input-item-luck"
                            v-model="form.luck"
                            required
                            placeholder="Enter luck">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-item-wisdom"
                        label="Item's wisdom"
                        label-for="input-item-wisdom">
                        <b-form-input
                            id="input-item-wisdom"
                            v-model="form.wisdom"
                            required
                            placeholder="Enter wisdom">
                        </b-form-input>
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
            'item_types_api_url',
            'item_rarities_api_url',
            'item_id',
        ],
        data() {
            return {
                form: {
                    name: '',
                    required_level: null,
                    item_rarity_id: null,
                    type: null,
                    strength: null,
                    stamina: null,
                    agility: null,
                    intellect: null,
                    luck: null,
                    wisdom: null
                },
                rarities: {},
                types: {},
                button: null,
                edition: false,
                disabled: null,
            };
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();

                if (this.edition) {
                    this.$emit('editItem', this.form);
                } else {
                    this.$emit('addItem', this.form);
                }
            },
            fillItemData(itemData) {
                this.form.name = itemData.name;
                this.form.required_level = itemData.required_level;
                this.form.item_rarity_id = itemData.item_rarity_id;
                this.form.type = itemData.type;
                this.form.strength = itemData.strength;
                this.form.stamina = itemData.stamina;
                this.form.agility = itemData.agility;
                this.form.intellect = itemData.intellect;
                this.form.luck = itemData.luck;
                this.form.wisdom = itemData.wisdom;
            },
            getItemRarities() {
                axios.get(this.item_rarities_api_url)
                    .then((response) => {
                        this.rarities = response.data;
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                    });
            },
            getItemTypes() {
                axios.get(this.item_types_api_url)
                    .then((response) => {
                        this.types = response.data;
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                    });
            }
        },
        created() {
            this.edition = this.edition_mode;
            this.getItemRarities();
            this.getItemTypes();

            if (this.edition) {
                this.button = 'Edit';

                axios.post(this.api_url, {
                    id: this.item_id
                })
                    .then((response) => {
                        this.fillItemData(response.data);
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                    });
            } else {
                this.button = 'Add';
            }
        }
    }
</script>

<style scoped>

</style>
