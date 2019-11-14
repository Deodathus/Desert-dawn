<template>

    <div>

        <b-button
            :class="visible ? null : 'collapsed'"
            class="creation-button"
            :aria-expanded="visible ? 'true' : 'false'"
            :aria-controls="name"
            variant="primary"
            @click="toogle">
            <slot name="title"></slot>
        </b-button>

        <b-collapse :id="name" v-model="visible" class="mt-2">
            <slot name="content"></slot>
        </b-collapse>

    </div>

</template>

<script>
    export default {
        props: ['name'],
        data() {
            return {
                visible: JSON.parse(localStorage.getItem(this.name)),
            }
        },
        methods: {
            toogle() {
                let value = !this.visible;

                localStorage.setItem(this.name, value.toString());
                this.visible = value;
            },
        },
    }
</script>
