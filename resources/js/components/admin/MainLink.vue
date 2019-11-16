<template>

    <b-button-group vertical class="left-bar-button-group">

        <b-button
            :class="visible ? null : 'collapsed'"
            :aria-expanded="visible ? 'true' : 'false'"
            :aria-controls="name"
            variant="light"
            @click="toggle"
            class="left-bar-button"
            v-html="name">
        </b-button>

        <b-collapse :id="name" v-model="visible" class="mt-2 collapse-content">
            <left-bar-links :links="mainLink.links"></left-bar-links>
        </b-collapse>

    </b-button-group>

</template>

<script>
    export default {
        props: [
            'mainLink'
        ],
        data() {
            return {
                visible: this.mainLink.visible,
                name: this.mainLink.name,
            }
        },
        methods: {
            toggle() {
                this.visible = !this.visible;
            }
        }
    }
</script>
