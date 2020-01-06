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
                this.$swal({
                    title: 'Are you sure?',
                    text: 'You can\'t revert your action',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes Delete it!',
                    cancelButtonText: 'No, Keep it!',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        axios.delete(this.deleteUrl);
                        this.$emit('deleteRecord', this.id);
                    }
                    return result;
                }).then((result) => {
                    if (result.value) {
                        this.$swal('Deleted', 'You successfully deleted it', 'success');
                    }
                });
            }
        },
    }
</script>
