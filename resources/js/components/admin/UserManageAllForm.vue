<template>
    <b-form @submit="onSubmit">

        <b-container fluid>

            <b-row>

                <b-col cols="3">

                    <b-form-group
                        id="input-group-all-users-coins"
                        label="Add coins"
                        label-for="input-all-users-coins"
                        :description="this.description">
                        <b-form-input
                            id="input-all-users-coins"
                            v-model="form.coins"
                            placeholder="Coins">
                        </b-form-input>
                    </b-form-group>

                </b-col>

                <b-col cols="3" offset="1">

                    <b-form-group
                        id="input-group-all-users-gems"
                        label="Add gems"
                        label-for="input-all-users-gems"
                        :description="this.description">
                        <b-form-input
                            id="input-all-users-gems"
                            v-model="form.gems"
                            placeholder="Gems">
                        </b-form-input>
                    </b-form-group>

                </b-col>

                <b-col cols="3" offset="1">

                    <b-form-group
                        id="input-group-all-users-energy"
                        label="Add energy"
                        label-for="input-all-users-energy"
                        :description="this.description">
                        <b-form-input
                            id="input-all-users-energy"
                            v-model="form.energy"
                            placeholder="Energy">
                        </b-form-input>
                    </b-form-group>

                </b-col>

            </b-row>

        </b-container>

        <b-container fluid>

            <b-row>

                <b-col cols="3">

                    <b-form-group
                        id="input-all-users-skill-one"
                        label="Add skill one"
                        label-for="input-all-users-skill-one"
                        :description="this.description">
                        <b-form-input
                            id="input-all-users-skill-one"
                            v-model="form.skillOne"
                            placeholder="Skill One">
                        </b-form-input>
                    </b-form-group>

                </b-col>

                <b-col cols="3" offset="1">

                    <b-form-group
                        id="input-group-all-users-skill-two"
                        label="Add skill two"
                        label-for="input-all-users-skill-two"
                        :description="this.description">
                        <b-form-input
                            id="input-all-users-skill-two"
                            v-model="form.skillTwo"
                            placeholder="Skill two">
                        </b-form-input>
                    </b-form-group>

                </b-col>

                <b-col cols="3" offset="1">

                    <b-form-group
                        id="input-group-all-users-skill-three"
                        label="Add skill three"
                        label-for="input-all-users-skill-three"
                        :description="this.description">
                        <b-form-input
                            id="input-all-users-skill-three"
                            v-model="form.skillThree"
                            placeholder="Skill three">
                        </b-form-input>
                    </b-form-group>

                </b-col>

            </b-row>

            <b-button type="submit">Add</b-button>

        </b-container>

    </b-form>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    coins: 0,
                    gems: 0,
                    energy: 0,
                    skillOne: 0,
                    skillTwo: 0,
                    skillThree: 0
                },
                description: 'This count will be added to ALL users.',
            }
        },
        methods: {
            onSubmit() {
                console.log('submited');
            }
        }
    }
</script>
