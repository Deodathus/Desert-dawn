<template>
    <div>
        <div v-for="mainLink in mainLinks">
            <b-button-group vertical class="left-bar-button-group">
                <b-button v-b-toggle="mainLink.name"
                          variant="light" class="left-bar-button"
                v-html="mainLink.name"></b-button>
                <b-collapse :id="mainLink.name" class="mt-2 collapse-content">
                    <left-bar-links :links="mainLink.links"></left-bar-links>
                </b-collapse>
            </b-button-group>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['links', 'mainLinks'],
    }
</script>
