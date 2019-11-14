<template>

    <div>

        <collapse :name="name">

            <template v-slot:title>
                Add +
            </template>

            <template v-slot:content>
                <user-manage-all-form>
                </user-manage-all-form>
            </template>

        </collapse>

    </div>
</template>

<script>
    export default {
        props: ['name'],
    }
</script>
