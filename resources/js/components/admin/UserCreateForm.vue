<template>

    <div>

            <b-form @submit="onSubmit">
                <b-row>

                    <b-col cols="6">

                        <b-form-group
                            id="input-group-user-name"
                            label="User's name"
                            label-for="input-user-name">
                            <b-form-input
                                id="input-user-name"
                                v-model="form.name"
                                required
                                placeholder="Enter name">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-email"
                            label="User's email"
                            label-for="input-user-email">
                            <b-form-input
                                id="input-user-email"
                                v-model="form.email"
                                required
                                type="email"
                                placeholder="Enter email">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-password"
                            label="User's Password"
                            label-for="input-user-password">
                            <b-form-input
                                id="input-user-password"
                                v-model="form.password"
                                required
                                type="password"
                                placeholder="Enter password">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-coins"
                            label="User's coins"
                            label-for="input-user-coins">
                            <b-form-input
                                id="input-user-coins"
                                v-model="form.coins"
                                placeholder="Enter coins count">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-gems"
                            label="User's gems"
                            label-for="input-user-gems">
                            <b-form-input
                                id="input-user-gems"
                                v-model="form.gems"
                                placeholder="Enter gems count">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-energy"
                            label="User's energy"
                            label-for="input-user-energy">
                            <b-form-input
                                id="input-user-energy"
                                v-model="form.energy"
                                placeholder="Enter energy count">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-admin"
                            label="Admin"
                            label-for="checkbox-user-admin">
                            <b-form-checkbox
                                v-model="form.isAdmin">
                            </b-form-checkbox>
                        </b-form-group>

                        <b-button type="submit">Add</b-button>

                    </b-col>
                    <b-col cols="6">
                        <b-form-group
                            id="input-group-user-level"
                            label="User's level"
                            label-for="input-user-level">
                            <b-form-input
                                id="input-user-level"
                                v-model="form.level"
                                placeholder="Enter level">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-exp"
                            label="User's experience"
                            label-for="input-user-exp">
                            <b-form-input
                                id="input-user-exp"
                                v-model="form.exp"
                                placeholder="Enter experience">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-skill-one"
                            label="User's first skill"
                            label-for="input-user-skill-one">
                            <b-form-input
                                id="input-user-skill-one"
                                v-model="form.skillOne"
                                placeholder="Enter count of first skill">
                            </b-form-input>
                            <label for="input-user-skill-one-damage">Damage</label>
                            <b-form-input
                                id="input-user-skill-one-damage"
                                v-model="form.skillOneDamage">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-skill-two"
                            label="User's second skill"
                            label-for="input-user-skill-two">
                            <b-form-input
                                id="input-user-skill-two"
                                v-model="form.skillTwo"
                                placeholder="Enter count of second skill">
                            </b-form-input>
                            <label for="input-user-skill-two-damage">Damage</label>
                            <b-form-input
                                id="input-user-skill-two-damage"
                                v-model="form.skillTwoDamage">
                            </b-form-input>
                        </b-form-group>

                        <b-form-group
                            id="input-group-user-skill-three"
                            label="User's three skill"
                            label-for="input-user-skill-three">
                            <b-form-input
                                id="input-user-skill-three"
                                v-model="form.skillThree"
                                placeholder="Enter count of third skill">
                            </b-form-input>
                            <label for="input-user-skill-three-damage">Damage</label>
                            <b-form-input
                                id="input-user-skill-three-damage"
                                v-model="form.skillThreeDamage">
                            </b-form-input>
                        </b-form-group>
                    </b-col>

                </b-row>

            </b-form>
        
    </div>

</template>

<script>
    export default {
        props: ['url'],
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    coins: 0,
                    gems: 0,
                    energy: 0,
                    level: 1,
                    exp: 0,
                    skillOne: 1,
                    skillOneDamage: 1,
                    skillTwo: 1,
                    skillTwoDamage: 1,
                    skillThree: 1,
                    skillThreeDamage: 1,
                    isAdmin: false
                },
                errors: [],
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault();

                this.$emit('addUser', this.form);
                this.$emit('emitRecord', this.form);
            }
        },
    }
</script>
