<template>

    <span>

        <i
            class="fas fa-times tooltip-delete"
            :id="'tooltip-delete' + id"
            @click="deleteItem">
        </i>

        <b-tooltip
            :target="'tooltip-delete' + id"
            triggers="hover"
            title="Delete">
        </b-tooltip>

    </span>

</template>

<script>
    export default {
        props: [
            'id',
            'url'
        ],
        data() {
            return {
                deleteUrl: ''
            }
        },
        mounted() {
            this.deleteUrl = this.url + '/' + this.id;
        },
        methods: {
            deleteItem() {
                this.$emit('deleteRecord', this.id);
                //axios
            }
        },
    }
</script>
