<template>
    <div>
        <user-create-form :url="url">

        </user-create-form>

        <user-list :users="users">

        </user-list>

    </div>
</template>

<script>
    export default {
        props: [
            'users',
            'url'
        ],
    }
</script>
