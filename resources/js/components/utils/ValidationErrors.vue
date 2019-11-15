<template>
    <div>
        <b-alert v-for="(value, key, index) in validationErrors" v-bind:key="key" show variant="danger">{{ value }}</b-alert>
    </div>
</template>

<script>
    export default {
        props: [
            'errors'
        ],
        computed: {
            validationErrors() {
                let errors = Object.values(this.errors);
                errors = errors.flat();
                return errors;
            }
        },
    }
</script>
