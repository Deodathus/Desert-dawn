<template>

    <span>

        <i
            class="far fa-edit tooltip-edit"
            :id="'tooltip-edit-' + id"
            @click="editItem">
        </i>

        <b-tooltip
            :target="'tooltip-edit-' + id"
            triggers="hover"
            title="Edit">
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
                editUrl: '',
            }
        },
        mounted() {
            this.editUrl = this.url + '/' + this.id + '/edit';
        },
        methods: {
            editItem() {
                window.location.href = this.editUrl;
            }
        }
    }
</script>
