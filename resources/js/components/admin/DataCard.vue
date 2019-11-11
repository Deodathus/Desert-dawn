<template>
    <div>
        <b-card :bg-variant="bg-variant" :text-variant="text-variant" :header="header" class="text-center data-card">
            <b-card-text class="data-card-text">
                <slot></slot>
            </b-card-text>
        </b-card>
    </div>
</template>

<script>
    export default {
        props: ['bg-variant', 'text-variant', 'header'],
    }
</script>